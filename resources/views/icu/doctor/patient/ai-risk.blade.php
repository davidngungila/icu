@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">AI Risk Prediction</h1>
            <div class="text-sm text-slate-500">Latest AI risk scoring and clinical factors (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search..." />
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Patient</div>
            <div class="mt-2 text-sm text-slate-600">{{ $patient?->full_name ?? '—' }}</div>
            <div class="text-xs text-slate-500">MRN: {{ $patient?->mrn ?? '—' }}</div>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Latest Prediction</div>
                <div class="text-sm text-slate-500">Model: {{ $riskPred?->model ?? '—' }}</div>
            </div>

            @if ($riskPred)
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="text-xs text-slate-500">Risk level</div>
                        <div class="mt-1 text-lg font-semibold">{{ $riskPred->risk_level }}</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="text-xs text-slate-500">Risk score</div>
                        <div class="mt-1 text-lg font-semibold">{{ $riskPred->risk_score }}</div>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="text-xs text-slate-500">Predicted</div>
                        <div class="mt-1 text-lg font-semibold">{{ $riskPred->predicted_at ? $riskPred->predicted_at->diffForHumans() : '—' }}</div>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 xl:grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-white border border-slate-200/80">
                        <div class="text-sm font-semibold">Top Factors</div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach (($riskPred->top_factors ?? []) as $f)
                                <span class="px-2 py-1 rounded-full bg-slate-100 text-slate-700 text-xs">{{ $f }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="p-4 rounded-2xl bg-white border border-slate-200/80">
                        <div class="text-sm font-semibold">Recommendation</div>
                        <div class="mt-3 text-sm text-slate-600">{{ $riskPred->recommendation ?? '—' }}</div>
                    </div>
                </div>
            @else
                <div class="mt-4 text-sm text-slate-500">No predictions yet.</div>
            @endif
        </div>
    </div>
@endsection
