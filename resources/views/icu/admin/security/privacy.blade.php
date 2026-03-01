@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Data Privacy Controls</h1>
            <div class="text-sm text-slate-500">Privacy controls and PDPA-aligned request handling (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search privacy..." />
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

    @php
        $openCount = collect($privacyRequests ?? [])->where('status', 'open')->count();
        $completedCount = collect($privacyRequests ?? [])->where('status', 'completed')->count();
        $enabledControls = collect($privacyControls ?? [])->filter(fn ($c) => (bool) $c->enabled)->count();
    @endphp

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Open privacy requests</div>
            <div class="mt-2 text-3xl font-semibold">{{ $openCount }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Completed requests</div>
            <div class="mt-2 text-3xl font-semibold">{{ $completedCount }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Privacy controls enabled</div>
            <div class="mt-2 text-3xl font-semibold">{{ $enabledControls }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">PDPA workflow</div>
            <div class="mt-2 text-sm text-slate-600">Assign · Complete · Audit</div>
            <div class="mt-2 text-xs text-slate-500">All changes are stored in DB and logged.</div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Privacy Controls</div>
            <div class="mt-4 space-y-3">
                @forelse (($privacyControls ?? []) as $pc)
                    <form method="POST" action="{{ route('admin.security.privacyControls.update') }}" class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                        @csrf
                        <input type="hidden" name="control_id" value="{{ $pc->id }}" />

                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <div class="text-sm font-semibold">{{ $pc->name }}</div>
                                <div class="text-xs text-slate-500">Mode: {{ $pc->mode }}</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <select name="enabled" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                                    <option value="1" @selected((bool) $pc->enabled)>enabled</option>
                                    <option value="0" @selected(! (bool) $pc->enabled)>disabled</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <div class="text-xs text-slate-500">Mode</div>
                            <select name="mode" class="mt-2 w-full h-10 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                                <option value="standard" @selected($pc->mode === 'standard')>standard</option>
                                <option value="strict" @selected($pc->mode === 'strict')>strict</option>
                                <option value="always" @selected($pc->mode === 'always')>always</option>
                                <option value="off" @selected($pc->mode === 'off')>off</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-sm font-medium">Save</button>
                    </form>
                @empty
                    <div class="text-sm text-slate-500">No privacy controls.</div>
                @endforelse
            </div>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <div class="text-sm font-semibold">Privacy Requests</div>
                    <div class="text-sm text-slate-500">Data export / access logs / erasure requests</div>
                </div>

                <form method="POST" action="{{ route('admin.security.privacyRequests.create') }}" class="flex flex-col sm:flex-row gap-2 sm:items-center">
                    @csrf
                    <select name="request_type" class="h-10 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="data_export">data_export</option>
                        <option value="access_log">access_log</option>
                        <option value="erasure">erasure</option>
                    </select>
                    <input name="subject_identifier" class="h-10 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="patient:TZ-ICU-00012" />
                    <input name="notes" class="h-10 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="Notes (optional)" />
                    <button type="submit" class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Create</button>
                </form>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[1200px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Requested</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Type</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Subject</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Handled By</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Completed</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Workflow</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($privacyRequests ?? []) as $pr)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 text-slate-600">{{ $pr->requested_at ? $pr->requested_at->diffForHumans() : '—' }}</td>
                                <td class="px-4 py-3 font-medium">{{ $pr->request_type }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $pr->subject_identifier }}</td>
                                <td class="px-4 py-3">
                                    @php $st = $pr->status ?? 'open'; @endphp
                                    @if ($st === 'open')
                                        <x-status-badge variant="warning">Open</x-status-badge>
                                    @elseif ($st === 'completed')
                                        <x-status-badge variant="stable">Completed</x-status-badge>
                                    @else
                                        <x-status-badge variant="critical">{{ $st }}</x-status-badge>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $pr->handledBy?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $pr->completed_at ? $pr->completed_at->diffForHumans() : '—' }}</td>
                                <td class="px-4 py-3">
                                    <form method="POST" action="{{ route('admin.security.privacyRequests.update') }}" class="flex flex-wrap items-center gap-2">
                                        @csrf
                                        <input type="hidden" name="request_id" value="{{ $pr->id }}" />

                                        <select name="status" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                                            <option value="open" @selected($st === 'open')>open</option>
                                            <option value="completed" @selected($st === 'completed')>completed</option>
                                        </select>

                                        <button type="submit" name="assign_to_me" value="1" class="h-9 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-sm font-medium">Assign to me</button>
                                        <button type="submit" class="h-9 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Save</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-6 text-slate-500" colspan="7">No privacy requests.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
