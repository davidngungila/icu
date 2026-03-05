@props([
    'type' => 'info',
    'count' => 0,
    'pulse' => false,
    'size' => 'sm',
    'ariaLabel' => null
])

@php
    $sizeClasses = [
        'xs' => 'w-4 h-4 text-xs',
        'sm' => 'w-5 h-5 text-xs',
        'md' => 'w-6 h-6 text-sm',
    ];

    $typeClasses = [
        'critical' => 'bg-red-500 text-white shadow-red-200',
        'warning' => 'bg-amber-500 text-white shadow-amber-200',
        'info' => 'bg-blue-500 text-white shadow-blue-200',
        'success' => 'bg-emerald-500 text-white shadow-emerald-200',
    ];

    $badgeClass = ($sizeClasses[$size] ?? $sizeClasses['sm']) . ' ' . ($typeClasses[$type] ?? $typeClasses['info']);
    $pulseClass = $pulse ? 'animate-pulse' : '';
    $displayCount = $count > 99 ? '99+' : $count;
    $label = $ariaLabel ?? "{$count} {$type} items";
@endphp

@if ($count > 0)
    <span 
        class="inline-flex items-center justify-center font-bold rounded-full {{ $badgeClass }} {{ $pulseClass }} icu-badge"
        role="status"
        aria-label="{{ $label }}"
        data-badge-type="{{ $type }}"
        data-badge-count="{{ $count }}"
    >
        {{ $displayCount }}
    </span>
@endif
