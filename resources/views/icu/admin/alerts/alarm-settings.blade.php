@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Alarm & Night Mode</h1>
            <div class="text-sm text-slate-500">Configure alarm policies, quiet hours, and snooze rules (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search settings..." />
        </div>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-2xl border border-emerald-200/70 bg-emerald-50 px-4 py-3 text-emerald-800">
            {{ session('status') }}
        </div>
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

    @php
        $s = $alarmSettings;
        $nightEnabled = (bool) ($s?->night_mode_enabled ?? false);
    @endphp

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Current Mode</div>
            <div class="mt-3">
                @if ($nightEnabled)
                    <x-status-badge variant="warning">Night Mode Enabled</x-status-badge>
                @else
                    <x-status-badge variant="stable">Standard Mode</x-status-badge>
                @endif
            </div>
            <div class="mt-3 text-sm text-slate-500">Quiet hours: {{ $s?->night_mode_start ?? '—' }} - {{ $s?->night_mode_end ?? '—' }}</div>
            <div class="mt-2 text-sm text-slate-500">Audible policy: {{ $s?->audible_policy ?? '—' }} · Volume: {{ $s?->volume_level ?? '—' }}</div>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Update Alarm Settings</div>
            <div class="mt-1 text-sm text-slate-500">Changes are stored in DB and logged in the audit trail.</div>

            <form method="POST" action="{{ route('admin.alerts.alarmSettings.update') }}" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                <div class="md:col-span-2 flex items-center gap-2">
                    <input type="checkbox" name="night_mode_enabled" value="1" class="rounded border-slate-300" @checked($nightEnabled) />
                    <div class="text-sm">Enable Night Mode</div>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Night Mode Start</div>
                    <input name="night_mode_start" value="{{ old('night_mode_start', $s?->night_mode_start) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="22:00" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Night Mode End</div>
                    <input name="night_mode_end" value="{{ old('night_mode_end', $s?->night_mode_end) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="06:00" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Audible Policy</div>
                    <select name="audible_policy" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        @php $policy = old('audible_policy', $s?->audible_policy ?? 'standard'); @endphp
                        <option value="standard" @selected($policy === 'standard')>standard</option>
                        <option value="night" @selected($policy === 'night')>night</option>
                        <option value="silent" @selected($policy === 'silent')>silent</option>
                        <option value="critical_only" @selected($policy === 'critical_only')>critical_only</option>
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Volume (0-100)</div>
                    <input name="volume_level" value="{{ old('volume_level', $s?->volume_level ?? 70) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div class="md:col-span-2 flex items-center gap-2">
                    <input type="checkbox" name="snooze_enabled" value="1" class="rounded border-slate-300" @checked((bool) old('snooze_enabled', $s?->snooze_enabled ?? true)) />
                    <div class="text-sm">Allow Snooze</div>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Snooze Minutes</div>
                    <input name="snooze_minutes" value="{{ old('snooze_minutes', $s?->snooze_minutes ?? 5) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection
