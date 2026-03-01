@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Vitals & Waveforms</h1>
            <div class="text-sm text-slate-500">Latest vitals and ECG waveform snapshot (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search..." />
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Vitals (latest 48)</div>
                <div class="text-sm text-slate-500">Patient: {{ $patient?->full_name ?? '—' }} · {{ $patient?->mrn ?? '—' }}</div>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[1200px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Time</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">HR</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">SpO₂</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">RR</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Temp</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">BP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($vitals ?? []) as $v)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 text-slate-600">{{ $v->measured_at ? $v->measured_at->format('Y-m-d H:i') : '—' }}</td>
                                <td class="px-4 py-3 font-medium">{{ $v->hr ?? '—' }}</td>
                                <td class="px-4 py-3 font-medium">{{ $v->spo2 ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $v->rr ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $v->temp_c ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ ($v->sbp && $v->dbp) ? ($v->sbp.'/'.$v->dbp) : '—' }}</td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80"><td colspan="6" class="px-4 py-6 text-slate-500">No vitals available.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Waveform Snapshot</div>
            <div class="mt-1 text-sm text-slate-500">Type: {{ $waveform?->type ?? '—' }} · Captured: {{ $waveform?->captured_at ? $waveform->captured_at->diffForHumans() : '—' }}</div>

            <div class="mt-4 rounded-2xl border border-slate-200/80 overflow-hidden bg-slate-50">
                <canvas
                    width="560"
                    height="220"
                    class="w-full h-[220px]"
                    data-icu-waveform
                    data-icu-waveform-samples='@json($waveform?->samples ?? [])'
                ></canvas>
            </div>

            <div class="mt-3 text-xs text-slate-500">Waveform is rendered client-side from DB samples.</div>
        </div>
    </div>

@endsection
