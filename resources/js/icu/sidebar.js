const STORAGE_KEY = 'icu.sidebar.collapsedGroups';
const SIDEBAR_STORAGE_KEY = 'icu.sidebar.collapsed';

function readCollapsedGroups() {
    try {
        const raw = localStorage.getItem(STORAGE_KEY);
        const parsed = raw ? JSON.parse(raw) : [];
        return Array.isArray(parsed) ? parsed : [];
    } catch {
        return [];
    }
}

function readSidebarCollapsed() {
    try {
        const raw = localStorage.getItem(SIDEBAR_STORAGE_KEY);
        if (raw === null) return true;
        return raw === 'true';
    } catch {
        return true;
    }
}

function writeSidebarCollapsed(collapsed) {
    try {
        localStorage.setItem(SIDEBAR_STORAGE_KEY, collapsed ? 'true' : 'false');
    } catch {
        // ignore
    }
}

function writeCollapsedGroups(groups) {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(groups));
    } catch {
        // ignore
    }
}

function setExpanded(buttonEl, panelEl, expanded) {
    buttonEl.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    panelEl.classList.toggle('hidden', !expanded);
    const chevron = buttonEl.querySelector('[data-icu-chevron]');
    if (chevron) {
        chevron.style.transform = expanded ? 'rotate(0deg)' : 'rotate(-90deg)';
        chevron.style.transition = 'transform 120ms ease';
    }
}

export function initSidebarCollapses() {
    const body = document.body;
    const isCollapsed = readSidebarCollapsed();
    body.classList.toggle('icu-sidebar-collapsed', isCollapsed);

    const collapseToggle = document.querySelector('[data-icu-sidebar-toggle]');
    if (collapseToggle) {
        collapseToggle.addEventListener('click', () => {
            const next = !body.classList.contains('icu-sidebar-collapsed');
            body.classList.toggle('icu-sidebar-collapsed', next);
            writeSidebarCollapsed(next);
        });
    }

    const toggles = document.querySelectorAll('[data-icu-collapse-toggle]');
    if (!toggles.length) return;

    const collapsed = new Set(readCollapsedGroups());

    toggles.forEach((btn) => {
        const targetId = btn.getAttribute('data-icu-collapse-target');
        if (!targetId) return;
        const panel = document.getElementById(targetId);
        if (!panel) return;

        const isInitiallyExpanded = btn.getAttribute('aria-expanded') === 'true';
        const shouldCollapse = collapsed.has(targetId) && !isInitiallyExpanded;

        setExpanded(btn, panel, !shouldCollapse);

        btn.addEventListener('click', () => {
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            const next = !expanded;
            setExpanded(btn, panel, next);

            if (!next) {
                collapsed.add(targetId);
            } else {
                collapsed.delete(targetId);
            }
            writeCollapsedGroups(Array.from(collapsed));
        });
    });
}
