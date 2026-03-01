@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Escalation Rules</h1>
            <div class="text-sm text-slate-500">Advanced rule engine configuration (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search rules..." />
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
            <div class="text-sm font-semibold">Create Escalation Rule</div>
            <div class="mt-1 text-sm text-slate-500">Rules determine who gets notified when alerts are not acknowledged/resolved in time.</div>

            <form method="POST" action="{{ route('admin.alerts.escalationRules.create') }}" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                @csrf

                <div class="md:col-span-2">
                    <div class="text-xs text-slate-500">Name</div>
                    <input name="name" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="e.g. Critical vitals escalation" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Enabled</div>
                    <select name="enabled" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Priority (0-100, lower = higher priority)</div>
                    <input name="priority" value="50" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Severity Filter (optional)</div>
                    <select name="severity" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="">—</option>
                        <option value="critical">critical</option>
                        <option value="high">high</option>
                        <option value="medium">medium</option>
                        <option value="low">low</option>
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Category Filter (optional)</div>
                    <input name="category" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="Vitals / Device / Network" />
                </div>

                <div class="md:col-span-2">
                    <div class="text-xs text-slate-500">Ward Filter (optional)</div>
                    <select name="ward_id" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="">All wards</option>
                        @foreach (($wards ?? []) as $w)
                            <option value="{{ $w->id }}">{{ $w->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Ack Timeout (min)</div>
                    <input name="ack_timeout_minutes" value="5" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Resolve Timeout (min)</div>
                    <input name="resolve_timeout_minutes" value="30" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div class="md:col-span-2">
                    <div class="text-xs text-slate-500">Notify Channels (comma-separated)</div>
                    <input name="notify_channels" value="dashboard,email" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div class="md:col-span-2">
                    <div class="text-xs text-slate-500">Notify Targets (emails/phones)</div>
                    <input name="notify_targets" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="icu-supervisor@icu.local,+2557..." />
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Create Rule</button>
                </div>
            </form>
        </div>

        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Rules</div>
                <div class="text-sm text-slate-500">Sorted by priority</div>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[1200px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Priority</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Name</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Enabled</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Filters</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Timeouts</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Notify</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($escalationRules ?? []) as $r)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 text-slate-600">{{ $r->priority }}</td>
                                <td class="px-4 py-3 font-medium">{{ $r->name }}</td>
                                <td class="px-4 py-3">
                                    @if ($r->enabled)
                                        <x-status-badge variant="stable">Enabled</x-status-badge>
                                    @else
                                        <x-status-badge variant="warning">Disabled</x-status-badge>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-600">
                                    <div>Severity: {{ $r->severity ?? 'any' }}</div>
                                    <div>Category: {{ $r->category ?? 'any' }}</div>
                                    <div>Ward: {{ $r->ward?->name ?? 'any' }}</div>
                                </td>
                                <td class="px-4 py-3 text-slate-600">
                                    <div>Ack: {{ $r->ack_timeout_minutes }}m</div>
                                    <div>Resolve: {{ $r->resolve_timeout_minutes }}m</div>
                                </td>
                                <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">
                                    <div>{{ $r->notify_channels }}</div>
                                    <div class="text-xs text-slate-500">{{ $r->notify_targets ?? '—' }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-6 text-slate-500" colspan="6">No rules yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
