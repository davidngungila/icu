@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Integration Settings</h1>
            <div class="text-sm text-slate-500">Manage external system integrations (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search integrations..." />
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

    <div class="mt-6 bg-white border border-slate-200/80 rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <div class="text-sm font-semibold">Integrations</div>
            <div class="text-sm text-slate-500">Latest 200</div>
        </div>

        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200/80">
            <table class="min-w-[1500px] w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Name</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Type</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Enabled</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden lg:table-cell">Endpoint</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600 hidden xl:table-cell">Last Sync</th>
                        <th class="text-left px-4 py-3 font-semibold text-slate-600">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($integrations ?? []) as $i)
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-3 font-medium">{{ $i->name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $i->type }}</td>
                            <td class="px-4 py-3">
                                @if ($i->enabled)
                                    <x-status-badge variant="stable">Enabled</x-status-badge>
                                @else
                                    <x-status-badge variant="warning">Disabled</x-status-badge>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $i->status }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden lg:table-cell">{{ $i->endpoint_url ?? '—' }}</td>
                            <td class="px-4 py-3 text-slate-600 hidden xl:table-cell">{{ $i->last_sync_at ? $i->last_sync_at->diffForHumans() : '—' }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.config.integrations.update') }}" class="flex flex-wrap items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="integration_id" value="{{ $i->id }}" />

                                    <select name="enabled" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                                        <option value="1" @selected((bool) $i->enabled)>enabled</option>
                                        <option value="0" @selected(! (bool) $i->enabled)>disabled</option>
                                    </select>

                                    <select name="status" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                                        <option value="connected" @selected($i->status === 'connected')>connected</option>
                                        <option value="disconnected" @selected($i->status === 'disconnected')>disconnected</option>
                                        <option value="degraded" @selected($i->status === 'degraded')>degraded</option>
                                    </select>

                                    <input name="endpoint_url" value="{{ $i->endpoint_url }}" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="Endpoint URL" />
                                    <input name="notes" value="{{ $i->notes }}" class="h-9 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="Notes" />

                                    <button type="submit" class="h-9 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-sm font-medium">Save</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-t border-slate-200/80">
                            <td class="px-4 py-6 text-slate-500" colspan="7">No integrations.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
