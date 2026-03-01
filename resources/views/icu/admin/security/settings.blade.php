@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight">Security Settings</h1>
            <div class="text-sm text-slate-500">Advanced security posture configuration (DB-backed).</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search settings..." />
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
        $s = $securitySettings;
    @endphp

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Audit events (24h)</div>
            <div class="mt-2 text-3xl font-semibold">{{ $securityStats['auditEvents24h'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Open privacy requests</div>
            <div class="mt-2 text-3xl font-semibold">{{ $securityStats['openPrivacyRequests'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Compliance failures</div>
            <div class="mt-2 text-3xl font-semibold text-rose-600">{{ $securityStats['complianceFail'] ?? 0 }}</div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm text-slate-500">Compliance warnings</div>
            <div class="mt-2 text-3xl font-semibold text-amber-600">{{ $securityStats['complianceWarn'] ?? 0 }}</div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Policy Configuration</div>
            <div class="mt-1 text-sm text-slate-500">Changes are saved to DB and recorded in audit logs.</div>

            <form method="POST" action="{{ route('admin.security.settings.update') }}" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                <div class="md:col-span-2 flex items-center gap-2">
                    <input type="checkbox" name="mfa_required_for_admin" value="1" class="rounded border-slate-300" @checked((bool) ($s?->mfa_required_for_admin ?? true)) />
                    <div class="text-sm">Require MFA for Admin</div>
                </div>

                <div class="md:col-span-2 flex items-center gap-2">
                    <input type="checkbox" name="ip_allowlist_enabled" value="1" class="rounded border-slate-300" @checked((bool) ($s?->ip_allowlist_enabled ?? false)) />
                    <div class="text-sm">Enable IP Allowlist</div>
                </div>

                <div class="md:col-span-2">
                    <div class="text-xs text-slate-500">IP Allowlist (comma-separated)</div>
                    <input name="ip_allowlist" value="{{ old('ip_allowlist', $s?->ip_allowlist) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="e.g. 10.0.0.0/24, 196.0.0.10" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Session timeout (minutes)</div>
                    <input name="session_timeout_minutes" value="{{ old('session_timeout_minutes', $s?->session_timeout_minutes ?? 60) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Max failed logins per hour</div>
                    <input name="max_failed_logins_per_hour" value="{{ old('max_failed_logins_per_hour', $s?->max_failed_logins_per_hour ?? 10) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="encryption_at_rest" value="1" class="rounded border-slate-300" @checked((bool) ($s?->encryption_at_rest ?? true)) />
                    <div class="text-sm">Encryption at rest</div>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="encryption_in_transit" value="1" class="rounded border-slate-300" @checked((bool) ($s?->encryption_in_transit ?? true)) />
                    <div class="text-sm">Encryption in transit (TLS)</div>
                </div>

                <div class="md:col-span-2 flex items-center gap-2">
                    <input type="checkbox" name="audit_logging_enabled" value="1" class="rounded border-slate-300" @checked((bool) ($s?->audit_logging_enabled ?? true)) />
                    <div class="text-sm">Enable audit logging</div>
                </div>

                <div>
                    <div class="text-xs text-slate-500">Audit retention (days)</div>
                    <input name="audit_retention_days" value="{{ old('audit_retention_days', $s?->audit_retention_days ?? 365) }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" />
                </div>

                <div>
                    <div class="text-xs text-slate-500">Password policy</div>
                    @php $pp = old('password_policy', $s?->password_policy ?? 'strong'); @endphp
                    <select name="password_policy" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm">
                        <option value="standard" @selected($pp === 'standard')>standard</option>
                        <option value="strong" @selected($pp === 'strong')>strong</option>
                        <option value="strict" @selected($pp === 'strict')>strict</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Save Security Settings</button>
                </div>
            </form>
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Security Checklist</div>
            <div class="mt-4 space-y-2">
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-sm font-medium">Admin MFA required</div>
                    <div class="text-xs text-slate-500">{{ (bool) ($s?->mfa_required_for_admin ?? true) ? 'Enabled' : 'Disabled' }}</div>
                </div>
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-sm font-medium">Audit logs</div>
                    <div class="text-xs text-slate-500">{{ (bool) ($s?->audit_logging_enabled ?? true) ? 'Enabled' : 'Disabled' }}</div>
                </div>
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-sm font-medium">Encryption</div>
                    <div class="text-xs text-slate-500">At rest: {{ (bool) ($s?->encryption_at_rest ?? true) ? 'Yes' : 'No' }} · In transit: {{ (bool) ($s?->encryption_in_transit ?? true) ? 'Yes' : 'No' }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
