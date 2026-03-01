@props([
    'menus' => [],
    'page' => 'dashboard',
    'roleLabel' => '',
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
            str_contains($l, 'tool') || str_contains($l, 'diagnostic') || str_contains($l, 'firmware') => 'tools',
            default => 'menu',
        };
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
                    class="w-full mt-1 px-3 py-2 rounded-xl flex items-center justify-between text-sm font-medium {{ $isActive ? 'bg-emerald-50 text-emerald-900 ring-1 ring-emerald-100' : 'hover:bg-slate-50 text-slate-700' }}"
                    data-icu-collapse-toggle
                    data-icu-collapse-target="{{ $groupId }}"
                    aria-controls="{{ $groupId }}"
                    aria-expanded="{{ $isActive ? 'true' : 'false' }}"
                >
                    <span class="flex items-center gap-3 min-w-0">
                        <span class="w-5 h-5 shrink-0 text-slate-500">{!! $icon($iconKeyForLabel($item['label'])) !!}</span>
                        <span class="truncate" data-icu-sidebar-label>{{ $item['label'] }}</span>
                    </span>
                    <span class="text-slate-400" data-icu-chevron>▾</span>
                </button>

                <div id="{{ $groupId }}" class="ml-2 pl-3 border-l border-slate-200 mt-1 {{ $isActive ? '' : 'hidden' }}" data-icu-collapse-panel>
                    @foreach ($item['children'] as $child)
                        <a
                            href="{{ route('icu.page', ['page' => $child['page']]) }}"
                            class="block px-3 py-2 rounded-xl text-sm {{ ($child['page'] ?? '') === $page ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:bg-slate-50' }}"
                        >
                            <span class="truncate">{{ $child['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            @else
                @php
                    $href = isset($item['route']) ? route($item['route'], $item['params'] ?? []) : route('icu.page', ['page' => $item['page']]);
                @endphp

                <a
                    href="{{ $href }}"
                    class="block mt-1 px-3 py-2 rounded-xl text-sm font-medium {{ $isActive ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }}"
                >
                    <span class="flex items-center gap-3 min-w-0">
                        <span class="w-5 h-5 shrink-0 {{ $isActive ? 'text-white' : 'text-slate-500' }}">{!! $icon($iconKeyForLabel($item['label'])) !!}</span>
                        <span class="truncate" data-icu-sidebar-label>{{ $item['label'] }}</span>
                    </span>
                </a>
            @endif
        @endforeach
    </nav>
</div>
