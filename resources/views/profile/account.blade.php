@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold tracking-tight">Account Settings</h1>
            <div class="text-sm text-slate-500">Manage your preferences and configuration</div>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200/70 text-emerald-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            <!-- Preferences -->
            <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">Preferences</h2>
                    <form method="POST" action="{{ route('settings.account.update') }}" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">Language</label>
                                <select name="language" class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                                    <option value="en" {{ ($user->language ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
                                    <option value="sw" {{ ($user->language ?? '') === 'sw' ? 'selected' : '' }}>Swahili</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Timezone</label>
                                <select name="timezone" class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                                    <option value="Africa/Dar_es_Salaam" {{ ($user->timezone ?? '') === 'Africa/Dar_es_Salaam' ? 'selected' : '' }}>Africa/Dar es Salaam</option>
                                    <option value="UTC" {{ ($user->timezone ?? '') === 'UTC' ? 'selected' : '' }}>UTC</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Date Format</label>
                                <select name="date_format" class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                                    <option value="Y-m-d" {{ ($user->date_format ?? 'Y-m-d') === 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                                    <option value="m/d/Y" {{ ($user->date_format ?? '') === 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
                                    <option value="d/m/Y" {{ ($user->date_format ?? '') === 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Time Format</label>
                                <select name="time_format" class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                                    <option value="24h" {{ ($user->time_format ?? '24h') === '24h' ? 'selected' : '' }}>24-hour</option>
                                    <option value="12h" {{ ($user->time_format ?? '') === '12h' ? 'selected' : '' }}>12-hour</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2">Theme</label>
                                <select name="theme" class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                                    <option value="light" {{ ($user->theme ?? '') === 'light' ? 'selected' : '' }}>Light</option>
                                    <option value="dark" {{ ($user->theme ?? '') === 'dark' ? 'selected' : '' }}>Dark</option>
                                    <option value="auto" {{ ($user->theme ?? 'auto') === 'auto' ? 'selected' : '' }}>Auto</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-200/80">
                            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-sm font-medium">
                                Save Preferences
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Notifications -->
            <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">Notifications</h2>
                    <form method="POST" action="{{ route('settings.account.update') }}" class="space-y-3">
                        @csrf
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="notifications_email" value="1" {{ $user->notifications_email ? 'checked' : '' }} class="w-4 h-4 text-slate-900 rounded focus:ring-slate-400">
                            <span class="text-sm">Email notifications</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="notifications_push" value="1" {{ $user->notifications_push ? 'checked' : '' }} class="w-4 h-4 text-slate-900 rounded focus:ring-slate-400">
                            <span class="text-sm">Push notifications</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="notifications_sms" value="1" {{ $user->notifications_sms ? 'checked' : '' }} class="w-4 h-4 text-slate-900 rounded focus:ring-slate-400">
                            <span class="text-sm">SMS notifications</span>
                        </label>

                        <div class="pt-4 border-t border-slate-200/80">
                            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-sm font-medium">
                                Save Notification Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
