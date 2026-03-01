@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Medication Orders</h1>
            <div class="text-sm text-slate-500">Active medication orders (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search meds..." />
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Orders</div>
            <div class="text-sm text-slate-500">Patient: {{ $patient?->full_name ?? '—' }} · {{ $patient?->mrn ?? '—' }}</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1400px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Ordered</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Drug</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Dose</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Route</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Frequency</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Ordered By</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($medOrders ?? []) as $o)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 text-slate-600">{{ $o->ordered_at ? $o->ordered_at->format('Y-m-d H:i') : '—' }}</td>
                            <td class="px-4 py-3 font-medium">{{ $o->drug_name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $o->dose ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $o->route ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $o->frequency ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @if (($o->status ?? 'active') === 'active')
                                    <x-status-badge variant="stable">Active</x-status-badge>
                                @else
                                    <x-status-badge variant="warning">{{ $o->status }}</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $o->ordered_by ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $o->notes ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80"><td colspan="8" class="px-4 py-6 text-slate-500">No medication orders.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
