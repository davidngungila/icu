<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\CloudBackup;
use App\Models\Device;
use App\Models\DeviceCommand;
use App\Models\DeviceMaintenanceLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeviceHealthController extends Controller
{
    public function queueDeviceCommand(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'device_id' => ['required', 'integer', 'exists:devices,id'],
            'command' => ['required', 'string', 'max:80'],
        ]);

        $cmd = DeviceCommand::create([
            'device_id' => $validated['device_id'],
            'command' => $validated['command'],
            'status' => 'queued',
            'payload' => null,
            'requested_at' => now(),
        ]);

        $this->audit($request, 'device.command_queued', 'DeviceCommand', (string) $cmd->id, $validated);

        return back()->with('status', 'Command queued');
    }

    public function scheduleMaintenance(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'device_id' => ['required', 'integer', 'exists:devices,id'],
            'kind' => ['required', 'string', 'max:80'],
            'scheduled_for' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $log = DeviceMaintenanceLog::create([
            'device_id' => $validated['device_id'],
            'kind' => $validated['kind'],
            'scheduled_for' => $validated['scheduled_for'],
            'status' => 'scheduled',
            'notes' => $validated['notes'] ?? null,
        ]);

        $this->audit($request, 'device.maintenance_scheduled', 'DeviceMaintenanceLog', (string) $log->id, $validated);

        return back()->with('status', 'Maintenance scheduled');
    }

    public function triggerBackup(Request $request): RedirectResponse
    {
        $backup = CloudBackup::query()->first();
        if (! $backup) {
            $backup = CloudBackup::create([
                'provider' => 'cloud',
                'sync_status' => 'ok',
                'encryption_status' => 'enabled',
            ]);
        }

        $backup->update([
            'last_backup_at' => now(),
            'sync_status' => 'ok',
            'backup_size_mb' => ($backup->backup_size_mb ?? 500) + random_int(1, 12),
        ]);

        $this->audit($request, 'cloud.backup_triggered', 'CloudBackup', (string) $backup->id, []);

        return back()->with('status', 'Backup triggered');
    }

    private function audit(Request $request, string $action, ?string $targetType, ?string $targetId, array $metadata = []): void
    {
        AuditLog::create([
            'occurred_at' => now(),
            'actor_user_id' => null,
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
