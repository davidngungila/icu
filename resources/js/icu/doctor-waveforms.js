function drawWaveform(canvas, samples) {
    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    const w = canvas.width;
    const h = canvas.height;

    ctx.clearRect(0, 0, w, h);

    ctx.fillStyle = '#f8fafc';
    ctx.fillRect(0, 0, w, h);

    ctx.strokeStyle = 'rgba(148, 163, 184, 0.5)';
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

    if (!samples || !samples.length) {
        ctx.fillStyle = 'rgba(100, 116, 139, 0.8)';
        ctx.font = '14px system-ui, -apple-system, Segoe UI, Roboto, sans-serif';
        ctx.fillText('No waveform data', 16, 32);
        return;
    }

    const min = Math.min(...samples);
    const max = Math.max(...samples);
    const range = Math.max(1, max - min);

    const pad = 16;
    const xStep = (w - pad * 2) / Math.max(1, samples.length - 1);

    ctx.strokeStyle = 'rgba(16, 185, 129, 0.9)';
    ctx.lineWidth = 2;
    ctx.beginPath();

    samples.forEach((v, i) => {
        const x = pad + i * xStep;
        const y = pad + (1 - (v - min) / range) * (h - pad * 2);
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    });

    ctx.stroke();
}

function initWaveforms() {
    const canvas = document.querySelector('[data-icu-waveform]');
    if (!canvas) return;

    let samples = [];
    try {
        samples = JSON.parse(canvas.getAttribute('data-icu-waveform-samples') || '[]');
    } catch {
        samples = [];
    }

    drawWaveform(canvas, samples);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initWaveforms);
} else {
    initWaveforms();
}
