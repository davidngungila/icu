@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Ward Access Control</h1>
            <div class="text-sm text-slate-500">Restrict access by ward, user/role, shift and bed scope (live DB).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search wards/rules..." />
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
            <div class="text-sm font-semibold">Create Ward</div>
            <form method="POST" action="{{ route('admin.wards.create') }}" class="mt-4 space-y-3">
                @csrf
                <div>
                    <div class="text-xs text-slate-500">Ward Name</div>
                    <input name="name" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="e.g. ICU Ward A" />
                </div>
                <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Create Ward</button>
            </form>

            <div class="mt-6">
                <div class="text-sm font-semibold">Wards</div>
                <div class="mt-3 overflow-hidden rounded-2xl border border-slate-200/80">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="text-left px-4 py-3 font-semibold text-slate-600">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (($wards ?? []) as $w)
                                <tr class="border-t border-slate-200/80">
                                    <td class="px-4 py-3">{{ $w->name }}</td>
                                </tr>
                            @empty
                                <tr class="border-t border-slate-200/80">
                                    <td class="px-4 py-6 text-slate-500">No wards.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Add Access Rule</div>
            <form method="POST" action="{{ route('admin.ward_access_rules.create') }}" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                @csrf
                <div class="md:col-span-2">
                    <div class="text-xs text-slate-500">Ward</div>
                    <select name="ward_id" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        @foreach (($wards ?? []) as $w)
                            <option value="{{ $w->id }}">{{ $w->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">User (optional)</div>
                    <select name="user_id" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="">—</option>
                        @foreach (($users ?? []) as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Role (optional)</div>
                    <select name="role_id" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="">—</option>
                        @foreach (($rolesList ?? []) as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Allowed Beds (comma-separated)</div>
                    <input name="allowed_beds" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="e.g. 1,2,3" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Reason</div>
                    <input name="reason" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="optional" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Shift Start</div>
                    <input name="shift_start" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="08:00" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Shift End</div>
                    <input name="shift_end" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="17:00" />
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Create Rule</button>
                </div>
            </form>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Access Rules</div>
            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[900px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Ward</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">User</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Role</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Beds</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden md:table-cell">Shift</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (($wardRules ?? []) as $rule)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3">{{ $rule->ward?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $rule->user?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $rule->role?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $rule->allowed_beds ?? '—' }}</td>
                                <td class="px-4 py-3 text-slate-600 hidden md:table-cell">
                                    @if ($rule->shift_start || $rule->shift_end)
                                        {{ $rule->shift_start ?? '—' }} - {{ $rule->shift_end ?? '—' }}
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-6 text-slate-500" colspan="5">No access rules.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
