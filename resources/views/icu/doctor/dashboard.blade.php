@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Doctor Dashboard</h1>
            <div class="text-sm text-slate-500">Clinical overview of active admissions, alerts and AI risk.</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search patients..." />
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Active admissions</div>
            <div class="mt-2 text-3xl font-semibold">{{ collect($activeAdmissions ?? [])->count() }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Open alerts</div>
            <div class="mt-2 text-3xl font-semibold">{{ \App\Models\Alert::where('status', 'open')->count() }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">High-risk patients</div>
            <div class="mt-2 text-3xl font-semibold">{{ \App\Models\AiRiskPrediction::where('risk_level', 'high')->count() }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Tele-ICU sessions (24h)</div>
            <div class="mt-2 text-3xl font-semibold">{{ \App\Models\TeleIcuSession::where('started_at', '>=', now()->subDay())->count() }}</div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <div class="text-sm font-semibold">Live Monitor</div>
                    <div class="text-sm text-slate-500">Simulated waves (wire to real device streams later)</div>
                </div>
                <button type="button" class="h-10 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-sm font-medium" data-icu-sound-toggle>
                    Enable Sound
                </button>
            </div>

            @php
                $allDevices = collect($devices ?? []);
                $monitorDevices = $allDevices->filter(fn ($d) => in_array($d->type, ['Sensor Monitor', 'Ventilator'], true));

                $ecgDevices = $monitorDevices->filter(fn ($d) => $d->type === 'Sensor Monitor')->values();
                $spo2Devices = $monitorDevices->filter(fn ($d) => $d->type === 'Sensor Monitor')->values();
                $abpDevices = $monitorDevices->filter(fn ($d) => $d->type === 'Sensor Monitor')->values();
                $respDevices = $monitorDevices->filter(fn ($d) => in_array($d->type, ['Ventilator', 'Sensor Monitor'], true))->values();

                $devicePayload = fn ($items) => $items->map(fn ($d) => [
                    'id' => $d->id,
                    'name' => $d->name,
                    'type' => $d->type,
                    'status' => $d->status,
                    'ward' => $d->ward?->name,
                    'bed' => $d->bed?->code,
                ])->values();
            @endphp

            <div class="mt-4 grid grid-cols-1 lg:grid-cols-2 gap-4" data-icu-waves>
                <div class="rounded-2xl border border-slate-200/80 overflow-hidden bg-slate-50">
                    <div class="px-4 py-3 text-xs text-slate-500 flex items-center justify-between">
                        <span>ECG</span>
                        <span data-icu-wave-status="ecg">Stable</span>
                    </div>
                    <div class="px-4 pb-3">
                        <div class="flex flex-wrap gap-2" data-icu-wave-devices="ecg" data-icu-wave-devices-json='@json($devicePayload($ecgDevices))'>
                            @forelse ($ecgDevices as $d)
                                <span class="px-2 py-1 rounded-full text-xs border border-slate-200/80 bg-white">
                                    {{ $d->name }}
                                    <span class="text-slate-500">· {{ $d->status }}</span>
                                </span>
                            @empty
                                <span class="text-xs text-slate-500">No monitoring devices connected.</span>
                            @endforelse
                        </div>
                    </div>
                    <canvas class="w-full h-[160px]" width="820" height="160" data-icu-wave="ecg"></canvas>
                </div>

                <div class="rounded-2xl border border-slate-200/80 overflow-hidden bg-slate-50">
                    <div class="px-4 py-3 text-xs text-slate-500 flex items-center justify-between">
                        <span>SpO₂ Pleth</span>
                        <span data-icu-wave-status="spo2">Stable</span>
                    </div>
                    <div class="px-4 pb-3">
                        <div class="flex flex-wrap gap-2" data-icu-wave-devices="spo2" data-icu-wave-devices-json='@json($devicePayload($spo2Devices))'>
                            @forelse ($spo2Devices as $d)
                                <span class="px-2 py-1 rounded-full text-xs border border-slate-200/80 bg-white">
                                    {{ $d->name }}
                                    <span class="text-slate-500">· {{ $d->status }}</span>
                                </span>
                            @empty
                                <span class="text-xs text-slate-500">No monitoring devices connected.</span>
                            @endforelse
                        </div>
                    </div>
                    <canvas class="w-full h-[160px]" width="820" height="160" data-icu-wave="spo2"></canvas>
                </div>

                <div class="rounded-2xl border border-slate-200/80 overflow-hidden bg-slate-50">
                    <div class="px-4 py-3 text-xs text-slate-500 flex items-center justify-between">
                        <span>ABP</span>
                        <span data-icu-wave-status="abp">Stable</span>
                    </div>
                    <div class="px-4 pb-3">
                        <div class="flex flex-wrap gap-2" data-icu-wave-devices="abp" data-icu-wave-devices-json='@json($devicePayload($abpDevices))'>
                            @forelse ($abpDevices as $d)
                                <span class="px-2 py-1 rounded-full text-xs border border-slate-200/80 bg-white">
                                    {{ $d->name }}
                                    <span class="text-slate-500">· {{ $d->status }}</span>
                                </span>
                            @empty
                                <span class="text-xs text-slate-500">No monitoring devices connected.</span>
                            @endforelse
                        </div>
                    </div>
                    <canvas class="w-full h-[160px]" width="820" height="160" data-icu-wave="abp"></canvas>
                </div>

                <div class="rounded-2xl border border-slate-200/80 overflow-hidden bg-slate-50">
                    <div class="px-4 py-3 text-xs text-slate-500 flex items-center justify-between">
                        <span>Resp</span>
                        <span data-icu-wave-status="resp">Stable</span>
                    </div>
                    <div class="px-4 pb-3">
                        <div class="flex flex-wrap gap-2" data-icu-wave-devices="resp" data-icu-wave-devices-json='@json($devicePayload($respDevices))'>
                            @forelse ($respDevices as $d)
                                <span class="px-2 py-1 rounded-full text-xs border border-slate-200/80 bg-white">
                                    {{ $d->name }}
                                    <span class="text-slate-500">· {{ $d->status }}</span>
                                </span>
                            @empty
                                <span class="text-xs text-slate-500">No monitoring devices connected.</span>
                            @endforelse
                        </div>
                    </div>
                    <canvas class="w-full h-[160px]" width="820" height="160" data-icu-wave="resp"></canvas>
                </div>
            </div>

            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Active Admissions</div>
                <div class="text-sm text-slate-500">Latest 50</div>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[1100px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Patient</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">MRN</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Ward/Bed</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Diagnosis</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Admitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($activeAdmissions ?? []) as $a)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 font-medium">{{ $a->patient?->full_name ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $a->patient?->mrn ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $a->ward?->name ?? '—' }}{{ $a->bed ? ' · '.$a->bed->code : '' }}</td>
                                <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $a->primary_diagnosis ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $a->admitted_at ? $a->admitted_at->diffForHumans() : '—' }}</td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80"><td colspan="5" class="px-4 py-6 text-slate-500">No admissions.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Selected Patient Snapshot</div>
            <div class="mt-1 text-sm text-slate-500">(Demo uses first active patient)</div>

            <div class="mt-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                <div class="text-sm font-semibold">{{ $patient?->full_name ?? '—' }}</div>
                <div class="text-xs text-slate-500">MRN: {{ $patient?->mrn ?? '—' }}</div>
                <div class="mt-3 grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <div class="text-xs text-slate-500">AI Risk</div>
                        <div class="mt-1 font-semibold">{{ $riskPred?->risk_level ?? '—' }} ({{ $riskPred?->risk_score ?? '—' }})</div>
                    </div>
                    <div>
                        <div class="text-xs text-slate-500">Ward/Bed</div>
                        <div class="mt-1 font-semibold">{{ $admission?->ward?->name ?? '—' }}{{ $admission?->bed ? ' · '.$admission->bed->code : '' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
