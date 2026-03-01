@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Network Monitoring</h1>
            <div class="text-sm text-slate-500">Latency / packet loss / VLAN integrity / firewall status (live DB).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search links..." />
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Links</div>
            <div class="text-sm text-slate-500">Live DB values</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1100px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Name</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Latency</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Packet Loss</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden md:table-cell">Switch</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden md:table-cell">VLAN</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Firewall</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Measured</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($links ?? []) as $l)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 font-medium">{{ $l->name }}</td>
                            <td class="px-4 py-3">
                                @if (($l->status ?? 'up') === 'up')
                                    <x-status-badge variant="stable">Up</x-status-badge>
                                @else
                                    <x-status-badge variant="critical">Down</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $l->latency_ms !== null ? $l->latency_ms.' ms' : '—' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $l->packet_loss_pct !== null ? $l->packet_loss_pct.'%' : '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden md:table-cell">{{ $l->switch_status ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden md:table-cell">{{ $l->vlan_integrity ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $l->firewall_status ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $l->measured_at ? $l->measured_at->diffForHumans() : '—' }}</td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-6 text-slate-500" colspan="8">No network links.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
