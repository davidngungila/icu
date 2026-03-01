@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between gap-4">
        <div class="min-w-0">
            <h1 class="text-xl font-semibold tracking-tight truncate">{{ $title }}</h1>
            <div class="text-sm text-slate-500 truncate">Page key: {{ $page }}</div>
        </div>

        <div class="flex items-center gap-3">
            <x-search-input placeholder="Search patients/devices..." />
            <div class="hidden lg:flex items-center gap-2">
                <x-status-badge variant="stable">Stable</x-status-badge>
                <x-status-badge variant="warning">Warning</x-status-badge>
                <x-status-badge variant="critical">Critical</x-status-badge>
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="lg:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Content Area</div>
                <div class="text-sm text-slate-500">Search / filters can live here</div>
            </div>
            <div class="mt-4 h-[320px] rounded-2xl bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-slate-400">
                No Data
            </div>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Real-time notifications</div>
            <div class="mt-4 space-y-2">
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-sm font-medium">Sample alert</div>
                    <div class="text-xs text-slate-500">This area will show popups/alerts.</div>
                </div>
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-sm font-medium">AI Risk signal</div>
                    <div class="text-xs text-slate-500">Hook to your model later.</div>
                </div>
            </div>
        </div>
    </div>
@endsection
