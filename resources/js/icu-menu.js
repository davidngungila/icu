/**
 * ICU Advanced Menu System JavaScript
 * Handles responsive behavior, accessibility, and real-time updates
 */

class ICUMenuSystem {
    constructor() {
        this.sidebar = null;
        this.overlay = null;
        this.toggleButton = null;
        this.isCollapsed = false;
        this.isMobile = false;
        this.currentBreakpoint = this.getCurrentBreakpoint();
        
        this.init();
    }

    init() {
        this.cacheElements();
        this.bindEvents();
        this.checkResponsive();
        this.initKeyboardNavigation();
        this.initRealtimeUpdates();
        this.initAccessibility();
    }

    cacheElements() {
        this.sidebar = document.getElementById('icuSidebar');
        this.toggleButton = document.querySelector('[data-icu-sidebar-toggle]');
        this.menuLabels = document.querySelectorAll('[data-icu-sidebar-label]');
        this.collapseToggles = document.querySelectorAll('[data-icu-collapse-toggle]');
        this.realtimeItems = document.querySelectorAll('[data-realtime="true"]');
    }

    bindEvents() {
        // Sidebar toggle
        if (this.toggleButton) {
            this.toggleButton.addEventListener('click', () => this.toggleSidebar());
        }

        // Collapse/expand menu groups
        this.collapseToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => this.toggleMenuGroup(e));
        });

        // Window resize
        window.addEventListener('resize', this.debounce(() => this.checkResponsive(), 250));

        // Escape key to close mobile menu
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isMobile && this.sidebar?.classList.contains('mobile-open')) {
                this.closeMobileMenu();
            }
        });

        // Touch gestures for mobile
        this.initTouchGestures();
    }

    toggleSidebar() {
        if (this.isMobile) {
            this.toggleMobileMenu();
        } else {
            this.toggleDesktopCollapse();
        }
    }

    toggleMobileMenu() {
        if (!this.sidebar) return;

        const isOpen = this.sidebar.classList.contains('mobile-open');
        
        if (isOpen) {
            this.closeMobileMenu();
        } else {
            this.openMobileMenu();
        }
    }

    openMobileMenu() {
        this.sidebar?.classList.add('mobile-open');
        this.createOverlay();
        document.body.style.overflow = 'hidden';
        
        // Focus management
        const firstMenuItem = this.sidebar?.querySelector('.icu-menu-item');
        if (firstMenuItem) {
            setTimeout(() => firstMenuItem.focus(), 100);
        }
    }

    closeMobileMenu() {
        this.sidebar?.classList.remove('mobile-open');
        this.removeOverlay();
        document.body.style.overflow = '';
        
        // Return focus to toggle button
        if (this.toggleButton) {
            this.toggleButton.focus();
        }
    }

    toggleDesktopCollapse() {
        if (!this.sidebar) return;

        this.isCollapsed = !this.isCollapsed;
        this.sidebar.classList.toggle('collapsed', this.isCollapsed);
        
        // Update ARIA attributes
        this.toggleButton?.setAttribute('aria-expanded', !this.isCollapsed);
        
        // Save preference
        localStorage.setItem('icu_sidebar_collapsed', this.isCollapsed);
        
        // Animate labels
        this.animateLabels();
    }

    animateLabels() {
        this.menuLabels.forEach((label, index) => {
            if (this.isCollapsed) {
                label.style.transitionDelay = `${index * 50}ms`;
                label.style.opacity = '0';
            } else {
                label.style.transitionDelay = `${index * 50}ms`;
                setTimeout(() => {
                    label.style.opacity = '1';
                }, 100);
            }
        });
    }

    toggleMenuGroup(e) {
        const button = e.currentTarget;
        const targetId = button.getAttribute('data-icu-collapse-target');
        const panel = document.getElementById(targetId);
        const chevron = button.querySelector('[data-icu-chevron]');
        
        if (!panel) return;

        const isExpanded = panel.classList.contains('expanded');
        
        // Update ARIA attributes
        button.setAttribute('aria-expanded', !isExpanded);
        
        // Toggle panel
        panel.classList.toggle('expanded', !isExpanded);
        
        // Rotate chevron
        chevron?.classList.toggle('rotated', !isExpanded);
        
        // Save state
        const groupId = targetId.replace('menu-group-', '');
        localStorage.setItem(`icu_menu_group_${groupId}_expanded`, !isExpanded);
    }

    checkResponsive() {
        const newBreakpoint = this.getCurrentBreakpoint();
        
        if (newBreakpoint !== this.currentBreakpoint) {
            this.currentBreakpoint = newBreakpoint;
            this.handleBreakpointChange();
        }
    }

    getCurrentBreakpoint() {
        const width = window.innerWidth;
        
        if (width < 640) return 'mobile';
        if (width < 768) return 'tablet';
        if (width < 1024) return 'desktop';
        return 'large';
    }

    handleBreakpointChange() {
        this.isMobile = this.currentBreakpoint === 'mobile';
        
        // Reset states when switching breakpoints
        if (!this.isMobile) {
            this.closeMobileMenu();
            this.restoreDesktopState();
        }
    }

    restoreDesktopState() {
        const savedCollapsed = localStorage.getItem('icu_sidebar_collapsed') === 'true';
        this.isCollapsed = savedCollapsed;
        this.sidebar?.classList.toggle('collapsed', savedCollapsed);
        
        // Restore menu group states
        this.collapseToggles.forEach(toggle => {
            const targetId = toggle.getAttribute('data-icu-collapse-target');
            const groupId = targetId.replace('menu-group-', '');
            const isExpanded = localStorage.getItem(`icu_menu_group_${groupId}_expanded`) === 'true';
            
            const panel = document.getElementById(targetId);
            const chevron = toggle.querySelector('[data-icu-chevron]');
            
            if (panel) {
                panel.classList.toggle('expanded', isExpanded);
                panel.classList.toggle('hidden', !isExpanded);
            }
            
            chevron?.classList.toggle('rotated', isExpanded);
            toggle.setAttribute('aria-expanded', isExpanded);
        });
    }

    initKeyboardNavigation() {
        // Arrow key navigation
        this.sidebar?.addEventListener('keydown', (e) => {
            const focusedElement = document.activeElement;
            const menuItems = Array.from(this.sidebar.querySelectorAll('.icu-menu-item:not([disabled])'));
            const currentIndex = menuItems.indexOf(focusedElement);
            
            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    this.navigateMenu(menuItems, currentIndex, 1);
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    this.navigateMenu(menuItems, currentIndex, -1);
                    break;
                case 'Home':
                    e.preventDefault();
                    menuItems[0]?.focus();
                    break;
                case 'End':
                    e.preventDefault();
                    menuItems[menuItems.length - 1]?.focus();
                    break;
            }
        });

        // Focus indicators
        this.sidebar?.addEventListener('focusin', (e) => {
            if (e.target.classList.contains('icu-menu-item')) {
                e.target.classList.add('keyboard-focused');
            }
        });

        this.sidebar?.addEventListener('focusout', (e) => {
            if (e.target.classList.contains('icu-menu-item')) {
                e.target.classList.remove('keyboard-focused');
            }
        });
    }

    navigateMenu(items, currentIndex, direction) {
        let newIndex = currentIndex + direction;
        
        // Wrap around
        if (newIndex < 0) newIndex = items.length - 1;
        if (newIndex >= items.length) newIndex = 0;
        
        items[newIndex]?.focus();
    }

    initRealtimeUpdates() {
        // WebSocket connection for real-time updates
        this.initWebSocket();
        
        // Periodic badge updates
        setInterval(() => this.updateBadges(), 30000);
        
        // Real-time indicators
        this.animateRealtimeIndicators();
    }

    initWebSocket() {
        // In production, connect to your WebSocket server
        // For now, we'll simulate updates
        this.simulateRealtimeUpdates();
    }

    simulateRealtimeUpdates() {
        setInterval(() => {
            // Simulate badge count changes
            const badges = document.querySelectorAll('.icu-badge');
            badges.forEach(badge => {
                if (Math.random() > 0.8) {
                    const currentCount = parseInt(badge.textContent) || 0;
                    const change = Math.random() > 0.5 ? 1 : -1;
                    const newCount = Math.max(0, currentCount + change);
                    
                    if (newCount !== currentCount) {
                        this.animateBadgeUpdate(badge, newCount);
                    }
                }
            });
        }, 10000);
    }

    animateBadgeUpdate(badge, newCount) {
        badge.style.transform = 'scale(1.2)';
        badge.textContent = newCount > 99 ? '99+' : newCount;
        
        setTimeout(() => {
            badge.style.transform = 'scale(1)';
        }, 200);
    }

    updateBadges() {
        // Fetch latest badge counts from server
        fetch('/api/menu/badges')
            .then(response => response.json())
            .then(data => this.updateBadgeElements(data))
            .catch(error => console.error('Failed to update badges:', error));
    }

    updateBadgeElements(data) {
        Object.entries(data).forEach(([key, count]) => {
            const badge = document.querySelector(`[data-badge="${key}"]`);
            if (badge && count !== parseInt(badge.textContent)) {
                this.animateBadgeUpdate(badge, count);
            }
        });
    }

    animateRealtimeIndicators() {
        this.realtimeItems.forEach(item => {
            const indicator = document.createElement('span');
            indicator.className = 'icu-realtime-indicator';
            item.appendChild(indicator);
        });
    }

    initAccessibility() {
        // Screen reader announcements
        this.initScreenReaderAnnouncements();
        
        // High contrast mode detection
        this.detectHighContrast();
        
        // Reduced motion detection
        this.detectReducedMotion();
    }

    initScreenReaderAnnouncements() {
        const announcer = document.createElement('div');
        announcer.setAttribute('aria-live', 'polite');
        announcer.setAttribute('aria-atomic', 'true');
        announcer.className = 'sr-only';
        document.body.appendChild(announcer);
        
        this.announcer = announcer;
    }

    announce(message) {
        if (this.announcer) {
            this.announcer.textContent = message;
            setTimeout(() => {
                this.announcer.textContent = '';
            }, 1000);
        }
    }

    detectHighContrast() {
        if (window.matchMedia('(prefers-contrast: high)').matches) {
            document.body.classList.add('high-contrast');
        }
    }

    detectReducedMotion() {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.body.classList.add('reduced-motion');
        }
    }

    initTouchGestures() {
        if (!this.isMobile) return;
        
        let touchStartX = 0;
        let touchEndX = 0;
        
        this.sidebar.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        this.sidebar.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe(touchStartX, touchEndX);
        });
    }

    handleSwipe(startX, endX) {
        const swipeThreshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - close menu
                this.closeMobileMenu();
            } else {
                // Swipe right - open menu (if not already open)
                if (!this.sidebar?.classList.contains('mobile-open')) {
                    this.openMobileMenu();
                }
            }
        }
    }

    createOverlay() {
        if (document.querySelector('.icu-sidebar-overlay')) return;
        
        this.overlay = document.createElement('div');
        this.overlay.className = 'icu-sidebar-overlay';
        this.overlay.addEventListener('click', () => this.closeMobileMenu());
        document.body.appendChild(this.overlay);
        
        setTimeout(() => this.overlay?.classList.add('active'), 10);
    }

    removeOverlay() {
        if (this.overlay) {
            this.overlay.classList.remove('active');
            setTimeout(() => {
                this.overlay?.remove();
                this.overlay = null;
            }, 300);
        }
    }

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Public API
    publicAPI() {
        return {
            toggleSidebar: () => this.toggleSidebar(),
            openMobileMenu: () => this.openMobileMenu(),
            closeMobileMenu: () => this.closeMobileMenu(),
            updateBadges: () => this.updateBadges(),
            announce: (message) => this.announce(message)
        };
    }
}

// Initialize the menu system
document.addEventListener('DOMContentLoaded', () => {
    window.ICUMenu = new ICUMenuSystem();
    
    // Make API available globally
    window.ICUMenuAPI = window.ICUMenu.publicAPI();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ICUMenuSystem;
}
