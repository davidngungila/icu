@props([
    'variant' => 'stable',
])

@php
    $variants = [
        'stable' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-100',
        'warning' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-100',
        'critical' => 'bg-rose-50 text-rose-700 ring-1 ring-rose-100',
    ];

    $classes = $variants[$variant] ?? $variants['stable'];
@endphp

<span {{ $attributes->merge(['class' => 'px-3 py-1.5 rounded-full text-xs font-medium '.$classes]) }}>
    {{ $slot }}
</span>
