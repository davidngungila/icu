@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Patient List</h1>
            <div class="text-sm text-slate-500">Active ICU patients with admissions (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search patients..." />
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Active Admissions</div>
            <div class="text-sm text-slate-500">Latest 50</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1300px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Patient</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">MRN</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Ward/Bed</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Diagnosis</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Attending</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Admitted</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($activeAdmissions ?? []) as $a)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 font-medium">{{ $a->patient?->full_name ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $a->patient?->mrn ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $a->ward?->name ?? '—' }}{{ $a->bed ? ' · '.$a->bed->code : '' }}</td>
                            <td class="px-4 py-3">
                                @if (($a->status ?? 'active') === 'active')
                                    <x-status-badge variant="stable">Active</x-status-badge>
                                @else
                                    <x-status-badge variant="warning">{{ $a->status }}</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $a->primary_diagnosis ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $a->attending_physician ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $a->admitted_at ? $a->admitted_at->diffForHumans() : '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80"><td colspan="7" class="px-4 py-6 text-slate-500">No admissions found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-xs text-slate-500">Tip: patient details pages use the first active patient as a demo selection (add patient selection routing later).</div>
    </div>
@endsection
