<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiModel;
use App\Models\AuditLog;
use App\Models\GeneralSetting;
use App\Models\IntegrationSetting;
use App\Models\ReportRun;
use App\Models\ReportTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AiConfigController extends Controller
{
    public function updateAiModel(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'model_id' => ['required', 'integer', 'exists:ai_models,id'],
            'status' => ['required', 'string', 'max:20'],
            'provider' => ['required', 'string', 'max:40'],
            'model_key' => ['nullable', 'string', 'max:120'],
            'risk_level' => ['required', 'integer', 'min:0', 'max:5'],
            'requires_human_review' => ['nullable'],
            'temperature' => ['required', 'numeric', 'min:0', 'max:2'],
            'max_tokens' => ['required', 'integer', 'min:64', 'max:8192'],
        ]);

        $model = AiModel::findOrFail($validated['model_id']);
        $model->update([
            'status' => $validated['status'],
            'provider' => $validated['provider'],
            'model_key' => $validated['model_key'] ?? null,
            'risk_level' => $validated['risk_level'],
            'requires_human_review' => (bool) ($request->input('requires_human_review') === '1' || $request->boolean('requires_human_review')),
            'temperature' => $validated['temperature'],
            'max_tokens' => $validated['max_tokens'],
        ]);

        $this->audit($request, 'ai_model.updated', 'AiModel', (string) $model->id, $validated);

        return back()->with('status', 'AI model updated');
    }

    public function runReport(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'template_id' => ['required', 'integer', 'exists:report_templates,id'],
            'output_format' => ['required', 'string', 'max:20'],
        ]);

        $run = ReportRun::create([
            'report_template_id' => $validated['template_id'],
            'status' => 'completed',
            'requested_at' => now(),
            'started_at' => now(),
            'completed_at' => now(),
            'rows' => random_int(50, 500),
            'output_format' => $validated['output_format'],
            'filters' => null,
            'notes' => 'Simulated report run (wire real reporting later)',
        ]);

        $this->audit($request, 'report.run', 'ReportRun', (string) $run->id, $validated);

        return back()->with('status', 'Report generated');
    }

    public function updateGeneralSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hospital_name' => ['required', 'string', 'max:255'],
            'timezone' => ['required', 'string', 'max:64'],
            'locale' => ['required', 'string', 'max:10'],
            'maintenance_mode' => ['nullable'],
            'data_retention_policy' => ['required', 'string', 'max:40'],
            'alerts_enabled' => ['nullable'],
            'default_severity' => ['required', 'string', 'max:20'],
        ]);

        $gs = GeneralSetting::query()->first();
        if (! $gs) {
            $gs = GeneralSetting::create($validated);
        }

        $gs->update([
            'hospital_name' => $validated['hospital_name'],
            'timezone' => $validated['timezone'],
            'locale' => $validated['locale'],
            'maintenance_mode' => (bool) ($request->input('maintenance_mode') === '1' || $request->boolean('maintenance_mode')),
            'data_retention_policy' => $validated['data_retention_policy'],
            'alerts_enabled' => (bool) ($request->input('alerts_enabled') === '1' || $request->boolean('alerts_enabled')),
            'default_severity' => $validated['default_severity'],
        ]);

        $this->audit($request, 'general_settings.updated', 'GeneralSetting', (string) $gs->id, $validated);

        return back()->with('status', 'General settings updated');
    }

    public function updateIntegration(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'integration_id' => ['required', 'integer', 'exists:integration_settings,id'],
            'enabled' => ['nullable'],
            'endpoint_url' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:40'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $i = IntegrationSetting::findOrFail($validated['integration_id']);
        $i->update([
            'enabled' => (bool) ($request->input('enabled') === '1' || $request->boolean('enabled')),
            'endpoint_url' => $validated['endpoint_url'] ?? null,
            'status' => $validated['status'],
            'last_sync_at' => now(),
            'notes' => $validated['notes'] ?? null,
        ]);

        $this->audit($request, 'integration.updated', 'IntegrationSetting', (string) $i->id, $validated);

        return back()->with('status', 'Integration updated');
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
