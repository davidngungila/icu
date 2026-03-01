@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Compliance Module</h1>
            <div class="text-sm text-slate-500">PDPA (Tanzania) · TMDA · International standards control tracking (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search controls..." />
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

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Controls</div>
            <div class="text-sm text-slate-500">Latest 200</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1500px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Framework</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Code</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Title</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Owner</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Last Check</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($complianceControls ?? []) as $c)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 text-slate-600">{{ $c->framework }}</td>
                            <td class="px-4 py-3 font-medium">{{ $c->control_code }}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $c->title }}</div>
                                <div class="text-xs text-slate-500 line-clamp-2">{{ $c->description }}</div>
                            </td>
                            <td class="px-4 py-3">
                                @php $st = $c->status ?? 'pass'; @endphp
                                @if ($st === 'pass')
                                    <x-status-badge variant="stable">Pass</x-status-badge>
                                @elseif ($st === 'warn')
                                    <x-status-badge variant="warning">Warn</x-status-badge>
                                @else
                                    <x-status-badge variant="critical">Fail</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $c->owner ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $c->last_checked_at ? $c->last_checked_at->diffForHumans() : '—' }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.security.compliance.update') }}" class="flex flex-wrap items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="control_id" value="{{ $c->id }}" />

                                    <select name="status" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                                        <option value="pass" @selected($st === 'pass')>pass</option>
                                        <option value="warn" @selected($st === 'warn')>warn</option>
                                        <option value="fail" @selected($st === 'fail')>fail</option>
                                    </select>

                                    <select name="enabled" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                                        <option value="1" @selected((bool) $c->enabled)>enabled</option>
                                        <option value="0" @selected(! (bool) $c->enabled)>disabled</option>
                                    </select>

                                    <input name="owner" value="{{ $c->owner }}" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="Owner" />
                                    <input name="evidence_link" value="{{ $c->evidence_link }}" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="Evidence link" />

                                    <button type="submit" class="h-9 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-sm font-medium">Save</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-6 text-slate-500" colspan="7">No compliance controls.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
