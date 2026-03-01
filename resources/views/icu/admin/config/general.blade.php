@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">General Settings</h1>
            <div class="text-sm text-slate-500">Core platform configuration (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search settings..." />
        </div>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-2xl border border-emerald-200/70 bg-emerald-50 px-4 py-3 text-emerald-800">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="mt-4 rounded-2xl border border-rose-200/70 bg-rose-50 px-4 py-3 text-rose-800">
            <div class="font-semibold text-sm">Please fix the following:</div>
            <ul class="mt-2 text-sm list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php $g = $generalSettings; @endphp

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="text-sm font-semibold">Platform</div>
        <div class="mt-1 text-sm text-slate-500">Saved in DB + audited.</div>

        <form method="POST" action="{{ route('admin.config.general.update') }}" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <div class="md:col-span-2">
                <div class="text-xs text-slate-500">Hospital name</div>
                <input name="hospital_name" value="{{ old('hospital_name', $g?->hospital_name ?? '') }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
            </div>

            <div>
                <div class="text-xs text-slate-500">Timezone</div>
                <input name="timezone" value="{{ old('timezone', $g?->timezone ?? '') }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
            </div>

            <div>
                <div class="text-xs text-slate-500">Locale</div>
                <input name="locale" value="{{ old('locale', $g?->locale ?? '') }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
            </div>

            <div class="flex items-center gap-2 pt-6">
                <input type="checkbox" name="maintenance_mode" value="1" class="rounded border-slate-300" @checked((bool) old('maintenance_mode', $g?->maintenance_mode ?? false)) />
                <div class="text-sm">Maintenance mode</div>
            </div>

            <div class="flex items-center gap-2 pt-6">
                <input type="checkbox" name="alerts_enabled" value="1" class="rounded border-slate-300" @checked((bool) old('alerts_enabled', $g?->alerts_enabled ?? true)) />
                <div class="text-sm">Enable alerts</div>
            </div>

            <div>
                <div class="text-xs text-slate-500">Data retention policy</div>
                <input name="data_retention_policy" value="{{ old('data_retention_policy', $g?->data_retention_policy ?? '') }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="365d" />
            </div>

            <div>
                <div class="text-xs text-slate-500">Default alert severity</div>
                @php $ds = old('default_severity', $g?->default_severity ?? 'medium'); @endphp
                <select name="default_severity" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                    <option value="low" @selected($ds === 'low')>low</option>
                    <option value="medium" @selected($ds === 'medium')>medium</option>
                    <option value="high" @selected($ds === 'high')>high</option>
                    <option value="critical" @selected($ds === 'critical')>critical</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Save General Settings</button>
            </div>
        </form>
    </div>
@endsection
