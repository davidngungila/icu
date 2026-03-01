const STORAGE_KEY = 'icu.doctor.sound';

function safeReadBool(key, fallback = false) {
    try {
        const v = localStorage.getItem(key);
        if (v === '1') return true;
        if (v === '0') return false;
    } catch {
        // ignore
    }
    return fallback;
}

function safeWriteBool(key, value) {
    try {
        localStorage.setItem(key, value ? '1' : '0');
    } catch {
        // ignore
    }
}

function clamp(n, a, b) {
    return Math.max(a, Math.min(b, n));
}

function lerp(a, b, t) {
    return a + (b - a) * t;
}

function makeBeep() {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();

    function beep({ frequency = 880, durationMs = 70, gain = 0.04 } = {}) {
        const o = ctx.createOscillator();
        const g = ctx.createGain();

        o.type = 'sine';
        o.frequency.value = frequency;

        g.gain.setValueAtTime(0.0001, ctx.currentTime);
        g.gain.exponentialRampToValueAtTime(gain, ctx.currentTime + 0.01);
        g.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + durationMs / 1000);

        o.connect(g);
        g.connect(ctx.destination);

        o.start();
        o.stop(ctx.currentTime + durationMs / 1000);
    }

    return { ctx, beep };
}

function colorForLevel(level) {
    if (level === 'critical') return 'rgba(239, 68, 68, 0.95)';
    if (level === 'warning') return 'rgba(245, 158, 11, 0.95)';
    return 'rgba(16, 185, 129, 0.95)';
}

function labelForLevel(level) {
    if (level === 'critical') return 'Critical';
    if (level === 'warning') return 'Warning';
    return 'Stable';
}

function computeLevel(kind, state) {
    if (kind === 'spo2') {
        if (state.spo2 < 90) return 'critical';
        if (state.spo2 < 94) return 'warning';
        return 'stable';
    }

    if (kind === 'abp') {
        if (state.map < 60) return 'critical';
        if (state.map < 70) return 'warning';
        return 'stable';
    }

    if (kind === 'resp') {
        if (state.rr < 8 || state.rr > 28) return 'critical';
        if (state.rr < 10 || state.rr > 24) return 'warning';
        return 'stable';
    }

    if (kind === 'ecg') {
        if (state.hr < 45 || state.hr > 135) return 'critical';
        if (state.hr < 55 || state.hr > 120) return 'warning';
        return 'stable';
    }

    return 'stable';
}

function severityRank(level) {
    if (level === 'critical') return 2;
    if (level === 'warning') return 1;
    return 0;
}

function maxSeverity(a, b) {
    return severityRank(a) >= severityRank(b) ? a : b;
}

function deviceLevel(devices) {
    if (!devices || !devices.length) return 'warning';

    const statuses = devices.map((d) => String(d.status || '').toLowerCase());
    if (statuses.some((s) => s === 'fault')) return 'critical';
    if (statuses.some((s) => s === 'offline')) return 'critical';
    if (statuses.some((s) => s && s !== 'online')) return 'warning';
    return 'stable';
}

function drawGrid(ctx, w, h) {
    ctx.clearRect(0, 0, w, h);
    ctx.fillStyle = '#0b1220';
    ctx.fillRect(0, 0, w, h);

    ctx.strokeStyle = 'rgba(148, 163, 184, 0.12)';
    ctx.lineWidth = 1;
    for (let x = 0; x <= w; x += 40) {
        ctx.beginPath();
        ctx.moveTo(x, 0);
        ctx.lineTo(x, h);
        ctx.stroke();
    }
    for (let y = 0; y <= h; y += 40) {
        ctx.beginPath();
        ctx.moveTo(0, y);
        ctx.lineTo(w, y);
        ctx.stroke();
    }
}

function drawWave(ctx, w, h, samples, color) {
    if (!samples.length) return;

    const pad = 10;
    ctx.strokeStyle = color;
    ctx.lineWidth = 2;
    ctx.beginPath();

    const xStep = (w - pad * 2) / Math.max(1, samples.length - 1);

    for (let i = 0; i < samples.length; i++) {
        const x = pad + i * xStep;
        const y = pad + (1 - samples[i]) * (h - pad * 2);
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    }

    ctx.stroke();
}

function initDoctorDashboardWaves() {
    const container = document.querySelector('[data-icu-waves]');
    if (!container) return;

    const canvases = Array.from(document.querySelectorAll('[data-icu-wave]'));
    if (!canvases.length) return;

    const statusEls = new Map(
        Array.from(document.querySelectorAll('[data-icu-wave-status]')).map((el) => [el.getAttribute('data-icu-wave-status'), el])
    );

    const deviceEls = new Map(
        Array.from(document.querySelectorAll('[data-icu-wave-devices]')).map((el) => [el.getAttribute('data-icu-wave-devices'), el])
    );

    let soundEnabled = safeReadBool(STORAGE_KEY, false);
    const toggleBtn = document.querySelector('[data-icu-sound-toggle]');

    let audio = null;
    let lastBeepAt = 0;

    function setSoundEnabled(next) {
        soundEnabled = next;
        safeWriteBool(STORAGE_KEY, soundEnabled);
        if (toggleBtn) {
            toggleBtn.textContent = soundEnabled ? 'Sound Enabled' : 'Enable Sound';
        }
    }

    if (toggleBtn) {
        setSoundEnabled(soundEnabled);

        toggleBtn.addEventListener('click', async () => {
            if (!audio) {
                audio = makeBeep();
            }

            if (audio.ctx.state === 'suspended') {
                try {
                    await audio.ctx.resume();
                } catch {
                    // ignore
                }
            }

            setSoundEnabled(!soundEnabled);
            if (soundEnabled) {
                audio.beep({ frequency: 880, durationMs: 60, gain: 0.03 });
            }
        });
    }

    const buffers = new Map();
    const bufferLen = 220;

    const state = {
        t: 0,
        hr: 88,
        spo2: 95,
        map: 76,
        rr: 18,
    };

    function pushSample(kind, value) {
        if (!buffers.has(kind)) {
            buffers.set(kind, Array.from({ length: bufferLen }, () => 0.5));
        }
        const buf = buffers.get(kind);
        buf.push(value);
        while (buf.length > bufferLen) buf.shift();
        return buf;
    }

    function simulate() {
        state.t += 1;

        // slow random walk on vitals
        state.hr = clamp(state.hr + (Math.random() - 0.5) * 0.8, 40, 150);
        state.spo2 = clamp(state.spo2 + (Math.random() - 0.5) * 0.25, 80, 100);
        state.map = clamp(state.map + (Math.random() - 0.5) * 0.6, 45, 110);
        state.rr = clamp(state.rr + (Math.random() - 0.5) * 0.3, 6, 35);

        // occasional spikes
        if (Math.random() < 0.006) state.spo2 = clamp(state.spo2 - 6, 80, 100);
        if (Math.random() < 0.004) state.map = clamp(state.map - 10, 45, 110);
        if (Math.random() < 0.004) state.hr = clamp(state.hr + 18, 40, 150);

        // waveform shapes scaled to 0..1
        const ecg = 0.5 + 0.22 * Math.sin(state.t / 4) + 0.04 * Math.sin(state.t / 1.3) + (Math.random() - 0.5) * 0.03;
        const spo2 = 0.5 + 0.18 * Math.sin(state.t / 10) + 0.07 * Math.sin(state.t / 3.7) + (Math.random() - 0.5) * 0.02;
        const abp = 0.5 + 0.25 * Math.sin(state.t / 8) + 0.09 * Math.sin(state.t / 2.9) + (Math.random() - 0.5) * 0.02;
        const resp = 0.5 + 0.20 * Math.sin(state.t / 18) + (Math.random() - 0.5) * 0.015;

        pushSample('ecg', clamp(ecg, 0.05, 0.95));
        pushSample('spo2', clamp(spo2, 0.05, 0.95));
        pushSample('abp', clamp(abp, 0.05, 0.95));
        pushSample('resp', clamp(resp, 0.05, 0.95));
    }

    function render() {
        let anyCritical = false;
        let anyWarning = false;

        canvases.forEach((canvas) => {
            const kind = canvas.getAttribute('data-icu-wave');
            const ctx = canvas.getContext('2d');
            if (!ctx) return;

            // ensure internal resolution matches displayed size
            const cssW = canvas.clientWidth || 820;
            const cssH = canvas.clientHeight || 160;
            if (canvas.width !== Math.floor(cssW * devicePixelRatio) || canvas.height !== Math.floor(cssH * devicePixelRatio)) {
                canvas.width = Math.floor(cssW * devicePixelRatio);
                canvas.height = Math.floor(cssH * devicePixelRatio);
                ctx.setTransform(devicePixelRatio, 0, 0, devicePixelRatio, 0, 0);
            }

            const w = cssW;
            const h = cssH;

            const simLevel = computeLevel(kind, state);

            let devices = [];
            const devEl = deviceEls.get(kind);
            if (devEl) {
                try {
                    devices = JSON.parse(devEl.getAttribute('data-icu-wave-devices-json') || '[]');
                } catch {
                    devices = [];
                }
            }

            const devLevel = deviceLevel(devices);
            const level = maxSeverity(simLevel, devLevel);
            if (level === 'critical') anyCritical = true;
            if (level === 'warning') anyWarning = true;

            const color = colorForLevel(level);
            const samples = buffers.get(kind) || [];

            drawGrid(ctx, w, h);
            drawWave(ctx, w, h, samples, color);

            if (level === 'critical') {
                const blink = Math.sin(performance.now() / 180) > 0 ? 0.10 : 0.22;
                ctx.fillStyle = `rgba(239, 68, 68, ${blink})`;
                ctx.fillRect(0, 0, w, h);
            } else if (level === 'warning') {
                ctx.fillStyle = 'rgba(245, 158, 11, 0.07)';
                ctx.fillRect(0, 0, w, h);
            }

            const stEl = statusEls.get(kind);
            if (stEl) {
                stEl.textContent = `${labelForLevel(level)} · ${
                    kind === 'ecg'
                        ? `HR ${Math.round(state.hr)}`
                        : kind === 'spo2'
                          ? `SpO₂ ${Math.round(state.spo2)}%`
                          : kind === 'abp'
                            ? `MAP ${Math.round(state.map)}`
                            : `RR ${Math.round(state.rr)}`
                }`;
                stEl.style.color = level === 'critical' ? '#ef4444' : level === 'warning' ? '#f59e0b' : '#10b981';
            }
        });

        const now = performance.now();
        if (soundEnabled && anyCritical) {
            if (!audio) {
                audio = makeBeep();
            }

            if (now - lastBeepAt > 650) {
                lastBeepAt = now;
                audio.beep({ frequency: 1244, durationMs: 55, gain: 0.04 });
                setTimeout(() => {
                    try {
                        audio.beep({ frequency: 1244, durationMs: 55, gain: 0.035 });
                    } catch {
                        // ignore
                    }
                }, 110);
            }
        } else if (soundEnabled && anyWarning) {
            // quiet warning tick
            if (now - lastBeepAt > 2200) {
                lastBeepAt = now;
                if (!audio) {
                    audio = makeBeep();
                }
                audio.beep({ frequency: 740, durationMs: 35, gain: 0.02 });
            }
        }
    }

    function tick() {
        simulate();
        render();
        requestAnimationFrame(tick);
    }

    // warm buffers
    for (let i = 0; i < bufferLen; i++) {
        simulate();
    }

    tick();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDoctorDashboardWaves);
} else {
    initDoctorDashboardWaves();
}
