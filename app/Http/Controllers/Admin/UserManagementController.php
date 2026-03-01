<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Role;
use App\Models\User;
use App\Models\Ward;
use App\Models\WardAccessRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function createUser(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $this->audit($request, 'user.created', 'User', (string) $user->id, ['email' => $user->email]);

        return back()->with('status', 'User created');
    }

    public function createRole(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:roles,name'],
        ]);

        $role = Role::create(['name' => $validated['name']]);
        $this->audit($request, 'role.created', 'Role', (string) $role->id, ['name' => $role->name]);

        return back()->with('status', 'Role created');
    }

    public function assignRole(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ]);

        $user = User::findOrFail($validated['user_id']);
        $role = Role::findOrFail($validated['role_id']);

        $user->roles()->syncWithoutDetaching([$role->id]);
        $this->audit($request, 'role.assigned', 'User', (string) $user->id, ['role' => $role->name]);

        return back()->with('status', 'Role assigned');
    }

    public function createWard(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:wards,name'],
        ]);

        $ward = Ward::create(['name' => $validated['name']]);
        $this->audit($request, 'ward.created', 'Ward', (string) $ward->id, ['name' => $ward->name]);

        return back()->with('status', 'Ward created');
    }

    public function createWardAccessRule(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'role_id' => ['nullable', 'integer', 'exists:roles,id'],
            'allowed_beds' => ['nullable', 'string', 'max:255'],
            'shift_start' => ['nullable', 'date_format:H:i'],
            'shift_end' => ['nullable', 'date_format:H:i'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        if (empty($validated['user_id']) && empty($validated['role_id'])) {
            return back()->withErrors(['user_id' => 'Select a user or a role'])->withInput();
        }

        $rule = WardAccessRule::create($validated);
        $this->audit($request, 'ward_access_rule.created', 'WardAccessRule', (string) $rule->id, $validated);

        return back()->with('status', 'Access rule created');
    }

    public function exportAuditCsv(Request $request): Response
    {
        $filename = 'audit-logs-'.now()->format('Ymd_His').'.csv';

        $query = AuditLog::query()->orderBy('occurred_at', 'desc')->limit(2000);

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
