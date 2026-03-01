<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\ComplianceControl;
use App\Models\PrivacyControl;
use App\Models\PrivacyRequest;
use App\Models\SecuritySetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SecurityComplianceController extends Controller
{
    public function updateSecuritySettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'mfa_required_for_admin' => ['nullable'],
            'ip_allowlist_enabled' => ['nullable'],
            'ip_allowlist' => ['nullable', 'string', 'max:1000'],
            'session_timeout_minutes' => ['required', 'integer', 'min:5', 'max:1440'],
            'max_failed_logins_per_hour' => ['required', 'integer', 'min:1', 'max:500'],
            'encryption_at_rest' => ['nullable'],
            'encryption_in_transit' => ['nullable'],
            'audit_logging_enabled' => ['nullable'],
            'audit_retention_days' => ['required', 'integer', 'min:7', 'max:3650'],
            'password_policy' => ['required', 'string', 'max:40'],
        ]);

        $settings = SecuritySetting::query()->first();
        if (! $settings) {
            $settings = SecuritySetting::create([
                'mfa_required_for_admin' => true,
                'ip_allowlist_enabled' => false,
                'session_timeout_minutes' => 60,
                'max_failed_logins_per_hour' => 10,
                'encryption_at_rest' => true,
                'encryption_in_transit' => true,
                'audit_logging_enabled' => true,
                'audit_retention_days' => 365,
                'password_policy' => 'strong',
            ]);
        }

        $validated['mfa_required_for_admin'] = (bool) ($request->input('mfa_required_for_admin') === '1' || $request->boolean('mfa_required_for_admin'));
        $validated['ip_allowlist_enabled'] = (bool) ($request->input('ip_allowlist_enabled') === '1' || $request->boolean('ip_allowlist_enabled'));
        $validated['encryption_at_rest'] = (bool) ($request->input('encryption_at_rest') === '1' || $request->boolean('encryption_at_rest'));
        $validated['encryption_in_transit'] = (bool) ($request->input('encryption_in_transit') === '1' || $request->boolean('encryption_in_transit'));
        $validated['audit_logging_enabled'] = (bool) ($request->input('audit_logging_enabled') === '1' || $request->boolean('audit_logging_enabled'));

        $settings->update($validated);
        $this->audit($request, 'security_settings.updated', 'SecuritySetting', (string) $settings->id, $validated);

        return back()->with('status', 'Security settings updated');
    }

    public function updateComplianceControl(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'control_id' => ['required', 'integer', 'exists:compliance_controls,id'],
            'status' => ['required', 'string', 'max:20'],
            'enabled' => ['nullable'],
            'owner' => ['nullable', 'string', 'max:120'],
            'evidence_link' => ['nullable', 'string', 'max:255'],
        ]);

        $control = ComplianceControl::findOrFail($validated['control_id']);
        $control->update([
            'status' => $validated['status'],
            'enabled' => (bool) ($request->input('enabled') === '1' || $request->boolean('enabled')),
            'owner' => $validated['owner'] ?? null,
            'evidence_link' => $validated['evidence_link'] ?? null,
            'last_checked_at' => now(),
        ]);

        $this->audit($request, 'compliance_control.updated', 'ComplianceControl', (string) $control->id, $validated);

        return back()->with('status', 'Compliance control updated');
    }

    public function updatePrivacyControl(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'control_id' => ['required', 'integer', 'exists:privacy_controls,id'],
            'enabled' => ['nullable'],
            'mode' => ['required', 'string', 'max:40'],
        ]);

        $control = PrivacyControl::findOrFail($validated['control_id']);
        $control->update([
            'enabled' => (bool) ($request->input('enabled') === '1' || $request->boolean('enabled')),
            'mode' => $validated['mode'],
        ]);

        $this->audit($request, 'privacy_control.updated', 'PrivacyControl', (string) $control->id, $validated);

        return back()->with('status', 'Privacy control updated');
    }

    public function createPrivacyRequest(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'request_type' => ['required', 'string', 'max:40'],
            'subject_identifier' => ['required', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $pr = PrivacyRequest::create([
            'request_type' => $validated['request_type'],
            'subject_identifier' => $validated['subject_identifier'],
            'status' => 'open',
            'notes' => $validated['notes'] ?? null,
            'requested_at' => now(),
            'handled_by_user_id' => null,
            'metadata' => null,
        ]);

        $this->audit($request, 'privacy_request.created', 'PrivacyRequest', (string) $pr->id, $validated);

        return back()->with('status', 'Privacy request created');
    }

    public function updatePrivacyRequest(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'request_id' => ['required', 'integer', 'exists:privacy_requests,id'],
            'status' => ['required', 'string', 'max:40'],
            'assign_to_me' => ['nullable'],
        ]);

        $pr = PrivacyRequest::findOrFail($validated['request_id']);

        $assignToMe = (bool) ($request->input('assign_to_me') === '1' || $request->boolean('assign_to_me'));
        $nextHandledBy = $assignToMe ? ($request->user()?->id) : $pr->handled_by_user_id;

        $isCompleting = $validated['status'] === 'completed';
        $nextCompletedAt = $isCompleting ? now() : null;

        $pr->update([
            'status' => $validated['status'],
            'handled_by_user_id' => $nextHandledBy,
            'completed_at' => $nextCompletedAt,
        ]);

        $this->audit($request, 'privacy_request.updated', 'PrivacyRequest', (string) $pr->id, [
            'status' => $validated['status'],
            'assign_to_me' => $assignToMe,
        ]);

        return back()->with('status', 'Privacy request updated');
    }

    private function audit(Request $request, string $action, ?string $targetType, ?string $targetId, array $metadata = []): void
    {
        AuditLog::create([
            'occurred_at' => now(),
            'actor_user_id' => $request->user()?->id,
            'action' => $action,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'result' => 'ok',
            'ip' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
            'metadata' => $metadata,
        ]);
    }
}
