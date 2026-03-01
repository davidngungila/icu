<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\BackupJob;
use App\Models\EmergencyEvent;
use App\Models\EmergencyState;
use App\Models\ExportJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmergencyDataController extends Controller
{
    public function updateOverride(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'override_enabled' => ['nullable'],
            'override_reason' => ['nullable', 'string', 'max:255'],
        ]);

        $state = EmergencyState::query()->firstOrCreate([], []);

        $enabled = (bool) ($request->input('override_enabled') === '1' || $request->boolean('override_enabled'));

        $state->update([
            'override_enabled' => $enabled,
            'override_reason' => $validated['override_reason'] ?? null,
            'override_enabled_at' => $enabled ? now() : null,
        ]);

        EmergencyEvent::create([
            'occurred_at' => now(),
            'type' => $enabled ? 'override.enabled' : 'override.disabled',
            'status' => 'ok',
            'actor_user_id' => $request->user()?->id,
            'notes' => $validated['override_reason'] ?? null,
            'metadata' => null,
        ]);

        $this->audit($request, 'emergency.override_updated', 'EmergencyState', (string) $state->id, ['enabled' => $enabled]);

        return back()->with('status', 'Emergency override updated');
    }

    public function updateSurgeMode(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'surge_mode_enabled' => ['nullable'],
            'surge_level' => ['required', 'string', 'max:40'],
            'extra_capacity_beds' => ['required', 'integer', 'min:0', 'max:1000'],
        ]);

        $state = EmergencyState::query()->firstOrCreate([], []);

        $enabled = (bool) ($request->input('surge_mode_enabled') === '1' || $request->boolean('surge_mode_enabled'));

        $state->update([
            'surge_mode_enabled' => $enabled,
            'surge_level' => $validated['surge_level'],
            'extra_capacity_beds' => $validated['extra_capacity_beds'],
            'surge_enabled_at' => $enabled ? now() : null,
        ]);

        EmergencyEvent::create([
            'occurred_at' => now(),
            'type' => $enabled ? 'surge.enabled' : 'surge.disabled',
            'status' => 'ok',
            'actor_user_id' => $request->user()?->id,
            'notes' => 'Surge level: '.$validated['surge_level'],
            'metadata' => ['extra_capacity_beds' => $validated['extra_capacity_beds']],
        ]);

        $this->audit($request, 'emergency.surge_updated', 'EmergencyState', (string) $state->id, ['enabled' => $enabled] + $validated);

        return back()->with('status', 'Surge mode updated');
    }

    public function updateLockdown(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'lockdown_enabled' => ['nullable'],
            'lockdown_scope' => ['required', 'string', 'max:40'],
            'lockdown_reason' => ['nullable', 'string', 'max:255'],
        ]);

        $state = EmergencyState::query()->firstOrCreate([], []);

        $enabled = (bool) ($request->input('lockdown_enabled') === '1' || $request->boolean('lockdown_enabled'));

        $state->update([
            'lockdown_enabled' => $enabled,
            'lockdown_scope' => $validated['lockdown_scope'],
            'lockdown_reason' => $validated['lockdown_reason'] ?? null,
            'lockdown_enabled_at' => $enabled ? now() : null,
        ]);

        EmergencyEvent::create([
            'occurred_at' => now(),
            'type' => $enabled ? 'lockdown.enabled' : 'lockdown.disabled',
            'status' => 'ok',
            'actor_user_id' => $request->user()?->id,
            'notes' => $validated['lockdown_reason'] ?? null,
            'metadata' => ['scope' => $validated['lockdown_scope']],
        ]);

        $this->audit($request, 'emergency.lockdown_updated', 'EmergencyState', (string) $state->id, ['enabled' => $enabled] + $validated);

        return back()->with('status', 'Lockdown updated');
    }

    public function requestBackup(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'scope' => ['required', 'string', 'max:40'],
            'storage' => ['required', 'string', 'max:40'],
        ]);

        $job = BackupJob::create([
            'type' => 'backup',
            'scope' => $validated['scope'],
            'status' => 'completed',
            'requested_at' => now(),
            'started_at' => now(),
            'completed_at' => now(),
            'size_mb' => random_int(200, 1200),
            'storage' => $validated['storage'],
            'artifact_path' => 'backups/backup_'.now()->format('Ymd_His').'.zip',
            'notes' => 'Simulated backup job (wire real backup later)',
        ]);

        $this->audit($request, 'backup.requested', 'BackupJob', (string) $job->id, $validated);

        return back()->with('status', 'Backup created');
    }

    public function requestExport(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dataset' => ['required', 'string', 'max:60'],
            'format' => ['required', 'string', 'max:10'],
        ]);

        $job = ExportJob::create([
            'dataset' => $validated['dataset'],
            'format' => $validated['format'],
            'status' => 'completed',
            'requested_at' => now(),
            'completed_at' => now(),
            'rows' => random_int(20, 500),
            'artifact_path' => 'exports/'.$validated['dataset'].'_'.now()->format('Ymd_His').'.'.$validated['format'],
            'notes' => 'Simulated export job (wire real export later)',
            'filters' => null,
        ]);

        $this->audit($request, 'export.requested', 'ExportJob', (string) $job->id, $validated);

        return back()->with('status', 'Export generated');
    }

    public function exportAuditCsv(Request $request): Response
    {
        $filename = 'audit-logs-'.now()->format('Ymd_His').'.csv';

        $query = \App\Models\AuditLog::query()->orderBy('occurred_at', 'desc')->limit(2000);

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');

            fputcsv($out, ['occurred_at', 'action', 'target_type', 'target_id', 'result', 'ip']);

            $query->chunk(500, function ($rows) use ($out) {
                foreach ($rows as $row) {
                    fputcsv($out, [
                        optional($row->occurred_at)->format('Y-m-d H:i:s'),
                        $row->action,
                        $row->target_type,
                        $row->target_id,
                        $row->result,
                        $row->ip,
                    ]);
                }
            });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
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
