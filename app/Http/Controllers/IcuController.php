<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\AiModel;
use App\Models\AlarmSetting;
use App\Models\Alert;
use App\Models\AlertEvent;
use App\Models\Bed;
use App\Models\BackupJob;
use App\Models\CloudBackup;
use App\Models\ComplianceControl;
use App\Models\Device;
use App\Models\DeviceCommand;
use App\Models\DeviceMaintenanceLog;
use App\Models\EmergencyEvent;
use App\Models\EmergencyState;
use App\Models\EscalationRule;
use App\Models\ExportJob;
use App\Models\GeneralSetting;
use App\Models\IntegrationSetting;
use App\Models\NetworkLink;
use App\Models\PrivacyControl;
use App\Models\PrivacyRequest;
use App\Models\Patient;
use App\Models\PatientAdmission;
use App\Models\PatientVital;
use App\Models\PatientWaveform;
use App\Models\LabResult;
use App\Models\MedicationOrder;
use App\Models\AiRiskPrediction;
use App\Models\TeleIcuSession;
use App\Models\ReportRun;
use App\Models\ReportTemplate;
use App\Models\Role;
use App\Models\SecuritySetting;
use App\Models\ServerMetric;
use App\Models\User;
use App\Models\Ward;
use App\Models\WardAccessRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class IcuController extends Controller
{
    public function page(Request $request, ?string $page = 'dashboard'): View
    {
        $role = $request->session()->get('icu_role', 'nurse'); // Default to nurse for this interface

        $roles = config('icu.roles', []);
        if (! array_key_exists($role, $roles)) {
            $role = 'nurse'; // Default to nurse if role not found
            $request->session()->put('icu_role', $role);
        }

        // Load appropriate menu configuration based on role
        if ($role === 'nurse') {
            $menus = config('icu-nurse-menus', []);
        } else {
            $menus = config("icu.menus.$role", []);
        }

        $flatPages = $this->flattenPages($menus);
        if (! in_array($page, $flatPages, true)) {
            $page = 'dashboard';
        }

        $title = $this->titleFromPage($page);

        $data = [
            'role' => $role,
            'roleLabel' => $roles[$role] ?? $role,
            'roles' => $roles,
            'menus' => $menus,
            'page' => $page,
            'title' => $title,
        ];

        // Add sample data for nurse pages
        if ($role === 'nurse') {
            $data['activePatients'] = 24;
            $data['criticalAlerts'] = 3;
            $data['pendingMeds'] = 8;
            $data['availableBeds'] = 4;
            
            // Add more sample data as needed
            $data['patients'] = [
                ['id' => 'P001', 'name' => 'John Smith', 'age' => 45, 'bed' => 'ICU-001', 'condition' => 'Post-operative', 'status' => 'stable'],
                ['id' => 'P002', 'name' => 'Maria Garcia', 'age' => 62, 'bed' => 'ICU-002', 'condition' => 'Respiratory Failure', 'status' => 'critical'],
                ['id' => 'P003', 'name' => 'Robert Johnson', 'age' => 58, 'bed' => 'ICU-003', 'condition' => 'Cardiac Monitoring', 'status' => 'stable'],
                ['id' => 'P004', 'name' => 'Susan Chen', 'age' => 71, 'bed' => 'ICU-004', 'condition' => 'Sepsis Management', 'status' => 'warning'],
            ];
        }

        if (in_array($page, [
            'admin/users/overview',
            'admin/users/roles',
            'admin/users/ward-access',
            'admin/users/audit-trail',
        ], true)) {
            $data['users'] = User::query()->with('roles')->orderBy('id', 'desc')->limit(50)->get();
            $data['rolesList'] = Role::query()->orderBy('name')->get();
            $data['wards'] = Ward::query()->orderBy('name')->get();
            $data['wardRules'] = WardAccessRule::query()->with(['ward', 'user', 'role'])->orderBy('id', 'desc')->limit(100)->get();
            $data['auditLogs'] = AuditLog::query()->orderBy('occurred_at', 'desc')->limit(150)->get();

            $data['stats'] = [
                'totalUsers' => User::count(),
                'suspendedUsers' => User::where('status', 'suspended')->count(),
                'activeSessions' => \DB::table('sessions')->count(),
                'failedLogins' => AuditLog::where('action', 'auth.login_failed')->where('occurred_at', '>=', now()->subDay())->count(),
            ];
        }

        if (str_starts_with($page, 'doctor/')) {
            $data['patients'] = Patient::query()->orderBy('id', 'desc')->limit(50)->get();
            $data['activeAdmissions'] = PatientAdmission::query()->with(['patient', 'ward', 'bed'])->where('status', 'active')->orderBy('admitted_at', 'desc')->limit(50)->get();

            $data['devices'] = Device::query()->with(['ward', 'bed'])->orderBy('id', 'desc')->limit(200)->get();

            if ($page === 'doctor/live-monitor') {
                $data['beds'] = Bed::query()->with('ward')->orderBy('id')->limit(24)->get();
            }

            $patient = Patient::query()->orderBy('id')->first();
            $admission = $patient ? PatientAdmission::query()->where('patient_id', $patient->id)->where('status', 'active')->latest('admitted_at')->first() : null;

            $data['patient'] = $patient;
            $data['admission'] = $admission;

            if ($patient) {
                $data['vitals'] = PatientVital::query()->where('patient_id', $patient->id)->orderBy('measured_at', 'desc')->limit(48)->get();
                $data['waveform'] = PatientWaveform::query()->where('patient_id', $patient->id)->orderBy('captured_at', 'desc')->first();
                $data['labs'] = LabResult::query()->where('patient_id', $patient->id)->orderBy('resulted_at', 'desc')->limit(50)->get();
                $data['medOrders'] = MedicationOrder::query()->where('patient_id', $patient->id)->orderBy('ordered_at', 'desc')->limit(50)->get();
                $data['riskPred'] = AiRiskPrediction::query()->where('patient_id', $patient->id)->orderBy('predicted_at', 'desc')->first();
                $data['teleIcu'] = TeleIcuSession::query()->where('patient_id', $patient->id)->orderBy('started_at', 'desc')->limit(20)->get();
            }

            if (in_array($page, ['doctor/alerts/active', 'doctor/alerts/ack', 'doctor/alerts/history'], true)) {
                $q = Alert::query()->with(['ward', 'bed', 'device'])->orderBy('triggered_at', 'desc');

                if ($page === 'doctor/alerts/active') {
                    $q->whereIn('status', ['open']);
                } elseif ($page === 'doctor/alerts/ack') {
                    $q->where('status', 'acknowledged');
                }

                $data['doctorAlerts'] = $q->limit(200)->get();
            }
        }

        if (in_array($page, [
            'admin/ai/model-settings',
            'admin/ai/advanced-reports',
        ], true)) {
            $data['aiModels'] = AiModel::query()->orderBy('name')->get();
            $data['reportTemplates'] = ReportTemplate::query()->orderBy('category')->orderBy('name')->get();
            $data['reportRuns'] = ReportRun::query()->with('template')->orderBy('requested_at', 'desc')->limit(100)->get();
        }

        if (in_array($page, [
            'admin/config/general',
            'admin/config/integrations',
        ], true)) {
            $data['generalSettings'] = GeneralSetting::query()->first();
            $data['integrations'] = IntegrationSetting::query()->orderBy('type')->orderBy('name')->limit(200)->get();
        }

        if (in_array($page, [
            'admin/emergency/override',
            'admin/emergency/surge-mode',
            'admin/emergency/lockdown',
        ], true)) {
            $data['emergencyState'] = EmergencyState::query()->first();
            $data['emergencyEvents'] = EmergencyEvent::query()->with('actor')->orderBy('occurred_at', 'desc')->limit(150)->get();
        }

        if (in_array($page, [
            'admin/data/backup-restore',
            'admin/data/export',
        ], true)) {
            $data['backupJobs'] = BackupJob::query()->orderBy('requested_at', 'desc')->limit(100)->get();
            $data['exportJobs'] = ExportJob::query()->orderBy('requested_at', 'desc')->limit(100)->get();
        }

        if (in_array($page, [
            'admin/security/settings',
            'admin/security/compliance',
            'admin/security/privacy',
        ], true)) {
            $data['securitySettings'] = SecuritySetting::query()->first();
            $data['complianceControls'] = ComplianceControl::query()->orderBy('framework')->orderBy('control_code')->limit(200)->get();
            $data['privacyControls'] = PrivacyControl::query()->orderBy('name')->limit(200)->get();
            $data['privacyRequests'] = PrivacyRequest::query()->with('handledBy')->orderBy('requested_at', 'desc')->limit(200)->get();

            $data['securityStats'] = [
                'auditEvents24h' => AuditLog::where('occurred_at', '>=', now()->subDay())->count(),
                'openPrivacyRequests' => PrivacyRequest::where('status', 'open')->count(),
                'complianceFail' => ComplianceControl::where('status', 'fail')->count(),
                'complianceWarn' => ComplianceControl::where('status', 'warn')->count(),
            ];
        }

        if (in_array($page, [
            'admin/devices/overview',
            'admin/devices/control',
            'admin/devices/maintenance',
        ], true)) {
            $data['wards'] = Ward::query()->orderBy('name')->get();
            $data['beds'] = Bed::query()->with('ward')->orderBy('id')->get();
            $data['devices'] = Device::query()->with(['ward', 'bed'])->orderBy('id', 'desc')->limit(200)->get();
            $data['maintenance'] = DeviceMaintenanceLog::query()->with('device')->orderBy('id', 'desc')->limit(200)->get();
            $data['commands'] = DeviceCommand::query()->with('device')->orderBy('id', 'desc')->limit(100)->get();

            $data['deviceStats'] = [
                'online' => Device::where('status', 'online')->count(),
                'offline' => Device::where('status', 'offline')->count(),
                'fault' => Device::where('status', 'fault')->count(),
                'calibrationDue' => Device::whereNotNull('last_calibration_date')
                    ->where('last_calibration_date', '<=', now()->subYear()->toDateString())
                    ->count(),
            ];
        }

        if (in_array($page, [
            'admin/health/servers',
            'admin/health/network',
            'admin/health/cloud-backup',
        ], true)) {
            $data['servers'] = ServerMetric::query()->orderBy('name')->get();
            $data['links'] = NetworkLink::query()->orderBy('name')->get();
            $data['backup'] = CloudBackup::query()->first();
        }

        if (in_array($page, [
            'admin/alerts/control-center',
            'admin/alerts/escalation',
            'admin/alerts/alarm-settings',
        ], true)) {
            $data['wards'] = Ward::query()->orderBy('name')->get();

            $data['alerts'] = Alert::query()
                ->with(['ward', 'bed', 'device', 'acknowledgedBy', 'resolvedBy'])
                ->orderBy('triggered_at', 'desc')
                ->limit(150)
                ->get();

            $data['alertEvents'] = AlertEvent::query()->orderBy('occurred_at', 'desc')->limit(200)->get();
            $data['escalationRules'] = EscalationRule::query()->with('ward')->orderBy('priority')->limit(200)->get();
            $data['alarmSettings'] = AlarmSetting::query()->first();

            $data['alertStats'] = [
                'open' => Alert::whereIn('status', ['open', 'acknowledged'])->count(),
                'critical' => Alert::where('severity', 'critical')->whereIn('status', ['open', 'acknowledged'])->count(),
                'acknowledged' => Alert::where('status', 'acknowledged')->count(),
                'resolved24h' => Alert::whereNotNull('resolved_at')->where('resolved_at', '>=', now()->subDay())->count(),
            ];
        }

        $specificView = 'icu.'.str_replace('/', '.', $page);
        if (view()->exists($specificView)) {
            return view($specificView, $data);
        }

        if (str_starts_with($page, 'admin/')) {
            return view('icu.admin.module', $data);
        }

        return view('icu.page', $data);
    }

    public function setRole(Request $request): RedirectResponse
    {
        $role = (string) $request->input('role', 'admin');

        $roles = config('icu.roles', []);
        if (! array_key_exists($role, $roles)) {
            $role = 'admin';
        }

        $request->session()->put('icu_role', $role);

        return redirect()->route('icu.page', ['page' => 'dashboard']);
    }

    private function flattenPages(array $menus): array
    {
        $pages = ['dashboard'];

        foreach ($menus as $item) {
            if (isset($item['page'])) {
                $pages[] = $item['page'];
            }

            foreach (Arr::get($item, 'children', []) as $child) {
                if (isset($child['page'])) {
                    $pages[] = $child['page'];
                }
            }
        }

        return array_values(array_unique($pages));
    }

    private function titleFromPage(string $page): string
    {
        if ($page === 'dashboard') {
            return 'Dashboard';
        }

        $parts = preg_split('/[\/\-_]+/', $page) ?: [$page];
        $parts = array_map(static fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)).mb_substr($p, 1), $parts);

        return implode(' ', $parts);
    }
}
