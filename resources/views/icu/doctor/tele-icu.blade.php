@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Tele-ICU Access</h1>
            <div class="text-sm text-slate-500">Remote consult sessions (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search sessions..." />
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Sessions</div>
            <div class="text-sm text-slate-500">Latest 20 for selected patient</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1300px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Started</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Remote site</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Clinician</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Link</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($teleIcu ?? []) as $s)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 text-slate-600">{{ $s->started_at ? $s->started_at->diffForHumans() : '—' }}</td>
                            <td class="px-4 py-3">
                                @if (($s->status ?? 'active') === 'active')
                                    <x-status-badge variant="warning">Active</x-status-badge>
                                @else
                                    <x-status-badge variant="stable">{{ ucfirst($s->status) }}</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $s->remote_site ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $s->clinician ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $s->link ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $s->notes ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80"><td colspan="6" class="px-4 py-6 text-slate-500">No sessions.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-xs text-slate-500">Tele-ICU session creation is simulated; wire to real video/RTC provider later.</div>
    </div>
@endsection
