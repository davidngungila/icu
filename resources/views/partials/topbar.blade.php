<header class="h-16 bg-white border-b border-slate-200/80 flex items-center">
    <div class="px-6 w-full flex items-center justify-between gap-4">
        <div class="flex items-center gap-3 min-w-0">
            <a href="{{ route('icu.page', ['page' => 'dashboard']) }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center">←</a>
            <div class="min-w-0">
                <div class="text-sm font-semibold truncate">{{ $title ?? 'Dashboard' }}</div>
                <div class="text-xs text-slate-500 truncate">Real-time ICU monitoring</div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <form method="POST" action="{{ route('icu.setRole') }}" class="hidden sm:flex items-center gap-2">
                @csrf
                <label class="text-xs text-slate-500">Role</label>
                <select name="role" class="text-sm border border-slate-200 rounded-xl px-3 py-2 bg-white" onchange="this.form.submit()">
                    @foreach ($roles as $key => $label)
                        <option value="{{ $key }}" @selected(($role ?? '') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </form>

            <button type="button" class="relative w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200">
                <span class="sr-only">Notifications</span>
                <span class="absolute inset-0 flex items-center justify-center">🔔</span>
            </button>

            <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-900 flex items-center justify-center font-semibold">
                U
            </div>
        </div>
    </div>
</header>
