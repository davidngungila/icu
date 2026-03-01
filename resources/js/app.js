import './bootstrap';

import { initSidebarCollapses } from './icu/sidebar';
import { initTheme } from './icu/theme';
import { initLiveGraphs } from './icu/live-graphs';
import './icu/doctor-waveforms';
import './icu/doctor-trends';
import './icu/doctor-dashboard-waves';
import './icu/doctor-live-monitor';

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initTheme();
        initSidebarCollapses();
        initLiveGraphs();
    });
} else {
    initTheme();
    initSidebarCollapses();
    initLiveGraphs();
}
