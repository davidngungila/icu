@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Emergency Override</h1>
            <div class="text-sm text-slate-500">Enable emergency override to bypass normal automation policies (DB-backed).</div>
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
                @if ((bool) ($s?->override_enabled ?? false))
                    <x-status-badge variant="critical">Override Enabled</x-status-badge>
                @else
                    <x-status-badge variant="stable">Override Disabled</x-status-badge>
                @endif
            </div>
            <div class="mt-3 text-sm text-slate-500">Reason: {{ $s?->override_reason ?? '—' }}</div>
            <div class="mt-2 text-sm text-slate-500">Enabled at: {{ $s?->override_enabled_at ? $s->override_enabled_at->diffForHumans() : '—' }}</div>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Update Override</div>
            <div class="mt-1 text-sm text-slate-500">Saves to DB and logs an emergency event + audit log.</div>

            <form method="POST" action="{{ route('admin.emergency.override.update') }}" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                <div class="md:col-span-2 flex items-center gap-2">
                    <input type="checkbox" name="override_enabled" value="1" class="rounded border-slate-300" @checked((bool) old('override_enabled', $s?->override_enabled ?? false)) />
                    <div class="text-sm">Enable override</div>
                </div>

                <div class="md:col-span-2">
                    <div class="text-xs text-slate-500">Reason</div>
                    <input name="override_reason" value="{{ old('override_reason', $s?->override_reason) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="e.g. Clinical emergency - manual control required" />
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full h-11 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium">Apply Override</button>
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
