@props([
    'menus' => [],
    'page' => 'dashboard',
    'roleLabel' => '',
    'collapsed' => false,
    'compact' => false,
])

@php
    $icon = function (?string $key): string {
        return match ($key) {
            'dashboard' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-8 9 8"/><path d="M9 22V12h6v10"/></svg>',
            'user' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg>',
            'device' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="6" width="16" height="12" rx="2"/><path d="M8 18v2"/><path d="M16 18v2"/><path d="M8 10h8"/></svg>',
            'settings' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z"/><path d="M19.4 15a1.8 1.8 0 0 0 .36 1.98l.05.05a2 2 0 0 1-1.41 3.41 2 2 0 0 1-1.41-.59l-.05-.05a1.8 1.8 0 0 0-1.98-.36 1.8 1.8 0 0 0-1.09 1.64V23a2 2 0 0 1-4 0v-.08A1.8 1.8 0 0 0 8.5 21.3a1.8 1.8 0 0 0-1.98.36l-.05.05A2 2 0 0 1 3.05 20.3a2 2 0 0 1 .59-1.41l.05-.05A1.8 1.8 0 0 0 4.05 15a1.8 1.8 0 0 0-1.64-1.09H2.33a2 2 0 0 1 0-4h.08A1.8 1.8 0 0 0 4.05 8.5a1.8 1.8 0 0 0-.36-1.98l-.05-.05A2 2 0 0 1 5.05 3.05a2 2 0 0 1 1.41.59l.05.05a1.8 1.8 0 0 0 1.98.36A1.8 1.8 0 0 0 9.58 3V2.92a2 2 0 0 1 4 0V3a1.8 1.8 0 0 0 1.09 1.64 1.8 1.8 0 0 0 1.98-.36l.05-.05A2 2 0 0 1 20.95 5.05a2 2 0 0 1-.59 1.41l-.05.05a1.8 1.8 0 0 0-.36 1.98 1.8 1.8 0 0 0 1.64 1.09H22a2 2 0 0 1 0 4h-.08A1.8 1.8 0 0 0 19.4 15Z"/></svg>',
            'audit' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4"/><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/></svg>',
            'cloud' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 17.5a4.5 4.5 0 0 0-1.8-8.65A6 6 0 0 0 6.5 9.5a4 4 0 0 0 .5 8h13Z"/></svg>',
            'patients' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 21h8"/><path d="M12 17v4"/><path d="M7 4h10"/><path d="M7 4v8a5 5 0 0 0 10 0V4"/></svg>',
            'alerts' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.3 3.1 2.7 17.8A2 2 0 0 0 4.5 20h15a2 2 0 0 0 1.8-2.2L13.7 3.1a2 2 0 0 0-3.4 0Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>',
            'reports' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M7 14l3-3 4 4 5-7"/></svg>',
            'tools' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18v3h3l6.3-6.3a4 4 0 0 0 5.4-5.4l-3 3-2-2 3-3Z"/></svg>',
            'monitor' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/></svg>',
            'workflow' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>',
            'heart' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
            'pills' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><path d="M15 13l6 6"/><circle cx="16" cy="16" r="6"/></svg>',
            'clipboard' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="2" width="6" height="4" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/></svg>',
            'bed' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M6 16h.01"/><path d="M10 16h.01"/><path d="M14 16h.01"/><path d="M18 16h.01"/></svg>',
            'lungs' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 18.97C5.64 17.56 4 14.67 4 11.5 4 7.91 7.91 4 11.5 4c1.52 0 2.91.5 4.03 1.34"/><path d="M15.5 18.97c2.86-1.41 4.5-4.3 4.5-7.47 0-3.59-3.91-7.5-7.5-7.5-1.52 0-2.91.5-4.03 1.34"/></svg>',
            'droplet' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>',
            'heart-pulse' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/><path d="M9 10h1v4h1l2-4h1v4h1l2-4h1"/></svg>',
            'user-plus' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>',
            'file-medical' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14,2 14,8 20,8"/><path d="M10 13h4"/><path d="M12 11v4"/></svg>',
            'user-minus' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="22" x2="16" y1="11" y2="11"/></svg>',
            'repeat' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 4v6h6"/><path d="M23 20v-6h-6"/><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"/></svg>',
            'trending-up' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23,6 13.5,15.5 8.5,10.5 1,18"/><polyline points="17,6 23,6 23,12"/></svg>',
            'bar-chart' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>',
            'shield-check' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg>',
            'award' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"/><polyline points="8.21,13.89 7,23 12,20 17,23 15.79,13.88"/></svg>',
            'message-square' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
            'phone-call' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/><path d="M14.05 2a9 9 0 0 1 8 7.94"/><path d="M14.05 6A5 5 0 0 1 18 10"/></svg>',
            'user-check' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16,11 18,13 22,9"/></svg>',
            'alert-triangle' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>',
            'help-circle' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>',
            'book-open' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
            'graduation-cap' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
            'headphones' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>',
            'server' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="4" rx="1"/><rect x="2" y="9" width="20" height="4" rx="1"/><rect x="2" y="15" width="20" height="4" rx="1"/><path d="M6 5h.01M6 11h.01M6 17h.01"/></svg>',
            'activity' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>',
            'menu' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>',
            default => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/></svg>',
        };
    };

    $iconKeyForLabel = function (string $label): string {
        $l = mb_strtolower($label);
        return match (true) {
            str_contains($l, 'dashboard') => 'dashboard',
            str_contains($l, 'user') => 'user',
            str_contains($l, 'device') || str_contains($l, 'vent') || str_contains($l, 'sensor') || str_contains($l, 'pump') => 'device',
            str_contains($l, 'setting') || str_contains($l, 'network') || str_contains($l, 'backup') => 'settings',
            str_contains($l, 'audit') || str_contains($l, 'compliance') || str_contains($l, 'pdpa') || str_contains($l, 'hisg') || str_contains($l, 'tmda') => 'audit',
            str_contains($l, 'server') || str_contains($l, 'cloud') || str_contains($l, 'failover') => 'cloud',
            str_contains($l, 'patient') || str_contains($l, 'bed') => 'patients',
            str_contains($l, 'alert') => 'alerts',
            str_contains($l, 'report') || str_contains($l, 'trend') || str_contains($l, 'analytics') => 'reports',
            str_contains($l, 'monitor') || str_contains($l, 'vitals') || str_contains($l, 'stream') => 'monitor',
            str_contains($l, 'workflow') || str_contains($l, 'admission') || str_contains($l, 'discharge') || str_contains($l, 'handover') => 'workflow',
            str_contains($l, 'heart') || str_contains($l, 'cardiac') => 'heart',
            str_contains($l, 'medication') || str_contains($l, 'pill') => 'pills',
            str_contains($l, 'observation') || str_contains($l, 'note') || str_contains($l, 'clipboard') => 'clipboard',
            str_contains($l, 'bed') => 'bed',
            str_contains($l, 'ventilator') || str_contains($l, 'lung') => 'lungs',
            str_contains($l, 'infusion') || str_contains($l, 'pump') || str_contains($l, 'droplet') => 'droplet',
            str_contains($l, 'pulse') => 'heart-pulse',
            str_contains($l, 'admission') || str_contains($l, 'user-plus') => 'user-plus',
            str_contains($l, 'care plan') || str_contains($l, 'file-medical') => 'file-medical',
            str_contains($l, 'discharge') || str_contains($l, 'user-minus') => 'user-minus',
            str_contains($l, 'handover') || str_contains($l, 'repeat') => 'repeat',
            str_contains($l, 'trend') || str_contains($l, 'trending') => 'trending-up',
            str_contains($l, 'performance') || str_contains($l, 'bar') => 'bar-chart',
            str_contains($l, 'compliance') || str_contains($l, 'shield') => 'shield-check',
            str_contains($l, 'quality') || str_contains($l, 'award') => 'award',
            str_contains($l, 'communication') || str_contains($l, 'message') => 'message-square',
            str_contains($l, 'consultation') || str_contains($l, 'phone') => 'phone-call',
            str_contains($l, 'family') || str_contains($l, 'user-check') => 'user-check',
            str_contains($l, 'emergency') || str_contains($l, 'triangle') => 'alert-triangle',
            str_contains($l, 'help') || str_contains($l, 'question') => 'help-circle',
            str_contains($l, 'manual') || str_contains($l, 'book') => 'book-open',
            str_contains($l, 'training') || str_contains($l, 'graduation') => 'graduation-cap',
            str_contains($l, 'support') || str_contains($l, 'headphone') => 'headphones',
            str_contains($l, 'status') || str_contains($l, 'server') => 'server',
            default => 'menu',
        };
    };

    $renderBadge = function (?array $badge): string {
        if (!$badge || !isset($badge['count']) || $badge['count'] <= 0) {
            return '';
        }
        
        $type = $badge['type'] ?? 'info';
        $count = $badge['count'];
        $pulse = $badge['pulse'] ?? false;
        
        $typeClasses = [
            'critical' => 'bg-red-500 text-white',
            'warning' => 'bg-amber-500 text-white',
            'info' => 'bg-blue-500 text-white',
            'success' => 'bg-emerald-500 text-white',
        ];
        
        $pulseClass = $pulse ? 'animate-pulse' : '';
        $badgeClass = $typeClasses[$type] ?? $typeClasses['info'];
        
        return sprintf(
            '<span class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold rounded-full %s %s" role="status" aria-label="%d items">%s</span>',
            $badgeClass,
            $pulseClass,
            $count,
            $count > 99 ? '99+' : $count
        );
    };
    
    $hasPermission = function (array $permissions): bool {
        // In a real implementation, this would check against the current user's permissions
        // For now, we'll return true to show all menu items
        return true;
    };
    
    $isRealtime = function (?array $item): bool {
        return ($item['realtime'] ?? false) === true;
    };
@endphp

<div class="h-full flex flex-col">
    <div class="px-5 py-4 border-b border-slate-200/80">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-semibold">ICU</div>
            <div class="min-w-0" data-icu-sidebar-label>
                <div class="text-sm font-semibold leading-5 truncate">ICU System</div>
                <div class="text-xs text-slate-500 truncate" data-icu-sidebar-subtitle>{{ $roleLabel }}</div>
            </div>

            <div class="ml-auto">
                <button type="button" class="w-9 h-9 rounded-xl hover:bg-slate-100 flex items-center justify-center text-slate-600" data-icu-sidebar-toggle>
                    <span class="sr-only">Toggle sidebar</span>
                    <span class="w-5 h-5" aria-hidden="true">{!! $icon('menu') !!}</span>
                </button>
            </div>
        </div>
    </div>

    <div class="px-5 pt-4 pb-2" data-icu-sidebar-section>
        <div class="text-[11px] uppercase tracking-wider text-slate-500">Menus</div>
    </div>

    <nav class="px-3 pb-6 overflow-y-auto">
        @foreach ($menus as $index => $item)
            @php
                $hasChildren = isset($item['children']) && is_array($item['children']) && count($item['children']) > 0;
                $directPage = $item['page'] ?? ($item['params']['page'] ?? null);
                $isActive = $directPage ? ($page === $directPage) : false;
                if ($hasChildren) {
                    foreach ($item['children'] as $child) {
                        if (($child['page'] ?? null) === $page) {
                            $isActive = true;
                            break;
                        }
                    }
                }
                $groupId = 'menu-group-'.$index;
            @endphp

            @if ($hasChildren)
                <button type="button"
                    class="w-full mt-1 px-3 py-2 rounded-xl flex items-center justify-between text-sm font-medium {{ $isActive ? 'bg-emerald-50 text-emerald-900 ring-1 ring-emerald-100' : 'hover:bg-slate-50 text-slate-700' }} group"
                    data-icu-collapse-toggle
                    data-icu-collapse-target="{{ $groupId }}"
                    aria-controls="{{ $groupId }}"
                    aria-expanded="{{ $isActive ? 'true' : 'false' }}"
                    @if (!$hasPermission($item['permissions'] ?? [])) disabled aria-disabled="true" @endif
                >
                    <span class="flex items-center gap-3 min-w-0">
                        <span class="w-5 h-5 shrink-0 text-slate-500 group-hover:text-slate-600">{!! $icon($iconKeyForLabel($item['label'])) !!}</span>
                        <span class="truncate" data-icu-sidebar-label>{{ $item['label'] }}</span>
                        @if ($isRealtime($item))
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse" title="Real-time data"></span>
                        @endif
                    </span>
                    <div class="flex items-center gap-2">
                        {!! $renderBadge($item['badge'] ?? null) !!}
                        <span class="text-slate-400 transition-transform duration-200 {{ $isActive ? 'rotate-180' : '' }}" data-icu-chevron>▾</span>
                    </div>
                </button>

                <div id="{{ $groupId }}" class="ml-2 pl-3 border-l border-slate-200 mt-1 space-y-1 {{ $isActive ? '' : 'hidden' }}" data-icu-collapse-panel>
                    @foreach ($item['children'] as $child)
                        @if ($hasPermission($child['permissions'] ?? []))
                            <a
                                href="{{ route('icu.page', ['page' => $child['page']]) }}"
                                class="group flex items-center justify-between px-3 py-2 rounded-xl text-sm transition-colors {{ ($child['page'] ?? '') === $page ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:bg-slate-50' }}"
                                @if ($isRealtime($child)) data-realtime="true" @endif
                            >
                                <span class="flex items-center gap-2 min-w-0">
                                    @if ($compact)
                                        <span class="w-2 h-2 rounded-full {{ ($child['page'] ?? '') === $page ? 'bg-white' : 'bg-slate-400' }}"></span>
                                    @endif
                                    <span class="truncate">{{ $child['label'] }}</span>
                                    @if ($isRealtime($child))
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse" title="Real-time data"></span>
                                    @endif
                                </span>
                                {!! $renderBadge($child['badge'] ?? null) !!}
                            </a>
                        @endif
                    @endforeach
                </div>
            @else
                @php
                    $href = isset($item['route']) ? route($item['route'], $item['params'] ?? []) : route('icu.page', ['page' => $item['page']]);
                @endphp

                <a
                    href="{{ $href }}"
                    class="group flex items-center justify-between mt-1 px-3 py-2 rounded-xl text-sm font-medium transition-colors {{ $isActive ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}"
                    @if (!$hasPermission($item['permissions'] ?? [])) disabled aria-disabled="true" @endif
                    @if ($isRealtime($item)) data-realtime="true" @endif
                >
                    <span class="flex items-center gap-3 min-w-0">
                        <span class="w-5 h-5 shrink-0 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:text-slate-600' }}">{!! $icon($iconKeyForLabel($item['label'])) !!}</span>
                        <span class="truncate" data-icu-sidebar-label>{{ $item['label'] }}</span>
                        @if ($isRealtime($item))
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse" title="Real-time data"></span>
                        @endif
                    </span>
                    {!! $renderBadge($item['badge'] ?? null) !!}
                </a>
            @endif
        @endforeach
    </nav>
</div>
