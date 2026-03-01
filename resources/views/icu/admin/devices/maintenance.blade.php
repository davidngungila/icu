@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Maintenance Scheduler</h1>
            <div class="text-sm text-slate-500">Schedule device maintenance and review upcoming tasks.</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search maintenance..." />
        </div>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-2xl border border-emerald-200/70 bg-emerald-50 px-4 py-3 text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mt-4 rounded-2xl border border-rose-200/70 bg-rose-50 px-4 py-3 text-rose-800">
            <div class="font-semibold text-sm">Please fix the following:</div>
            <ul class="mt-2 text-sm list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Schedule Maintenance</div>

            <form method="POST" action="{{ route('admin.devices.maintenance') }}" class="mt-4 space-y-3">
                @csrf
                <div>
                    <div class="text-xs text-slate-500">Device</div>
                    <select name="device_id" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        @foreach (($devices ?? []) as $d)
                            <option value="{{ $d->id }}">{{ $d->name }} · {{ $d->ward?->name }} · {{ $d->bed?->code }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Kind</div>
                    <select name="kind" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="Calibration">Calibration</option>
                        <option value="Preventive Maintenance">Preventive Maintenance</option>
                        <option value="Repair">Repair</option>
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Scheduled For</div>
                    <input type="date" name="scheduled_for" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Notes</div>
                    <input name="notes" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Schedule</button>
            </form>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Maintenance Logs</div>
                <div class="text-sm text-slate-500">Latest 200</div>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[1100px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Device</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Kind</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Scheduled</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($maintenance ?? []) as $m)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 font-medium">{{ $m->device?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $m->kind }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $m->scheduled_for ? $m->scheduled_for->format('Y-m-d') : '—' }}</td>
                                <td class="px-4 py-3">
                                    @php $s = $m->status ?? 'scheduled'; @endphp
                                    @if ($s === 'scheduled')
                                        <x-status-badge variant="warning">Scheduled</x-status-badge>
                                    @elseif ($s === 'completed')
                                        <x-status-badge variant="stable">Completed</x-status-badge>
                                    @else
                                        <x-status-badge variant="critical">{{ $s }}</x-status-badge>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $m->notes ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-6 text-slate-500" colspan="5">No maintenance logs.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
