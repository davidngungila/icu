@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Server Monitoring</h1>
            <div class="text-sm text-slate-500">Live server health metrics (CPU/RAM/Disk/Temp/DB).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search servers..." />
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Nodes</div>
            <div class="text-sm text-slate-500">Live DB values</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1000px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Name</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Role</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">CPU</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">RAM</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Disk</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Temp</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">DB QPS</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Measured</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($servers ?? []) as $s)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 font-medium">{{ $s->name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $s->role ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @php $st = $s->status ?? 'online'; @endphp
                                @if ($st === 'online')
                                    <x-status-badge variant="stable">Online</x-status-badge>
                                @elseif ($st === 'standby')
                                    <x-status-badge variant="warning">Standby</x-status-badge>
                                @else
                                    <x-status-badge variant="critical">{{ $st }}</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $s->cpu_usage !== null ? $s->cpu_usage.'%' : '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $s->ram_usage !== null ? $s->ram_usage.'%' : '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $s->disk_usage !== null ? $s->disk_usage.'%' : '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $s->temperature !== null ? $s->temperature.'°C' : '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $s->db_qps !== null ? $s->db_qps : '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $s->measured_at ? $s->measured_at->diffForHumans() : '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-6 text-slate-500" colspan="9">No server metrics.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
