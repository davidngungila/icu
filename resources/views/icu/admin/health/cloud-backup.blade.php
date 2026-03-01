@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Cloud Backup Monitoring</h1>
            <div class="text-sm text-slate-500">Backup/sync status with encryption and recovery tests (live DB).</div>
        </div>

        <div class="flex items-center gap-2">
            <form method="POST" action="{{ route('admin.cloud.backup') }}">
                @csrf
                <button type="submit" class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Trigger Backup</button>
            </form>
        </div>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-2xl border border-emerald-200/70 bg-emerald-50 px-4 py-3 text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Last Backup</div>
            <div class="mt-2 text-xl font-semibold">{{ $backup?->last_backup_at ? $backup->last_backup_at->diffForHumans() : '—' }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Sync Status</div>
            <div class="mt-2">
                @if (($backup?->sync_status ?? 'ok') === 'ok')
                    <x-status-badge variant="stable">OK</x-status-badge>
                @else
                    <x-status-badge variant="critical">{{ $backup?->sync_status }}</x-status-badge>
                @endif
            </div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Encryption</div>
            <div class="mt-2">
                @if (($backup?->encryption_status ?? 'enabled') === 'enabled')
                    <x-status-badge variant="stable">Enabled</x-status-badge>
                @else
                    <x-status-badge variant="warning">{{ $backup?->encryption_status }}</x-status-badge>
                @endif
            </div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Backup Size</div>
            <div class="mt-2 text-xl font-semibold">{{ $backup?->backup_size_mb ? $backup->backup_size_mb.' MB' : '—' }}</div>
        </div>
    </div>

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="text-sm font-semibold">Recovery Tests</div>
        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="rounded-2xl bg-slate-50 border border-slate-200/80 p-4">
                <div class="text-sm text-slate-500">Last Test</div>
                <div class="mt-2 text-lg font-semibold">{{ $backup?->last_recovery_test_at ? $backup->last_recovery_test_at->diffForHumans() : '—' }}</div>
            </div>
            <div class="rounded-2xl bg-slate-50 border border-slate-200/80 p-4">
                <div class="text-sm text-slate-500">Status</div>
                <div class="mt-2">
                    @if (($backup?->recovery_test_status ?? 'ok') === 'ok')
                        <x-status-badge variant="stable">OK</x-status-badge>
                    @else
                        <x-status-badge variant="warning">{{ $backup?->recovery_test_status ?? '—' }}</x-status-badge>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-4 text-sm text-slate-500">Notes: {{ $backup?->notes ?? '—' }}</div>
    </div>
@endsection
