@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Alert History</h1>
            <div class="text-sm text-slate-500">All recent alerts including resolved (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search alerts..." />
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">History</div>
            <div class="text-sm text-slate-500">Latest 200</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1600px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Time</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Severity</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Title</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden md:table-cell">Ward/Bed</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Device</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($doctorAlerts ?? []) as $a)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 text-slate-600">{{ $a->triggered_at ? $a->triggered_at->diffForHumans() : '—' }}</td>
                            <td class="px-4 py-3">
                                @php $sev = $a->severity ?? 'medium'; @endphp
                                @if ($sev === 'critical')
                                    <x-status-badge variant="critical">Critical</x-status-badge>
                                @elseif ($sev === 'high')
                                    <x-status-badge variant="warning">High</x-status-badge>
                                @else
                                    <x-status-badge variant="stable">{{ ucfirst($sev) }}</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ ucfirst($a->status ?? 'open') }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $a->title }}</div>
                                <div class="text-xs text-slate-500 line-clamp-2">{{ $a->message }}</div>
                            </td>
                            <td class="px-4 py-3 text-slate-600 hidden md:table-cell">{{ $a->ward?->name ?? '—' }}{{ $a->bed ? ' · '.$a->bed->code : '' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $a->device?->name ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80"><td colspan="6" class="px-4 py-6 text-slate-500">No alerts.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
