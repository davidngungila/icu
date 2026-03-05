# ICU Advanced Menu System

A sophisticated, accessible, and responsive menu system designed specifically for ICU monitoring applications. This system provides real-time updates, advanced navigation features, and comprehensive accessibility support.

## Features

### 🏥 Healthcare-Specific Design
- **Patient Care Module**: Complete patient management workflow
- **Real-time Monitoring**: Live vitals and device status indicators
- **Clinical Workflows**: Admission, care plans, discharge processes
- **Emergency Alerts**: Critical notification system
- **Medication Management**: Administration tracking and alerts

### 🎯 Advanced Navigation
- **Hierarchical Menu Structure**: Multi-level navigation with smooth animations
- **Smart Badges**: Dynamic notification counts with pulse animations
- **Real-time Indicators**: Visual feedback for live data streams
- **Keyboard Navigation**: Full keyboard accessibility with arrow keys
- **Touch Gestures**: Swipe support for mobile devices

### 📱 Responsive Design
- **Mobile-First**: Optimized for all screen sizes
- **Collapsible Sidebar**: Space-saving desktop mode
- **Touch-Friendly**: Large tap targets and gesture support
- **Adaptive Layout**: Seamless transitions between breakpoints

### ♿ Accessibility
- **WCAG 2.1 AA Compliant**: Full accessibility support
- **Screen Reader Support**: ARIA labels and live regions
- **Keyboard Navigation**: Complete keyboard control
- **High Contrast Mode**: Support for high contrast preferences
- **Reduced Motion**: Respects user motion preferences

### ⚡ Performance
- **Lazy Loading**: Menu items load on demand
- **Caching**: Intelligent cache management
- **Optimized Animations**: Hardware-accelerated transitions
- **Minimal JavaScript**: Efficient event handling

## Installation

### 1. Register the Service Provider

Add to `config/app.php`:

```php
'providers' => [
    // ...
    App\Providers\ICUMenuServiceProvider::class,
],
```

### 2. Include Assets

Add to your main layout (`resources/views/layouts/app.blade.php`):

```blade
@vite([
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/css/icu-menu.css',
    'resources/js/icu-menu.js'
])
```

### 3. Update Vite Configuration

In `vite.config.js`:

```javascript
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/icu-menu.css',
                'resources/js/icu-menu.js'
            ],
            refresh: true,
        }),
    ],
});
```

## Usage

### Basic Menu Structure

```blade
<x-icu.sidebar 
    :menus="$menus" 
    :page="$page" 
    :role-label="$roleLabel"
    :collapsed="false"
    :compact="false"
/>
```

### Menu Configuration

Define menus in `config/icu-menus.php`:

```php
return [
    'patient_care' => [
        'label' => 'Patient Care',
        'icon' => 'patients',
        'priority' => 2,
        'permissions' => ['view_patients'],
        'badge' => [
            'type' => 'critical',
            'count' => 3,
            'pulse' => true
        ],
        'children' => [
            [
                'label' => 'View Patient Vitals',
                'page' => 'patient-vitals',
                'permissions' => ['view_vitals'],
                'realtime' => true
            ],
            // ... more children
        ]
    ],
    // ... more menu items
];
```

### Badge Components

```blade
<x-icu.menu-badges 
    type="critical" 
    :count="5" 
    :pulse="true"
    size="sm"
/>
```

### Real-time Indicators

```blade
<x-icu.realtime-indicator 
    :active="true"
    size="sm"
    label="Live data stream"
/>
```

## Menu Structure

### Main Categories

1. **Dashboard**: System overview and quick stats
2. **Patient Care**: Core patient management features
   - View Patient Vitals
   - Medication Administration
   - Record Observations
   - Alerts Management
   - Device Status
   - Shift Notes
   - Bed Management
3. **Real-time Monitoring**: Live data streams
   - Live Vitals Stream
   - Ventilator Management
   - Infusion Pumps
   - Cardiac Monitors
4. **Clinical Workflows**: Process management
   - Admission Process
   - Care Plans
   - Discharge Planning
   - Handover Protocol
5. **Analytics & Reports**: Data analysis
   - Patient Trends
   - ICU Performance
   - Compliance Reports
   - Quality Metrics
6. **Communication**: Team collaboration
   - Team Messaging
   - Consultation Requests
   - Family Updates
   - Emergency Alerts
7. **System Management**: Administrative functions
   - User Management
   - Device Configuration
   - System Health
   - Backup & Recovery
   - Audit Logs
8. **Help & Support**: User assistance
   - User Manual
   - Training Resources
   - Technical Support
   - System Status

## Badge Types

### Critical Alerts
- Red background with pulse animation
- Used for life-threatening situations
- Auto-updates every 30 seconds

### Warning Alerts
- Amber background with subtle pulse
- Used for important but non-critical notifications
- Updates every 60 seconds

### Info Notifications
- Blue background
- Used for general information
- Updates every 5 minutes

### Success States
- Green background
- Used for completed actions
- Static display

## Real-time Features

### WebSocket Integration
```javascript
// Connect to real-time updates
window.ICUMenuAPI.initWebSocket({
    url: 'ws://localhost:8080/icu-updates',
    onBadgeUpdate: (data) => console.log(data),
    onAlert: (alert) => window.ICUMenuAPI.announce(alert.message)
});
```

### Badge Updates
```javascript
// Update badge counts programmatically
window.ICUMenuAPI.updateBadges();

// Listen for badge changes
document.addEventListener('badgeUpdated', (e) => {
    console.log('Badge updated:', e.detail);
});
```

## Accessibility Features

### Keyboard Navigation
- **Tab**: Navigate between menu items
- **Arrow Keys**: Move up/down through menu items
- **Enter/Space**: Activate menu items
- **Escape**: Close mobile menu
- **Home/End**: Jump to first/last item

### Screen Reader Support
- ARIA labels and descriptions
- Live regions for dynamic updates
- Semantic HTML structure
- Focus management

### High Contrast Mode
- Automatic detection
- Enhanced borders and outlines
- Improved color contrast ratios

### Reduced Motion
- Detects user preferences
- Disables animations when requested
- Maintains functionality without motion

## Mobile Features

### Touch Gestures
- **Swipe Right**: Open menu
- **Swipe Left**: Close menu
- **Tap**: Select menu items

### Responsive Behavior
- **Mobile (< 640px)**: Full-screen overlay menu
- **Tablet (640px - 768px)**: Slide-out menu
- **Desktop (> 768px)**: Fixed sidebar with collapse option

## Customization

### CSS Variables
```css
:root {
    --icu-menu-bg: #ffffff;
    --icu-menu-text: #1f2937;
    --icu-menu-active: #10b981;
    --icu-menu-hover: #f3f4f6;
    --icu-badge-critical: #ef4444;
    --icu-badge-warning: #f59e0b;
    --icu-badge-info: #3b82f6;
    --icu-badge-success: #10b981;
}
```

### JavaScript Events
```javascript
// Listen for menu events
document.addEventListener('menuOpened', () => {
    console.log('Menu opened');
});

document.addEventListener('menuClosed', () => {
    console.log('Menu closed');
});

document.addEventListener('menuItemClicked', (e) => {
    console.log('Item clicked:', e.detail.item);
});
```

## Performance Optimization

### Caching Strategy
- Menu configuration cached for 5 minutes
- Badge counts cached for 1 minute
- User permissions cached per session

### Lazy Loading
- Child menus load on first expansion
- Real-time data loads when visible
- Images and icons load on demand

### Memory Management
- Event delegation for menu items
- Cleanup on page navigation
- Efficient DOM queries

## Security Considerations

### Permission-Based Access
- All menu items filtered by user permissions
- Server-side validation for all actions
- Role-based menu visibility

### XSS Prevention
- Sanitized menu labels and descriptions
- Safe HTML rendering for badges
- Content Security Policy compatible

### CSRF Protection
- Form-based menu actions protected
- API endpoints use CSRF tokens
- Secure WebSocket connections

## Troubleshooting

### Common Issues

1. **Menu not loading**: Check service provider registration
2. **Badges not updating**: Verify cache configuration
3. **Mobile menu not working**: Check touch event listeners
4. **Keyboard navigation broken**: Verify focus management

### Debug Mode
Enable debug mode in `.env`:
```env
ICU_MENU_DEBUG=true
```

This will add console logging and visual debug indicators.

## Browser Support

- **Modern Browsers**: Chrome 90+, Firefox 88+, Safari 14+, Edge 90+
- **Mobile Browsers**: iOS Safari 14+, Chrome Mobile 90+
- **Legacy Support**: Graceful degradation for older browsers

## Contributing

1. Follow PSR-12 coding standards
2. Add tests for new features
3. Update documentation
4. Test accessibility features
5. Verify responsive behavior

## License

This menu system is part of the ICU Monitoring Solutions suite and is licensed under the MIT License.
