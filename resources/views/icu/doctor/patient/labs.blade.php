@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Lab Results</h1>
            <div class="text-sm text-slate-500">Latest lab results for the selected patient (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search labs..." />
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Results</div>
            <div class="text-sm text-slate-500">Patient: {{ $patient?->full_name ?? '—' }} · {{ $patient?->mrn ?? '—' }}</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1400px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Time</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Panel</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Test</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Value</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Unit</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Flag</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Reference</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($labs ?? []) as $r)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 text-slate-600">{{ $r->resulted_at ? $r->resulted_at->format('Y-m-d H:i') : '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $r->panel ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $r->test_name }}</div>
                                <div class="text-xs text-slate-500">{{ $r->test_code }}</div>
                            </td>
                            <td class="px-4 py-3 font-semibold">{{ $r->value }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $r->unit ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @if (($r->flag ?? '') === 'H')
                                    <x-status-badge variant="warning">H</x-status-badge>
                                @elseif (($r->flag ?? '') === 'L')
                                    <x-status-badge variant="critical">L</x-status-badge>
                                @else
                                    <span class="text-slate-500">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $r->reference_range ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80"><td colspan="7" class="px-4 py-6 text-slate-500">No results.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
