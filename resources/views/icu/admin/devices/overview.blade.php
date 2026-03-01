@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">ICU Device Overview</h1>
            <div class="text-sm text-slate-500">Live device inventory by ward → bed → device.</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search devices..." />
        </div>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-2xl border border-emerald-200/70 bg-emerald-50 px-4 py-3 text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Online</div>
            <div class="mt-2 text-3xl font-semibold">{{ $deviceStats['online'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Offline</div>
            <div class="mt-2 text-3xl font-semibold">{{ $deviceStats['offline'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Fault</div>
            <div class="mt-2 text-3xl font-semibold text-rose-600">{{ $deviceStats['fault'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Calibration Due</div>
            <div class="mt-2 text-3xl font-semibold text-amber-600">{{ $deviceStats['calibrationDue'] ?? 0 }}</div>
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Devices</div>
            <div class="text-sm text-slate-500">Latest 200</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1200px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Ward</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Bed</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Device</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Type</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Firmware</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden md:table-cell">Last Calibration</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Last Seen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($devices ?? []) as $d)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3">{{ $d->ward?->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $d->bed?->code ?? '—' }}</td>
                            <td class="px-4 py-3 font-medium">{{ $d->name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $d->type }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $d->firmware_version ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden md:table-cell">{{ $d->last_calibration_date ? $d->last_calibration_date->format('Y-m-d') : '—' }}</td>
                            <td class="px-4 py-3">
                                @php $s = $d->status ?? 'online'; @endphp
                                @if ($s === 'online')
                                    <x-status-badge variant="stable">Online</x-status-badge>
                                @elseif ($s === 'offline')
                                    <x-status-badge variant="warning">Offline</x-status-badge>
                                @else
                                    <x-status-badge variant="critical">Fault</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $d->last_seen_at ? $d->last_seen_at->diffForHumans() : '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-6 text-slate-500" colspan="8">No devices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
