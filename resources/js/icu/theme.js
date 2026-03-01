const STORAGE_KEY = 'icu.theme.v2';
const LEGACY_KEY = 'icu.theme';

function getInitialTheme() {
    try {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored === 'dark' || stored === 'light') return stored;

        const legacy = localStorage.getItem(LEGACY_KEY);
        if (legacy !== null) {
            localStorage.removeItem(LEGACY_KEY);
        }
    } catch {
        // ignore
    }

    return 'light';
}

export function applyTheme(theme) {
    const root = document.documentElement;
    root.classList.toggle('dark', theme === 'dark');
    root.dataset.theme = theme;
}

export function setTheme(theme) {
    applyTheme(theme);
    try {
        localStorage.setItem(STORAGE_KEY, theme);
    } catch {
        // ignore
    }
}

export function initTheme() {
    applyTheme(getInitialTheme());

    const btn = document.querySelector('[data-icu-theme-toggle]');
    if (!btn) return;

    btn.addEventListener('click', () => {
        const current = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        setTheme(current === 'dark' ? 'light' : 'dark');
    });
}
