<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlarmSetting;
use App\Models\Alert;
use App\Models\AlertEvent;
use App\Models\AuditLog;
use App\Models\EscalationRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AlertManagementController extends Controller
{
    public function acknowledge(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'alert_id' => ['required', 'integer', 'exists:alerts,id'],
        ]);

        $alert = Alert::findOrFail($validated['alert_id']);

        if ($alert->status === 'resolved') {
            return back()->with('status', 'Alert already resolved');
        }

        if ($alert->acknowledged_at === null) {
            $alert->update([
                'acknowledged_at' => now(),
                'acknowledged_by_user_id' => $request->user()?->id,
                'status' => 'acknowledged',
            ]);

            AlertEvent::create([
                'alert_id' => $alert->id,
                'occurred_at' => now(),
                'type' => 'acknowledged',
                'actor_type' => 'user',
                'actor_id' => (string) ($request->user()?->id),
                'notes' => null,
                'metadata' => null,
            ]);

            $this->audit($request, 'alert.acknowledged', 'Alert', (string) $alert->id, ['severity' => $alert->severity]);
        }

        return back()->with('status', 'Alert acknowledged');
    }

    public function resolve(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'alert_id' => ['required', 'integer', 'exists:alerts,id'],
        ]);

        $alert = Alert::findOrFail($validated['alert_id']);

        if ($alert->status !== 'resolved') {
            $alert->update([
                'resolved_at' => now(),
                'resolved_by_user_id' => $request->user()?->id,
                'status' => 'resolved',
            ]);

            AlertEvent::create([
                'alert_id' => $alert->id,
                'occurred_at' => now(),
                'type' => 'resolved',
                'actor_type' => 'user',
                'actor_id' => (string) ($request->user()?->id),
                'notes' => null,
                'metadata' => null,
            ]);

            $this->audit($request, 'alert.resolved', 'Alert', (string) $alert->id, ['severity' => $alert->severity]);
        }

        return back()->with('status', 'Alert resolved');
    }

    public function createEscalationRule(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'enabled' => ['nullable'],
            'severity' => ['nullable', 'string', 'max:20'],
            'category' => ['nullable', 'string', 'max:60'],
            'ward_id' => ['nullable', 'integer', 'exists:wards,id'],
            'ack_timeout_minutes' => ['required', 'integer', 'min:1', 'max:1440'],
            'resolve_timeout_minutes' => ['required', 'integer', 'min:1', 'max:10080'],
            'notify_channels' => ['required', 'string', 'max:120'],
            'notify_targets' => ['nullable', 'string', 'max:255'],
            'priority' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $validated['enabled'] = (bool) ($request->input('enabled') === '1' || $request->boolean('enabled'));

        $rule = EscalationRule::create($validated);
        $this->audit($request, 'escalation_rule.created', 'EscalationRule', (string) $rule->id, $validated);

        return back()->with('status', 'Escalation rule created');
    }

    public function updateAlarmSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'night_mode_enabled' => ['nullable'],
            'night_mode_start' => ['nullable', 'date_format:H:i'],
            'night_mode_end' => ['nullable', 'date_format:H:i'],
            'audible_policy' => ['required', 'string', 'max:40'],
            'volume_level' => ['required', 'integer', 'min:0', 'max:100'],
            'snooze_enabled' => ['nullable'],
            'snooze_minutes' => ['required', 'integer', 'min:1', 'max:60'],
        ]);

        $settings = AlarmSetting::query()->first();
        if (! $settings) {
            $settings = AlarmSetting::create([
                'night_mode_enabled' => false,
                'audible_policy' => 'standard',
                'volume_level' => 70,
                'snooze_enabled' => true,
                'snooze_minutes' => 5,
            ]);
        }

        $validated['night_mode_enabled'] = (bool) ($request->input('night_mode_enabled') === '1' || $request->boolean('night_mode_enabled'));
        $validated['snooze_enabled'] = (bool) ($request->input('snooze_enabled') === '1' || $request->boolean('snooze_enabled'));

        $settings->update($validated);
        $this->audit($request, 'alarm_settings.updated', 'AlarmSetting', (string) $settings->id, $validated);

        return back()->with('status', 'Alarm settings updated');
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
