const STORAGE_KEY = 'icu.doctor.live_monitor.sound';

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

function makeBeep() {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();

    function beep({ frequency = 880, durationMs = 70, gain = 0.03 } = {}) {
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

function colorForLevel(level, kind) {
    // base colors per wave
    const base =
        kind === 'spo2'
            ? { r: 59, g: 130, b: 246 }
            : kind === 'abp'
              ? { r: 168, g: 85, b: 247 }
              : kind === 'resp'
                ? { r: 34, g: 197, b: 94 }
                : { r: 16, g: 185, b: 129 };

    if (level === 'critical') return 'rgba(239, 68, 68, 0.95)';
    if (level === 'warning') return `rgba(245, 158, 11, 0.95)`;
    return `rgba(${base.r}, ${base.g}, ${base.b}, 0.95)`;
}

function drawGrid(ctx, w, h) {
    ctx.clearRect(0, 0, w, h);
    ctx.fillStyle = '#0b1220';
    ctx.fillRect(0, 0, w, h);

    ctx.strokeStyle = 'rgba(148, 163, 184, 0.10)';
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
    const pad = 8;
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

function initDoctorLiveMonitor() {
    const root = document.querySelector('[data-icu-bed-monitors]');
    if (!root) return;

    const cards = Array.from(document.querySelectorAll('[data-icu-bed-monitor]'));
    if (!cards.length) return;

    let soundEnabled = safeReadBool(STORAGE_KEY, false);
    const toggleBtn = document.querySelector('[data-icu-live-sound-toggle]');

    let audio = null;
    let lastBeepAt = 0;
    let lastCriticalAnnouncementAt = 0;
    const lastBedAnnouncement = new Map(); // bedId -> timestamp

    const modal = document.querySelector('[data-icu-bed-modal]');
    const modalClose = document.querySelector('[data-icu-bed-modal-close]');
    const modalTitle = document.querySelector('[data-icu-bed-modal-title]');
    const modalSubtitle = document.querySelector('[data-icu-bed-modal-subtitle]');
    const modalDevices = document.querySelector('[data-icu-bed-modal-devices]');
    const modalAttention = document.querySelector('[data-icu-bed-modal-attention]');
    const modalNums = new Map(
        Array.from(document.querySelectorAll('[data-icu-bed-modal-num]')).map((el) => [el.getAttribute('data-icu-bed-modal-num'), el])
    );
    const modalWaveStatus = new Map(
        Array.from(document.querySelectorAll('[data-icu-bed-modal-wave-status]')).map((el) => [el.getAttribute('data-icu-bed-modal-wave-status'), el])
    );
    const modalCanvases = new Map(
        Array.from(document.querySelectorAll('[data-icu-bed-modal-wave]')).map((el) => [el.getAttribute('data-icu-bed-modal-wave'), el])
    );

    let activeModalBedId = null;

    function setSoundEnabled(next) {
        soundEnabled = next;
        safeWriteBool(STORAGE_KEY, soundEnabled);
        if (toggleBtn) toggleBtn.textContent = soundEnabled ? 'Sound Enabled' : 'Enable Sound';
    }

    if (toggleBtn) {
        setSoundEnabled(soundEnabled);

        toggleBtn.addEventListener('click', async () => {
            if (!audio) audio = makeBeep();
            if (audio.ctx.state === 'suspended') {
                try {
                    await audio.ctx.resume();
                } catch {
                    // ignore
                }
            }
            setSoundEnabled(!soundEnabled);
            if (soundEnabled) audio.beep({ frequency: 880, durationMs: 50, gain: 0.03 });
        });
    }

    const bufferLen = 120;

    const bedStates = new Map();

    function ensureBedState(bedId) {
        if (bedStates.has(bedId)) return bedStates.get(bedId);

        const state = {
            t: 0,
            hr: 80 + Math.random() * 25,
            spo2: 94 + Math.random() * 4,
            map: 72 + Math.random() * 8,
            rr: 16 + Math.random() * 6,
            buffers: {
                ecg: Array.from({ length: bufferLen }, () => 0.5),
                spo2: Array.from({ length: bufferLen }, () => 0.5),
                abp: Array.from({ length: bufferLen }, () => 0.5),
                resp: Array.from({ length: bufferLen }, () => 0.5),
            },
        };

        bedStates.set(bedId, state);
        return state;
    }

    function simulate(state) {
        state.t += 1;

        state.hr = clamp(state.hr + (Math.random() - 0.5) * 0.7, 40, 150);
        state.spo2 = clamp(state.spo2 + (Math.random() - 0.5) * 0.22, 80, 100);
        state.map = clamp(state.map + (Math.random() - 0.5) * 0.55, 45, 110);
        state.rr = clamp(state.rr + (Math.random() - 0.5) * 0.25, 6, 35);

        if (Math.random() < 0.003) state.spo2 = clamp(state.spo2 - 7, 80, 100);
        if (Math.random() < 0.002) state.map = clamp(state.map - 11, 45, 110);

        const ecg = 0.5 + 0.22 * Math.sin(state.t / 4) + 0.04 * Math.sin(state.t / 1.3) + (Math.random() - 0.5) * 0.03;
        const spo2 = 0.5 + 0.18 * Math.sin(state.t / 10) + 0.07 * Math.sin(state.t / 3.7) + (Math.random() - 0.5) * 0.02;
        const abp = 0.5 + 0.25 * Math.sin(state.t / 8) + 0.09 * Math.sin(state.t / 2.9) + (Math.random() - 0.5) * 0.02;
        const resp = 0.5 + 0.20 * Math.sin(state.t / 18) + (Math.random() - 0.5) * 0.015;

        function push(kind, v) {
            const buf = state.buffers[kind];
            buf.push(clamp(v, 0.05, 0.95));
            while (buf.length > bufferLen) buf.shift();
        }

        push('ecg', ecg);
        push('spo2', spo2);
        push('abp', abp);
        push('resp', resp);
    }

    function renderCard(card) {
        const bedId = Number(card.getAttribute('data-icu-bed-id'));
        const state = ensureBedState(bedId);

        let devices = [];
        try {
            devices = JSON.parse(card.getAttribute('data-icu-bed-devices') || '[]');
        } catch {
            devices = [];
        }

        const statusEl = card.querySelector('[data-icu-bed-status]');

        let bedLevel = deviceLevel(devices);

        const canvases = Array.from(card.querySelectorAll('[data-icu-bed-wave]'));
        canvases.forEach((canvas) => {
            const kind = canvas.getAttribute('data-icu-bed-wave');
            const ctx = canvas.getContext('2d');
            if (!ctx) return;

            const cssW = canvas.clientWidth || 520;
            const cssH = canvas.clientHeight || 90;
            if (canvas.width !== Math.floor(cssW * devicePixelRatio) || canvas.height !== Math.floor(cssH * devicePixelRatio)) {
                canvas.width = Math.floor(cssW * devicePixelRatio);
                canvas.height = Math.floor(cssH * devicePixelRatio);
                ctx.setTransform(devicePixelRatio, 0, 0, devicePixelRatio, 0, 0);
            }

            const sim = computeLevel(kind, state);
            const level = maxSeverity(sim, bedLevel);
            bedLevel = maxSeverity(bedLevel, level);

            const w = cssW;
            const h = cssH;

            drawGrid(ctx, w, h);
            drawWave(ctx, w, h, state.buffers[kind] || [], colorForLevel(level, kind));

            if (level === 'critical') {
                const blink = Math.sin(performance.now() / 180 + bedId) > 0 ? 0.10 : 0.22;
                ctx.fillStyle = `rgba(239, 68, 68, ${blink})`;
                ctx.fillRect(0, 0, w, h);
            } else if (level === 'warning') {
                ctx.fillStyle = 'rgba(245, 158, 11, 0.06)';
                ctx.fillRect(0, 0, w, h);
            }

            const waveStatus = card.querySelector(`[data-icu-bed-wave-status="${kind}"]`);
            if (waveStatus) {
                waveStatus.textContent =
                    kind === 'ecg'
                        ? `HR ${Math.round(state.hr)}`
                        : kind === 'spo2'
                          ? `SpO₂ ${Math.round(state.spo2)}%`
                          : kind === 'abp'
                            ? `MAP ${Math.round(state.map)}`
                            : `RR ${Math.round(state.rr)}`;
                waveStatus.style.color = level === 'critical' ? '#ef4444' : level === 'warning' ? '#f59e0b' : '#10b981';
            }
        });

        if (statusEl) {
            statusEl.textContent = bedLevel === 'critical' ? 'CRITICAL' : bedLevel === 'warning' ? 'Warning' : 'Stable';
            statusEl.className = 'text-xs font-semibold ' + (bedLevel === 'critical' ? 'text-rose-600' : bedLevel === 'warning' ? 'text-amber-600' : 'text-emerald-600');
        }

        return bedLevel;
    }

    function openModalForCard(card) {
        if (!modal) return;
        activeModalBedId = Number(card.getAttribute('data-icu-bed-id'));

        const title = card.querySelector('.text-sm.font-semibold')?.textContent || 'Bed Monitor';
        if (modalTitle) modalTitle.textContent = title;
        if (modalSubtitle) modalSubtitle.textContent = 'Simulated waves (wire to real device streams later)';

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        if (!modal) return;
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        activeModalBedId = null;
    }

    if (modalClose) {
        modalClose.addEventListener('click', closeModal);
    }

    if (modal) {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    }

    cards.forEach((card) => {
        const btn = card.querySelector('[data-icu-bed-fullscreen]');
        if (!btn) return;
        btn.addEventListener('click', () => openModalForCard(card));
    });

    function renderModal() {
        if (!modal || modal.classList.contains('hidden') || activeModalBedId === null) return null;

        const card = cards.find((c) => Number(c.getAttribute('data-icu-bed-id')) === activeModalBedId);
        if (!card) return null;

        const state = ensureBedState(activeModalBedId);
        let devices = [];
        try {
            devices = JSON.parse(card.getAttribute('data-icu-bed-devices') || '[]');
        } catch {
            devices = [];
        }

        let bedLevel = deviceLevel(devices);

        // numbers
        if (modalNums.get('hr')) modalNums.get('hr').textContent = String(Math.round(state.hr));
        if (modalNums.get('spo2')) modalNums.get('spo2').textContent = `${Math.round(state.spo2)}%`;
        if (modalNums.get('map')) modalNums.get('map').textContent = String(Math.round(state.map));
        if (modalNums.get('rr')) modalNums.get('rr').textContent = String(Math.round(state.rr));

        // devices list
        if (modalDevices) {
            if (!devices.length) {
                modalDevices.innerHTML = '<div class="text-sm text-slate-500">No devices connected.</div>';
            } else {
                modalDevices.innerHTML = devices
                    .map((d) => {
                        const st = String(d.status || 'unknown');
                        const cls = st === 'online' ? 'text-emerald-700 bg-emerald-50 border-emerald-200/70' : st === 'offline' || st === 'fault' ? 'text-rose-700 bg-rose-50 border-rose-200/70' : 'text-amber-700 bg-amber-50 border-amber-200/70';
                        return `<div class="p-3 rounded-2xl border ${cls}"><div class="text-sm font-semibold">${String(d.name || 'Device')}</div><div class="text-xs">${String(d.type || '')} · ${st}</div></div>`;
                    })
                    .join('');
            }
        }

        // waves
        ['ecg', 'spo2', 'abp', 'resp'].forEach((kind) => {
            const canvas = modalCanvases.get(kind);
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            if (!ctx) return;

            const cssW = canvas.clientWidth || 1200;
            const cssH = canvas.clientHeight || 220;
            if (canvas.width !== Math.floor(cssW * devicePixelRatio) || canvas.height !== Math.floor(cssH * devicePixelRatio)) {
                canvas.width = Math.floor(cssW * devicePixelRatio);
                canvas.height = Math.floor(cssH * devicePixelRatio);
                ctx.setTransform(devicePixelRatio, 0, 0, devicePixelRatio, 0, 0);
            }

            const sim = computeLevel(kind, state);
            const level = maxSeverity(sim, bedLevel);
            bedLevel = maxSeverity(bedLevel, level);

            const w = cssW;
            const h = cssH;
            drawGrid(ctx, w, h);
            drawWave(ctx, w, h, state.buffers[kind] || [], colorForLevel(level, kind));

            if (level === 'critical') {
                const blink = Math.sin(performance.now() / 180 + activeModalBedId) > 0 ? 0.10 : 0.22;
                ctx.fillStyle = `rgba(239, 68, 68, ${blink})`;
                ctx.fillRect(0, 0, w, h);
            } else if (level === 'warning') {
                ctx.fillStyle = 'rgba(245, 158, 11, 0.06)';
                ctx.fillRect(0, 0, w, h);
            }

            const stEl = modalWaveStatus.get(kind);
            if (stEl) {
                stEl.textContent =
                    kind === 'ecg'
                        ? `HR ${Math.round(state.hr)}`
                        : kind === 'spo2'
                          ? `SpO₂ ${Math.round(state.spo2)}%`
                          : kind === 'abp'
                            ? `MAP ${Math.round(state.map)}`
                            : `RR ${Math.round(state.rr)}`;
                stEl.style.color = level === 'critical' ? '#ef4444' : level === 'warning' ? '#f59e0b' : '#10b981';
            }
        });

        if (modalAttention) {
            if (bedLevel === 'critical') {
                modalAttention.innerHTML = '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200/70">CRITICAL ATTENTION</span>';
            } else if (bedLevel === 'warning') {
                modalAttention.innerHTML = '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200/70">WARNING</span>';
            } else {
                modalAttention.innerHTML = '<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/70">STABLE</span>';
            }
        }

        return bedLevel;
    }

    function speak(text) {
        try {
            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = 'en';
            utter.rate = 1.0;
            utter.pitch = 1.0;
            utter.volume = 0.7;
            window.speechSynthesis.speak(utter);
        } catch {
            // ignore if speech not supported
        }
    }

    function tick() {
        let anyCritical = false;
        let anyWarning = false;
        const criticalBeds = [];

        cards.forEach((card) => {
            const bedId = Number(card.getAttribute('data-icu-bed-id'));
            const st = ensureBedState(bedId);
            simulate(st);
            const level = renderCard(card);
            if (level === 'critical') {
                anyCritical = true;
                criticalBeds.push({ bedId, card });
            }
            if (level === 'warning') anyWarning = true;
        });

        const modalLevel = renderModal();
        if (modalLevel === 'critical') anyCritical = true;
        if (modalLevel === 'warning') anyWarning = true;

        // Announce critical beds (once per 60 seconds per bed)
        if (soundEnabled && criticalBeds.length) {
            const now = performance.now();
            // Global cooldown between any announcements to avoid spam
            if (now - lastCriticalAnnouncementAt > 8000) {
                const toAnnounce = criticalBeds.find(({ bedId }) => {
                    const last = lastBedAnnouncement.get(bedId) || 0;
                    return now - last > 60000;
                });
                if (toAnnounce) {
                    const { card } = toAnnounce;
                    const titleEl = card.querySelector('.text-sm.font-semibold');
                    const title = titleEl?.textContent || 'Bed';
                    speak(`${title} needs attention`);
                    lastCriticalAnnouncementAt = now;
                    lastBedAnnouncement.set(toAnnounce.bedId, now);
                }
            }
        }

        // Scale beep interval based on count of critical beds
        const now = performance.now();
        if (soundEnabled && anyCritical) {
            if (!audio) audio = makeBeep();
            // Faster interval when more beds are critical
            const baseInterval = 900;
            const fasterBy = Math.min(criticalBeds.length * 150, 450);
            const interval = baseInterval - fasterBy;
            if (now - lastBeepAt > interval) {
                lastBeepAt = now;
                audio.beep({ frequency: 1380, durationMs: 65, gain: 0.045 });
                setTimeout(() => {
                    try {
                        audio.beep({ frequency: 1380, durationMs: 65, gain: 0.04 });
                    } catch {
                        // ignore
                    }
                }, 140);
            }
        } else if (soundEnabled && anyWarning) {
            if (now - lastBeepAt > 3200) {
                lastBeepAt = now;
                if (!audio) audio = makeBeep();
                audio.beep({ frequency: 660, durationMs: 45, gain: 0.025 });
            }
        }

        requestAnimationFrame(tick);
    }

    tick();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDoctorLiveMonitor);
} else {
    initDoctorLiveMonitor();
}
