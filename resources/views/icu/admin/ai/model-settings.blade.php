@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">AI Model Settings</h1>
            <div class="text-sm text-slate-500">Configure AI model risk controls, guardrails, and runtime parameters (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search models..." />
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

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-2 gap-4">
        @forelse (($aiModels ?? []) as $m)
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="text-sm font-semibold">{{ $m->name }}</div>
                        <div class="text-sm text-slate-500">Provider: {{ $m->provider }} · Status: {{ $m->status }}</div>
                    </div>
                    <div>
                        @if (($m->status ?? 'active') === 'active')
                            <x-status-badge variant="stable">Active</x-status-badge>
                        @else
                            <x-status-badge variant="warning">{{ $m->status }}</x-status-badge>
                        @endif
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.ai.models.update') }}" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <input type="hidden" name="model_id" value="{{ $m->id }}" />

                    <div>
                        <div class="text-xs text-slate-500">Status</div>
                        <select name="status" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                            <option value="active" @selected($m->status === 'active')>active</option>
                            <option value="paused" @selected($m->status === 'paused')>paused</option>
                            <option value="disabled" @selected($m->status === 'disabled')>disabled</option>
                        </select>
                    </div>

                    <div>
                        <div class="text-xs text-slate-500">Provider</div>
                        <select name="provider" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                            <option value="local" @selected($m->provider === 'local')>local</option>
                            <option value="openai" @selected($m->provider === 'openai')>openai</option>
                            <option value="azure" @selected($m->provider === 'azure')>azure</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <div class="text-xs text-slate-500">Model Key</div>
                        <input name="model_key" value="{{ $m->model_key }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="e.g. icu-risk-v1" />
                    </div>

                    <div>
                        <div class="text-xs text-slate-500">Risk level (0-5)</div>
                        <input name="risk_level" value="{{ $m->risk_level }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                    </div>

                    <div class="flex items-center gap-2 pt-6">
                        <input type="checkbox" name="requires_human_review" value="1" class="rounded border-slate-300" @checked((bool) $m->requires_human_review) />
                        <div class="text-sm">Require human review</div>
                    </div>

                    <div>
                        <div class="text-xs text-slate-500">Temperature</div>
                        <input name="temperature" value="{{ $m->temperature }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                    </div>

                    <div>
                        <div class="text-xs text-slate-500">Max tokens</div>
                        <input name="max_tokens" value="{{ $m->max_tokens }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Save Model</button>
                    </div>
                </form>
            </div>
        @empty
            <div class="text-sm text-slate-500">No AI models.</div>
        @endforelse
    </div>
@endsection
