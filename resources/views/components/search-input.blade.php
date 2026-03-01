@props([
    'placeholder' => 'Search...',
    'value' => null,
    'name' => null,
])

<div class="relative">
    <input
        type="search"
        @if($name) name="{{ $name }}" @endif
        value="{{ $value ?? '' }}"
        placeholder="{{ $placeholder }}"
        class="w-full sm:w-[320px] pl-10 pr-3 py-2 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-emerald-200"
    />
    <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">⌕</div>
</div>
