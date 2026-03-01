<div class="h-full flex flex-col">
    <div class="px-5 py-4 border-b border-slate-200/80">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-semibold">ICU</div>
            <div class="min-w-0">
                <div class="text-sm font-semibold leading-5 truncate">ICU System</div>
                <div class="text-xs text-slate-500 truncate">{{ $roleLabel ?? '' }}</div>
            </div>
        </div>
    </div>

    <div class="px-5 pt-4 pb-2">
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
                    <span class="truncate">{{ $item['label'] }}</span>
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
                    <span class="truncate">{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>
</div>
