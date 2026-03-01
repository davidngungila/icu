@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Device Control Panel</h1>
            <div class="text-sm text-slate-500">Queue remote commands (restart/diagnostics/config) and review command history.</div>
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
            <div class="text-sm font-semibold">Queue Device Command</div>
            <div class="mt-1 text-sm text-slate-500">Creates a queued command record in DB.</div>

            <form method="POST" action="{{ route('admin.devices.command') }}" class="mt-4 space-y-3">
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
                    <div class="text-xs text-slate-500">Command</div>
                    <select name="command" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="restart">Restart Device</option>
                        <option value="firmware_update">Firmware Update</option>
                        <option value="remote_diagnostics">Remote Diagnostics</option>
                        <option value="configuration">Device Configuration</option>
                        <option value="alert_thresholds">Alert Threshold Settings</option>
                    </select>
                </div>

                <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Queue Command</button>
            </form>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Recent Commands</div>
                <div class="text-sm text-slate-500">Latest 100</div>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[980px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Time</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Device</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Command</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($commands ?? []) as $c)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 text-slate-600">{{ $c->requested_at ? $c->requested_at->diffForHumans() : '—' }}</td>
                                <td class="px-4 py-3 font-medium">{{ $c->device?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $c->command }}</td>
                                <td class="px-4 py-3">
                                    @php $s = $c->status ?? 'queued'; @endphp
                                    @if ($s === 'queued')
                                        <x-status-badge variant="warning">Queued</x-status-badge>
                                    @elseif ($s === 'processed')
                                        <x-status-badge variant="stable">Processed</x-status-badge>
                                    @else
                                        <x-status-badge variant="critical">{{ $s }}</x-status-badge>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-6 text-slate-500" colspan="4">No commands.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
