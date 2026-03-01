@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Backup & Restore</h1>
            <div class="text-sm text-slate-500">Backup job history and simulated restore controls (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search backups..." />
        </div>
    </div>

    @if (session('status'))
        <div class="mt-4 rounded-2xl border border-emerald-200/70 bg-emerald-50 px-4 py-3 text-emerald-800">{{ session('status') }}</div>
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
            <div class="text-sm font-semibold">Create Backup</div>
            <div class="mt-1 text-sm text-slate-500">Creates a completed backup job record (simulated).</div>

            <form method="POST" action="{{ route('admin.data.backup.request') }}" class="mt-4 space-y-3">
                @csrf
                <div>
                    <div class="text-xs text-slate-500">Scope</div>
                    <select name="scope" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="full">full</option>
                        <option value="config_only">config_only</option>
                        <option value="audit_only">audit_only</option>
                    </select>
                </div>
                <div>
                    <div class="text-xs text-slate-500">Storage</div>
                    <select name="storage" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="local">local</option>
                        <option value="cloud">cloud</option>
                    </select>
                </div>
                <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Backup Now</button>
            </form>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Backup Jobs</div>
                <div class="text-sm text-slate-500">Latest 100</div>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[1200px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Requested</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Type</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Scope</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Size</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Storage</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Artifact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($backupJobs ?? []) as $b)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 text-slate-600">{{ $b->requested_at ? $b->requested_at->diffForHumans() : '—' }}</td>
                                <td class="px-4 py-3 font-medium">{{ $b->type }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $b->scope }}</td>
                                <td class="px-4 py-3">
                                    @php $st = $b->status ?? 'queued'; @endphp
                                    @if ($st === 'completed')
                                        <x-status-badge variant="stable">Completed</x-status-badge>
                                    @elseif ($st === 'queued')
                                        <x-status-badge variant="warning">Queued</x-status-badge>
                                    @else
                                        <x-status-badge variant="critical">{{ $st }}</x-status-badge>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-600">{{ $b->size_mb ? $b->size_mb.' MB' : '—' }}</td>
                                <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $b->storage }}</td>
                                <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $b->artifact_path ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-6 text-slate-500" colspan="7">No backups.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
