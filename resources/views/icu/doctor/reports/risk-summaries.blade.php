@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Risk Score Summaries</h1>
            <div class="text-sm text-slate-500">AI risk predictions per patient (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search patients..." />
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Patients (demo)</div>
            <div class="text-sm text-slate-500">Latest 50</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1200px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Patient</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">MRN</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Latest risk</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Score</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Recommendation</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($patients ?? []) as $p)
                        @php
                            $pred = \App\Models\AiRiskPrediction::where('patient_id', $p->id)->orderBy('predicted_at', 'desc')->first();
                        @endphp
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 font-medium">{{ $p->full_name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $p->mrn }}</td>
                            <td class="px-4 py-3">
                                @if ($pred)
                                    @if ($pred->risk_level === 'high')
                                        <x-status-badge variant="warning">High</x-status-badge>
                                    @else
                                        <x-status-badge variant="stable">{{ ucfirst($pred->risk_level) }}</x-status-badge>
                                    @endif
                                @else
                                    <span class="text-slate-500">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $pred?->risk_score ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $pred?->recommendation ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80"><td colspan="5" class="px-4 py-6 text-slate-500">No patients.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
