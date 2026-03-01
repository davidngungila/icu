@props([
    'title' => 'Dashboard',
    'roles' => [],
    'role' => null,
])

<div class="h-full bg-white/90 backdrop-blur border-b border-slate-200/80 flex items-center">
    <div class="px-6 w-full flex items-center justify-between gap-4">
        <div class="flex items-center gap-3 min-w-0">
            <a href="{{ route('icu.page', ['page' => 'dashboard']) }}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center">←</a>
            <div class="min-w-0">
                <div class="text-sm font-semibold truncate">{{ $title ?? 'Dashboard' }}</div>
                <div class="text-xs text-slate-500 truncate">Real-time ICU monitoring</div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="button" class="relative w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200" data-icu-theme-toggle>
                <span class="sr-only">Toggle theme</span>
                <span class="absolute inset-0 flex items-center justify-center">◐</span>
            </button>

            <form method="POST" action="{{ route('icu.setRole') }}" class="hidden sm:flex items-center gap-2">
                @csrf
                <label class="text-xs text-slate-500">Role</label>
                <select name="role" class="text-sm border border-slate-200 rounded-xl px-3 py-2 bg-white" onchange="this.form.submit()">
                    @foreach ($roles as $key => $label)
                        <option value="{{ $key }}" @selected(($role ?? '') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </form>

            <!-- Notifications dropdown -->
            <div class="relative group">
                <button type="button" class="relative w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200">
                    <span class="sr-only">Notifications</span>
                    <span class="absolute inset-0 flex items-center justify-center">🔔</span>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-rose-500 rounded-full"></span>
                </button>
                <div class="absolute right-0 mt-2 w-80 bg-white border border-slate-200/80 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                    <div class="p-4 border-b border-slate-200/80">
                        <div class="text-sm font-semibold">Notifications</div>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <div class="p-4 text-sm text-slate-500">No new notifications</div>
                    </div>
                </div>
            </div>

            <!-- Profile dropdown -->
            <div class="relative group">
                <button type="button" class="flex items-center gap-2 rounded-xl hover:bg-slate-50 transition-colors">
                    @if (auth()->user()?->profile_photo_path)
                        <img class="w-10 h-10 rounded-full object-cover border border-slate-200/80" src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Profile photo" />
                    @else
                        <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-900 flex items-center justify-center font-semibold">
                            {{ mb_substr(auth()->user()?->name ?? 'U', 0, 1) }}
                        </div>
                    @endif
                    <div class="hidden md:block text-left">
                        <div class="text-sm font-semibold">Super Admin</div>
                        <div class="text-xs text-slate-500">{{ auth()->user()?->email ?? '' }}</div>
                    </div>
                </button>
                <div class="absolute right-0 mt-2 w-56 bg-white border border-slate-200/80 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                    <div class="py-1">
                        <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-slate-50 transition-colors">
                            <span class="text-base">👤</span>
                            <span>Profile</span>
                        </a>
                        <a href="{{ route('settings.account') }}" class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-slate-50 transition-colors">
                            <span class="text-base">⚙️</span>
                            <span>Account Settings</span>
                        </a>
                        <a href="{{ route('settings.security') }}" class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-slate-50 transition-colors">
                            <span class="text-base">🔒</span>
                            <span>Security</span>
                        </a>
                        <div class="border-t border-slate-200/80 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-sm hover:bg-slate-50 transition-colors text-left">
                                <span class="text-base">🚪</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
