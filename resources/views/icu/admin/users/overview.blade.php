@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Users Overview</h1>
            <div class="text-sm text-slate-500">Live user list and sessions overview.</div>
        </div>

        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <x-search-input placeholder="Search users..." />
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

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Total Users</div>
            <div class="mt-2 text-3xl font-semibold">{{ $stats['totalUsers'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Active Sessions</div>
            <div class="mt-2 text-3xl font-semibold">{{ $stats['activeSessions'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Suspended Accounts</div>
            <div class="mt-2 text-3xl font-semibold">{{ $stats['suspendedUsers'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Failed Login Attempts (24h)</div>
            <div class="mt-2 text-3xl font-semibold">{{ $stats['failedLogins'] ?? 0 }}</div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Users</div>
                <div class="text-sm text-slate-500">Latest 50</div>
            </div>

            <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
                <table class="min-w-[900px] w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Name</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Email</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Roles</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                            <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden md:table-cell">Last Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users ?? [] as $u)
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-3 font-medium">{{ $u->name }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $u->email }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse ($u->roles as $r)
                                            <span class="px-2 py-1 rounded-full bg-slate-100 text-slate-700 text-xs">{{ $r->name }}</span>
                                        @empty
                                            <span class="text-xs text-slate-500">—</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if (($u->status ?? 'active') === 'suspended')
                                        <x-status-badge variant="critical">Suspended</x-status-badge>
                                    @else
                                        <x-status-badge variant="stable">Active</x-status-badge>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-slate-600 hidden md:table-cell">
                                    {{ $u->last_login_at ? $u->last_login_at->diffForHumans() : '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr class="border-t border-slate-200/80">
                                <td class="px-4 py-6 text-slate-500" colspan="5">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Create User</div>
            <div class="mt-1 text-sm text-slate-500">Creates a database user record.</div>

            <form method="POST" action="{{ route('admin.users.create') }}" class="mt-4 space-y-3">
                @csrf
                <div>
                    <div class="text-xs text-slate-500">Name</div>
                    <input name="name" value="{{ old('name') }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>
                <div>
                    <div class="text-xs text-slate-500">Email</div>
                    <input name="email" value="{{ old('email') }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>
                <div>
                    <div class="text-xs text-slate-500">Password</div>
                    <input name="password" type="password" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Create User</button>
            </form>
        </div>
    </div>
@endsection
