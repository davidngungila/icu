@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Data Export</h1>
            <div class="text-sm text-slate-500">Generate export jobs for system datasets (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search exports..." />
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
            <div class="text-sm font-semibold">Create Export</div>
            <div class="mt-1 text-sm text-slate-500">Creates a completed export job record (simulated).</div>

            <form method="POST" action="{{ route('admin.data.export.request') }}" class="mt-4 space-y-3">
                @csrf
                <div>
                    <div class="text-xs text-slate-500">Dataset</div>
                    <select name="dataset" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="alerts">alerts</option>
                        <option value="devices">devices</option>
                        <option value="users">users</option>
                        <option value="audit_logs">audit_logs</option>
                    </select>
                </div>
                <div>
                    <div class="text-xs text-slate-500">Format</div>
                    <select name="format" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="csv">csv</option>
                        <option value="pdf">pdf</option>
                    </select>
                </div>
                <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Generate Export</button>
            </form>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Export Jobs</div>
                <div class="text-sm text-slate-500">Latest 100</div>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[1200px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Requested</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Dataset</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Format</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Rows</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Artifact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($exportJobs ?? []) as $e)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 text-slate-600">{{ $e->requested_at ? $e->requested_at->diffForHumans() : '—' }}</td>
                                <td class="px-4 py-3 font-medium">{{ $e->dataset }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $e->format }}</td>
                                <td class="px-4 py-3">
                                    @php $st = $e->status ?? 'queued'; @endphp
                                    @if ($st === 'completed')
                                        <x-status-badge variant="stable">Completed</x-status-badge>
                                    @elseif ($st === 'queued')
                                        <x-status-badge variant="warning">Queued</x-status-badge>
                                    @else
                                        <x-status-badge variant="critical">{{ $st }}</x-status-badge>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-600">{{ $e->rows ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $e->artifact_path ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-6 text-slate-500" colspan="6">No exports.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
