function clamp(v, min, max) {
    return Math.max(min, Math.min(max, v));
}

function createSeries(length, start = 50) {
    const arr = [];
    let v = start;
    for (let i = 0; i < length; i += 1) {
        v = clamp(v + (Math.random() - 0.5) * 10, 0, 100);
        arr.push(v);
    }
    return arr;
}

function resizeCanvas(canvas) {
    const dpr = window.devicePixelRatio || 1;
    const rect = canvas.getBoundingClientRect();
    const width = Math.max(1, Math.floor(rect.width));
    const height = Math.max(1, Math.floor(rect.height));

    const targetW = Math.floor(width * dpr);
    const targetH = Math.floor(height * dpr);

    if (canvas.width !== targetW || canvas.height !== targetH) {
        canvas.width = targetW;
        canvas.height = targetH;
    }

    return { width: targetW, height: targetH, dpr };
}

function drawLine(ctx, series, w, h, opts) {
    const {
        stroke,
        fill,
        grid,
    } = opts;

    ctx.clearRect(0, 0, w, h);

    // grid
    ctx.lineWidth = 1;
    ctx.strokeStyle = grid;
    ctx.globalAlpha = 0.6;
    const gridLines = 4;
    for (let i = 1; i < gridLines; i += 1) {
        const y = (h / gridLines) * i;
        ctx.beginPath();
        ctx.moveTo(0, y);
        ctx.lineTo(w, y);
        ctx.stroke();
    }
    ctx.globalAlpha = 1;

    // line
    const n = series.length;
    if (n < 2) return;

    const xStep = w / (n - 1);

    ctx.beginPath();
    for (let i = 0; i < n; i += 1) {
        const x = i * xStep;
        const y = h - (series[i] / 100) * (h - 8) - 4;
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    }
    ctx.strokeStyle = stroke;
    ctx.lineWidth = 2;
    ctx.lineJoin = 'round';
    ctx.lineCap = 'round';
    ctx.stroke();

    // fill
    ctx.lineTo(w, h);
    ctx.lineTo(0, h);
    ctx.closePath();
    ctx.fillStyle = fill;
    ctx.globalAlpha = 0.25;
    ctx.fill();
    ctx.globalAlpha = 1;
}

function themePalette() {
    const dark = document.documentElement.classList.contains('dark');
    return {
        stroke: dark ? 'rgb(52 211 153)' : 'rgb(5 150 105)',
        fill: dark ? 'rgb(16 185 129)' : 'rgb(16 185 129)',
        grid: dark ? 'rgb(30 41 59)' : 'rgb(226 232 240)',
    };
}

function attachGraph(canvas) {
    const ctx = canvas.getContext('2d');
    if (!ctx) return null;

    const points = Number(canvas.dataset.points || 40);
    let series = createSeries(points, 60);

    const render = () => {
        const { width, height } = resizeCanvas(canvas);
        drawLine(ctx, series, width, height, themePalette());
    };

    const tick = () => {
        const last = series[series.length - 1] ?? 50;
        const next = clamp(last + (Math.random() - 0.5) * 16, 5, 95);
        series = series.slice(1);
        series.push(next);
        render();
    };

    render();

    const intervalMs = Number(canvas.dataset.interval || 900);
    const id = window.setInterval(tick, intervalMs);

    const onResize = () => render();
    window.addEventListener('resize', onResize);

    return {
        destroy() {
            window.clearInterval(id);
            window.removeEventListener('resize', onResize);
        },
        render,
    };
}

export function initLiveGraphs() {
    const canvases = document.querySelectorAll('[data-icu-live-graph]');
    if (!canvases.length) return;

    const instances = [];
    canvases.forEach((c) => {
        const inst = attachGraph(c);
        if (inst) instances.push(inst);
    });

    // re-render when theme changes (our theme toggler mutates html.dark)
    const observer = new MutationObserver(() => {
        instances.forEach((i) => i.render());
    });

    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
}
