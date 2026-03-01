@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Disaster & Surge Mode</h1>
            <div class="text-sm text-slate-500">Enable surge mode and track additional ICU capacity (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search events..." />
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

    @php $s = $emergencyState; @endphp

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Current Status</div>
            <div class="mt-3">
                @if ((bool) ($s?->surge_mode_enabled ?? false))
                    <x-status-badge variant="warning">Surge Enabled</x-status-badge>
                @else
                    <x-status-badge variant="stable">Normal</x-status-badge>
                @endif
            </div>
            <div class="mt-3 text-sm text-slate-500">Level: {{ $s?->surge_level ?? 'normal' }}</div>
            <div class="mt-2 text-sm text-slate-500">Extra capacity beds: {{ $s?->extra_capacity_beds ?? 0 }}</div>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Update Surge Mode</div>
            <div class="mt-1 text-sm text-slate-500">Stores state in DB and records an emergency event.</div>

            <form method="POST" action="{{ route('admin.emergency.surge.update') }}" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                <div class="md:col-span-2 flex items-center gap-2">
                    <input type="checkbox" name="surge_mode_enabled" value="1" class="rounded border-slate-300" @checked((bool) old('surge_mode_enabled', $s?->surge_mode_enabled ?? false)) />
                    <div class="text-sm">Enable surge mode</div>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Surge level</div>
                    @php $lvl = old('surge_level', $s?->surge_level ?? 'normal'); @endphp
                    <select name="surge_level" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="normal" @selected($lvl === 'normal')>normal</option>
                        <option value="elevated" @selected($lvl === 'elevated')>elevated</option>
                        <option value="critical" @selected($lvl === 'critical')>critical</option>
                        <option value="disaster" @selected($lvl === 'disaster')>disaster</option>
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Extra capacity beds</div>
                    <input name="extra_capacity_beds" value="{{ old('extra_capacity_beds', $s?->extra_capacity_beds ?? 0) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Apply Surge Mode</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Emergency Events</div>
            <div class="text-sm text-slate-500">Latest 150</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1100px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Time</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Type</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Actor</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($emergencyEvents ?? []) as $e)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 text-slate-600">{{ $e->occurred_at ? $e->occurred_at->diffForHumans() : '—' }}</td>
                            <td class="px-4 py-3 font-medium">{{ $e->type }}</td>
                            <td class="px-4 py-3">
                                @if (($e->status ?? 'ok') === 'ok')
                                    <x-status-badge variant="stable">OK</x-status-badge>
                                @else
                                    <x-status-badge variant="warning">{{ $e->status }}</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $e->actor?->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $e->notes ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-6 text-slate-500" colspan="5">No events.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
