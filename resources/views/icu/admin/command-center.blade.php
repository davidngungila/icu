@extends('layouts.app')

@section('content')
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight truncate">Admin Dashboard (Command Center)</h1>
            <div class="text-sm text-slate-500">Mission control view for ICU operations, compliance, and uptime.</div>
        </div>

        <div class="flex items-center gap-2">
            <x-status-badge variant="stable">Primary: Online</x-status-badge>
            <x-status-badge variant="warning">Backup: Standby</x-status-badge>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Total ICU Beds</div>
            <div class="mt-2 text-3xl font-semibold">24</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Occupied Beds</div>
            <div class="mt-2 text-3xl font-semibold">18</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Critical Patients</div>
            <div class="mt-2 text-3xl font-semibold text-rose-600">5</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Today’s Alerts</div>
            <div class="mt-2 text-3xl font-semibold">42</div>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Warning Patients</div>
            <div class="mt-2 text-3xl font-semibold text-amber-600">7</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Active Device Failures</div>
            <div class="mt-2 text-3xl font-semibold text-rose-600">2</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Server Health</div>
            <div class="mt-2 text-3xl font-semibold">99.8%</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Cloud Sync</div>
            <div class="mt-2 text-3xl font-semibold">OK</div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Live Graphs</div>
                <div class="text-sm text-slate-500">24h / 7d views (placeholder)</div>
            </div>

            <div class="mt-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="rounded-2xl bg-slate-50 border border-dashed border-slate-200 p-4">
                    <div class="text-sm font-medium">ICU Occupancy Trend</div>
                    <div class="mt-3 h-40">
                        <canvas class="w-full h-full" data-icu-live-graph data-points="44" data-interval="800"></canvas>
                    </div>
                </div>
                <div class="rounded-2xl bg-slate-50 border border-dashed border-slate-200 p-4">
                    <div class="text-sm font-medium">Alert Response Time</div>
                    <div class="mt-3 h-40">
                        <canvas class="w-full h-full" data-icu-live-graph data-points="36" data-interval="950"></canvas>
                    </div>
                </div>
                <div class="rounded-2xl bg-slate-50 border border-dashed border-slate-200 p-4">
                    <div class="text-sm font-medium">Device Failure Trend</div>
                    <div class="mt-3 h-40">
                        <canvas class="w-full h-full" data-icu-live-graph data-points="40" data-interval="720"></canvas>
                    </div>
                </div>
                <div class="rounded-2xl bg-slate-50 border border-dashed border-slate-200 p-4">
                    <div class="text-sm font-medium">Network Latency</div>
                    <div class="mt-3 h-40">
                        <canvas class="w-full h-full" data-icu-live-graph data-points="48" data-interval="650"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Real-Time Status Panel</div>
            <div class="mt-4 space-y-3">
                <div class="flex items-center justify-between gap-3">
                    <div class="text-sm text-slate-600">Primary Server</div>
                    <x-status-badge variant="stable">Online</x-status-badge>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div class="text-sm text-slate-600">Backup Server</div>
                    <x-status-badge variant="warning">Standby</x-status-badge>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div class="text-sm text-slate-600">Database</div>
                    <x-status-badge variant="stable">Healthy</x-status-badge>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div class="text-sm text-slate-600">API</div>
                    <x-status-badge variant="stable">OK</x-status-badge>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div class="text-sm text-slate-600">SMS Gateway</div>
                    <x-status-badge variant="warning">Degraded</x-status-badge>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div class="text-sm text-slate-600">ISP 1</div>
                    <x-status-badge variant="stable">Connected</x-status-badge>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div class="text-sm text-slate-600">ISP 2</div>
                    <x-status-badge variant="stable">Connected</x-status-badge>
                </div>
            </div>

            <div class="mt-6">
                <div class="text-sm font-semibold">Live Activity Feed</div>
                <div class="mt-3 space-y-2">
                    <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="text-sm font-medium">User role updated</div>
                        <div class="text-xs text-slate-500">2 min ago · admin@hospital.local</div>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="text-sm font-medium">Device fault detected</div>
                        <div class="text-xs text-slate-500">5 min ago · Bed 3 · Infusion Pump</div>
                    </div>
                    <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <div class="text-sm font-medium">Backup sync completed</div>
                        <div class="text-xs text-slate-500">12 min ago · Cloud</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
