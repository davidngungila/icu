@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Daily / Weekly Patient Trends</h1>
            <div class="text-sm text-slate-500">Trend summaries based on recent vitals (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search..." />
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Vitals Trend (Last 24 measurements)</div>
            <div class="mt-1 text-sm text-slate-500">Patient: {{ $patient?->full_name ?? '—' }}</div>

            <div class="mt-4 rounded-2xl border border-slate-200/80 overflow-hidden bg-slate-50">
                <canvas
                    width="900"
                    height="280"
                    class="w-full h-[280px]"
                    data-icu-trend
                    data-icu-trend-vitals='@json(collect($vitals ?? [])->reverse()->values())'
                ></canvas>
            </div>

            <div class="mt-3 text-xs text-slate-500">Chart is a sample rendering; wire to more advanced analytics later.</div>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Quick Summary</div>
            <div class="mt-4 space-y-2">
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-xs text-slate-500">Latest HR</div>
                    <div class="mt-1 text-lg font-semibold">{{ $vitals[0]->hr ?? '—' }}</div>
                </div>
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-xs text-slate-500">Latest SpO₂</div>
                    <div class="mt-1 text-lg font-semibold">{{ $vitals[0]->spo2 ?? '—' }}</div>
                </div>
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-xs text-slate-500">AI Risk</div>
                    <div class="mt-1 text-lg font-semibold">{{ $riskPred?->risk_level ?? '—' }} ({{ $riskPred?->risk_score ?? '—' }})</div>
                </div>
            </div>
        </div>
    </div>

@endsection
