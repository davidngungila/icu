function parseVitals(raw) {
    if (!raw) return [];

    if (Array.isArray(raw)) {
        return raw;
    }

    if (typeof raw === 'string') {
        try {
            return JSON.parse(raw);
        } catch {
            return [];
        }
    }

    return [];
}

function drawTrend(canvas, vitals) {
    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    const w = canvas.width;
    const h = canvas.height;

    ctx.clearRect(0, 0, w, h);
    ctx.fillStyle = '#f8fafc';
    ctx.fillRect(0, 0, w, h);

    ctx.strokeStyle = 'rgba(148, 163, 184, 0.5)';
    ctx.lineWidth = 1;
    for (let x = 0; x <= w; x += 60) {
        ctx.beginPath();
        ctx.moveTo(x, 0);
        ctx.lineTo(x, h);
        ctx.stroke();
    }
    for (let y = 0; y <= h; y += 60) {
        ctx.beginPath();
        ctx.moveTo(0, y);
        ctx.lineTo(w, y);
        ctx.stroke();
    }

    if (!vitals.length) {
        ctx.fillStyle = 'rgba(100, 116, 139, 0.8)';
        ctx.font = '14px system-ui, -apple-system, Segoe UI, Roboto, sans-serif';
        ctx.fillText('No vitals data', 16, 32);
        return;
    }

    const points = vitals
        .map((v) => ({
            hr: Number(v.hr ?? NaN),
            spo2: Number(v.spo2 ?? NaN),
        }))
        .filter((p) => Number.isFinite(p.hr) && Number.isFinite(p.spo2));

    if (!points.length) return;

    const hrMin = Math.min(...points.map((p) => p.hr));
    const hrMax = Math.max(...points.map((p) => p.hr));
    const spo2Min = Math.min(...points.map((p) => p.spo2));
    const spo2Max = Math.max(...points.map((p) => p.spo2));

    const pad = 16;
    const xStep = (w - pad * 2) / Math.max(1, points.length - 1);

    function yScale(v, min, max) {
        const r = Math.max(1, max - min);
        return pad + (1 - (v - min) / r) * (h - pad * 2);
    }

    // HR line
    ctx.strokeStyle = 'rgba(16, 185, 129, 0.9)';
    ctx.lineWidth = 2;
    ctx.beginPath();
    points.forEach((p, i) => {
        const x = pad + i * xStep;
        const y = yScale(p.hr, hrMin, hrMax);
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    });
    ctx.stroke();

    // SpO2 line
    ctx.strokeStyle = 'rgba(59, 130, 246, 0.9)';
    ctx.lineWidth = 2;
    ctx.beginPath();
    points.forEach((p, i) => {
        const x = pad + i * xStep;
        const y = yScale(p.spo2, spo2Min, spo2Max);
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    });
    ctx.stroke();

    ctx.fillStyle = 'rgba(100, 116, 139, 0.9)';
    ctx.font = '12px system-ui, -apple-system, Segoe UI, Roboto, sans-serif';
    ctx.fillText('HR', 16, 18);
    ctx.fillStyle = 'rgba(59, 130, 246, 0.9)';
    ctx.fillText('SpO₂', 48, 18);
}

function initTrends() {
    const canvas = document.querySelector('[data-icu-trend]');
    if (!canvas) return;

    const raw = canvas.getAttribute('data-icu-trend-vitals');
    const vitals = parseVitals(raw);

    drawTrend(canvas, vitals);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTrends);
} else {
    initTrends();
}
