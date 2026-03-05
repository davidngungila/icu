@props([
    'active' => true,
    'size' => 'sm',
    'label' => 'Real-time data'
])

@php
    $sizeClasses = [
        'xs' => 'w-1.5 h-1.5',
        'sm' => 'w-2 h-2',
        'md' => 'w-2.5 h-2.5',
    ];

    $indicatorClass = ($sizeClasses[$size] ?? $sizeClasses['sm']) . ' rounded-full';
    $animationClass = $active ? 'animate-pulse' : '';
@endphp

<span 
    class="inline-block bg-emerald-500 {{ $indicatorClass }} {{ $animationClass }} icu-realtime-indicator"
    title="{{ $label }}"
    role="status"
    aria-label="{{ $label }}"
></span>
