@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Live Monitor</h1>
            <div class="text-sm text-slate-500">Simulated waves (wire to real device streams later)</div>
        </div>

        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <x-search-input placeholder="Search beds/devices..." />
            <button type="button" class="h-10 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-sm font-medium" data-icu-live-sound-toggle>
                Enable Sound
            </button>
        </div>
    </div>

    @php
        $bedsList = collect($beds ?? []);
        $devs = collect($devices ?? []);

        $devicesByBed = $devs->groupBy(fn ($d) => $d->bed_id ?? 0);

        $bedPayload = fn ($bed) => (
            $devicesByBed->get($bed->id, collect())
                ->map(fn ($d) => [
                    'id' => $d->id,
                    'name' => $d->name,
                    'type' => $d->type,
                    'status' => $d->status,
                ])
                ->values()
        );
    @endphp

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4" data-icu-bed-monitors>
        @forelse ($bedsList as $bed)
            @php
                $bedDevs = $devicesByBed->get($bed->id, collect());
            @endphp
            <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden" data-icu-bed-monitor data-icu-bed-id="{{ $bed->id }}" data-icu-bed-devices='@json($bedPayload($bed))'>
                <div class="px-5 py-4 border-b border-slate-200/80">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="text-sm font-semibold">{{ $bed->ward?->name ?? 'Ward' }} · {{ $bed->code }}</div>
                            <div class="text-xs text-slate-500">Devices: {{ $bedDevs->count() }}</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" class="h-9 px-3 rounded-xl bg-white border border-slate-200/80 hover:bg-slate-50 text-xs font-medium" data-icu-bed-fullscreen>
                                Maximize
                            </button>
                            <div class="text-xs" data-icu-bed-status>Stable</div>
                        </div>
                    </div>

                    <div class="mt-3 flex flex-wrap gap-2">
                        @forelse ($bedDevs as $d)
                            <span class="px-2 py-1 rounded-full text-xs border border-slate-200/80 bg-slate-50">
                                {{ $d->type }}
                                <span class="text-slate-500">· {{ $d->status }}</span>
                            </span>
                        @empty
                            <span class="text-xs text-slate-500">No devices connected.</span>
                        @endforelse
                    </div>
                </div>

                <div class="p-4 bg-slate-50">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="rounded-2xl border border-slate-200/80 overflow-hidden bg-black/95">
                            <div class="px-3 py-2 text-[11px] text-slate-300 flex items-center justify-between">
                                <span>ECG</span>
                                <span data-icu-bed-wave-status="ecg">—</span>
                            </div>
                            <canvas class="w-full h-[90px]" width="520" height="90" data-icu-bed-wave="ecg"></canvas>
                        </div>

                        <div class="rounded-2xl border border-slate-200/80 overflow-hidden bg-black/95">
                            <div class="px-3 py-2 text-[11px] text-slate-300 flex items-center justify-between">
                                <span>SpO₂</span>
                                <span data-icu-bed-wave-status="spo2">—</span>
                            </div>
                            <canvas class="w-full h-[90px]" width="520" height="90" data-icu-bed-wave="spo2"></canvas>
                        </div>

                        <div class="rounded-2xl border border-slate-200/80 overflow-hidden bg-black/95">
                            <div class="px-3 py-2 text-[11px] text-slate-300 flex items-center justify-between">
                                <span>ABP</span>
                                <span data-icu-bed-wave-status="abp">—</span>
                            </div>
                            <canvas class="w-full h-[90px]" width="520" height="90" data-icu-bed-wave="abp"></canvas>
                        </div>

                        <div class="rounded-2xl border border-slate-200/80 overflow-hidden bg-black/95">
                            <div class="px-3 py-2 text-[11px] text-slate-300 flex items-center justify-between">
                                <span>Resp</span>
                                <span data-icu-bed-wave-status="resp">—</span>
                            </div>
                            <canvas class="w-full h-[90px]" width="520" height="90" data-icu-bed-wave="resp"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-sm text-slate-500">No beds found. Seed beds/devices first.</div>
        @endforelse
    </div>

    <div class="fixed inset-0 z-50 hidden" data-icu-bed-modal>
        <div class="absolute inset-0 bg-slate-900/70"></div>
        <div class="absolute inset-0 flex flex-col">
            <div class="bg-white border-b border-slate-200/80 flex items-start justify-between gap-4 px-5 py-3">
                <div class="min-w-0">
                    <div class="text-base font-semibold" data-icu-bed-modal-title>Bed Monitor</div>
                    <div class="text-xs text-slate-500" data-icu-bed-modal-subtitle>Live detailed view</div>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" class="h-9 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-sm font-medium" data-icu-bed-modal-close>
                        Close
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-hidden p-4">
                <div class="h-full max-w-7xl mx-auto grid grid-cols-1 xl:grid-cols-4 gap-3">
                    <div class="xl:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="bg-black/95 rounded-xl border border-slate-200/80 overflow-hidden flex flex-col">
                            <div class="px-3 py-2 text-xs text-slate-300 flex items-center justify-between flex-shrink-0">
                                <span>ECG</span>
                                <span data-icu-bed-modal-wave-status="ecg">—</span>
                            </div>
                            <div class="flex-1 relative">
                                <canvas class="absolute inset-0 w-full h-full" width="1200" height="220" data-icu-bed-modal-wave="ecg"></canvas>
                            </div>
                        </div>

                        <div class="bg-black/95 rounded-xl border border-slate-200/80 overflow-hidden flex flex-col">
                            <div class="px-3 py-2 text-xs text-slate-300 flex items-center justify-between flex-shrink-0">
                                <span>SpO₂</span>
                                <span data-icu-bed-modal-wave-status="spo2">—</span>
                            </div>
                            <div class="flex-1 relative">
                                <canvas class="absolute inset-0 w-full h-full" width="1200" height="220" data-icu-bed-modal-wave="spo2"></canvas>
                            </div>
                        </div>

                        <div class="bg-black/95 rounded-xl border border-slate-200/80 overflow-hidden flex flex-col">
                            <div class="px-3 py-2 text-xs text-slate-300 flex items-center justify-between flex-shrink-0">
                                <span>ABP</span>
                                <span data-icu-bed-modal-wave-status="abp">—</span>
                            </div>
                            <div class="flex-1 relative">
                                <canvas class="absolute inset-0 w-full h-full" width="1200" height="220" data-icu-bed-modal-wave="abp"></canvas>
                            </div>
                        </div>

                        <div class="bg-black/95 rounded-xl border border-slate-200/80 overflow-hidden flex flex-col">
                            <div class="px-3 py-2 text-xs text-slate-300 flex items-center justify-between flex-shrink-0">
                                <span>Resp</span>
                                <span data-icu-bed-modal-wave-status="resp">—</span>
                            </div>
                            <div class="flex-1 relative">
                                <canvas class="absolute inset-0 w-full h-full" width="1200" height="220" data-icu-bed-modal-wave="resp"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-4 flex flex-col">
                        <div class="text-sm font-semibold">Details</div>

                        <div class="mt-3 grid grid-cols-2 gap-2">
                            <div class="p-2 rounded-lg bg-white border border-slate-200/80">
                                <div class="text-xs text-slate-500">HR</div>
                                <div class="mt-1 text-base font-semibold" data-icu-bed-modal-num="hr">—</div>
                            </div>
                            <div class="p-2 rounded-lg bg-white border border-slate-200/80">
                                <div class="text-xs text-slate-500">SpO₂</div>
                                <div class="mt-1 text-base font-semibold" data-icu-bed-modal-num="spo2">—</div>
                            </div>
                            <div class="p-2 rounded-lg bg-white border border-slate-200/80">
                                <div class="text-xs text-slate-500">MAP</div>
                                <div class="mt-1 text-base font-semibold" data-icu-bed-modal-num="map">—</div>
                            </div>
                            <div class="p-2 rounded-lg bg-white border border-slate-200/80">
                                <div class="text-xs text-slate-500">RR</div>
                                <div class="mt-1 text-base font-semibold" data-icu-bed-modal-num="rr">—</div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="text-sm font-semibold">Connected devices</div>
                            <div class="mt-2 space-y-1 overflow-auto flex-1" data-icu-bed-modal-devices>
                                <div class="text-xs text-slate-500">—</div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="text-sm font-semibold">Attention level</div>
                            <div class="mt-2" data-icu-bed-modal-attention>
                                <x-status-badge variant="stable">Stable</x-status-badge>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
