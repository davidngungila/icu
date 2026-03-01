@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Alert Control Center</h1>
            <div class="text-sm text-slate-500">Live triage queue with acknowledge/resolve actions.</div>
        </div>

        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <x-search-input placeholder="Search alerts..." />
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

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Open</div>
            <div class="mt-2 text-3xl font-semibold">{{ $alertStats['open'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Critical (Open)</div>
            <div class="mt-2 text-3xl font-semibold text-rose-600">{{ $alertStats['critical'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Acknowledged</div>
            <div class="mt-2 text-3xl font-semibold">{{ $alertStats['acknowledged'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Resolved (24h)</div>
            <div class="mt-2 text-3xl font-semibold">{{ $alertStats['resolved24h'] ?? 0 }}</div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Alerts</div>
                <div class="text-sm text-slate-500">Latest 150</div>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[1400px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Time</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Severity</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Title</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden md:table-cell">Ward/Bed</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Device</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($alerts ?? []) as $a)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 text-slate-600">{{ $a->triggered_at ? $a->triggered_at->diffForHumans() : '—' }}</td>
                                <td class="px-4 py-3">
                                    @php $sev = $a->severity ?? 'medium'; @endphp
                                    @if ($sev === 'critical')
                                        <x-status-badge variant="critical">Critical</x-status-badge>
                                    @elseif ($sev === 'high')
                                        <x-status-badge variant="warning">High</x-status-badge>
                                    @else
                                        <x-status-badge variant="stable">{{ ucfirst($sev) }}</x-status-badge>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-600">{{ ucfirst($a->status ?? 'open') }}</td>
                                <td class="px-4 py-3">
                                    <div class="font-medium">{{ $a->title }}</div>
                                    <div class="text-xs text-slate-500 line-clamp-2">{{ $a->message }}</div>
                                </td>
                                <td class="px-4 py-3 text-slate-600 hidden md:table-cell">
                                    {{ $a->ward?->name ?? '—' }}
                                    @if ($a->bed)
                                        · {{ $a->bed->code }}
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $a->device?->name ?? '—' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <form method="POST" action="{{ route('admin.alerts.ack') }}">
                                            @csrf
                                            <input type="hidden" name="alert_id" value="{{ $a->id }}" />
                                            <button type="submit" class="h-9 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-sm font-medium">Ack</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.alerts.resolve') }}">
                                            @csrf
                                            <input type="hidden" name="alert_id" value="{{ $a->id }}" />
                                            <button type="submit" class="h-9 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Resolve</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-6 text-slate-500" colspan="7">No alerts yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Live Event Timeline</div>
            <div class="mt-1 text-sm text-slate-500">Latest 200 alert events</div>

            <div class="mt-4 space-y-2">
                @forelse (($alertEvents ?? [])->take(18) as $e)
                    <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center justify-between gap-2">
                            <div class="text-sm font-medium">{{ $e->type }}</div>
                            <div class="text-xs text-slate-500">{{ $e->occurred_at ? $e->occurred_at->diffForHumans() : '—' }}</div>
                        </div>
                        <div class="text-xs text-slate-500">Alert #{{ $e->alert_id }}</div>
                    </div>
                @empty
                    <div class="text-sm text-slate-500">No events yet.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
