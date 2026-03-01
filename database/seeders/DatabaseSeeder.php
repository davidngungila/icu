<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\AlarmSetting;
use App\Models\Alert;
use App\Models\AlertEvent;
use App\Models\AiModel;
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
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@icu.local'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active',
                'last_login_at' => now()->subMinutes(10),
            ]
        );

        $doctor = User::updateOrCreate(
            ['email' => 'doctor@icu.local'],
            [
                'name' => 'ICU Doctor',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active',
                'last_login_at' => now()->subHours(2),
            ]
        );

        $nurse = User::updateOrCreate(
            ['email' => 'nurse@icu.local'],
            [
                'name' => 'ICU Nurse',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active',
                'last_login_at' => now()->subHours(1),
            ]
        );

        if (User::count() < 15) {
            User::factory(8)->create();
        }

        $roles = collect([
            'Super Admin',
            'System Admin',
            'ICU Physician',
            'ICU Nurse',
            'Biomedical Engineer',
            'Pharmacist',
            'Lab Technician',
            'Supervisor',
        ])->map(fn ($name) => Role::firstOrCreate(['name' => $name]));

        $admin->roles()->syncWithoutDetaching([$roles->firstWhere('name', 'Super Admin')->id]);
        $doctor->roles()->syncWithoutDetaching([$roles->firstWhere('name', 'ICU Physician')->id]);
        $nurse->roles()->syncWithoutDetaching([$roles->firstWhere('name', 'ICU Nurse')->id]);

        $wardA = Ward::firstOrCreate(['name' => 'ICU Ward A']);
        $wardB = Ward::firstOrCreate(['name' => 'ICU Ward B']);

        $bedsA = collect(['Bed 1', 'Bed 2', 'Bed 3', 'Bed 4'])->map(fn ($c) => Bed::firstOrCreate(['ward_id' => $wardA->id, 'code' => $c]));
        $bedsB = collect(['Bed 1', 'Bed 2', 'Bed 3'])->map(fn ($c) => Bed::firstOrCreate(['ward_id' => $wardB->id, 'code' => $c]));

        $device1 = Device::firstOrCreate([
            'ward_id' => $wardA->id,
            'bed_id' => $bedsA->first()->id,
            'name' => 'Ventilator A-1',
        ], [
            'type' => 'Ventilator',
            'firmware_version' => 'v2.4.1',
            'last_calibration_date' => now()->subMonths(10)->toDateString(),
            'status' => 'online',
            'last_seen_at' => now()->subMinutes(1),
        ]);

        $device2 = Device::firstOrCreate([
            'ward_id' => $wardA->id,
            'bed_id' => $bedsA->get(1)->id,
            'name' => 'Infusion Pump A-2',
        ], [
            'type' => 'Infusion Pump',
            'firmware_version' => 'v1.9.0',
            'last_calibration_date' => now()->subMonths(14)->toDateString(),
            'status' => 'fault',
            'last_seen_at' => now()->subMinutes(8),
        ]);

        $device3 = Device::firstOrCreate([
            'ward_id' => $wardB->id,
            'bed_id' => $bedsB->first()->id,
            'name' => 'Bedside Monitor B-1',
        ], [
            'type' => 'Sensor Monitor',
            'firmware_version' => 'v3.1.2',
            'last_calibration_date' => now()->subMonths(6)->toDateString(),
            'status' => 'offline',
            'last_seen_at' => now()->subHours(5),
        ]);

        DeviceMaintenanceLog::firstOrCreate([
            'device_id' => $device2->id,
            'kind' => 'Calibration',
            'scheduled_for' => now()->addDays(7)->toDateString(),
        ], [
            'status' => 'scheduled',
            'notes' => 'Annual calibration due',
        ]);

        DeviceMaintenanceLog::firstOrCreate([
            'device_id' => $device1->id,
            'kind' => 'Preventive Maintenance',
            'scheduled_for' => now()->addDays(14)->toDateString(),
        ], [
            'status' => 'scheduled',
            'notes' => 'Filter check and pressure test',
        ]);

        DeviceCommand::firstOrCreate([
            'device_id' => $device2->id,
            'command' => 'remote_diagnostics',
            'requested_at' => now()->subMinutes(15),
        ], [
            'status' => 'queued',
            'payload' => ['level' => 'full'],
        ]);

        ServerMetric::updateOrCreate(['name' => 'Primary Server'], [
            'role' => 'primary',
            'status' => 'online',
            'cpu_usage' => 34,
            'ram_usage' => 62,
            'disk_usage' => 71,
            'temperature' => 54,
            'db_qps' => 220,
            'measured_at' => now(),
        ]);

        ServerMetric::updateOrCreate(['name' => 'Backup Server'], [
            'role' => 'backup',
            'status' => 'standby',
            'cpu_usage' => 12,
            'ram_usage' => 28,
            'disk_usage' => 64,
            'temperature' => 41,
            'db_qps' => 0,
            'measured_at' => now(),
        ]);

        NetworkLink::updateOrCreate(['name' => 'ISP 1'], [
            'status' => 'up',
            'latency_ms' => 12.8,
            'packet_loss_pct' => 0.3,
            'switch_status' => 'ok',
            'vlan_integrity' => 'ok',
            'firewall_status' => 'ok',
            'measured_at' => now(),
        ]);

        NetworkLink::updateOrCreate(['name' => 'ISP 2'], [
            'status' => 'up',
            'latency_ms' => 15.2,
            'packet_loss_pct' => 0.0,
            'switch_status' => 'ok',
            'vlan_integrity' => 'ok',
            'firewall_status' => 'ok',
            'measured_at' => now(),
        ]);

        CloudBackup::firstOrCreate([
            'provider' => 'cloud',
        ], [
            'last_backup_at' => now()->subHours(6),
            'sync_status' => 'ok',
            'encryption_status' => 'enabled',
            'backup_size_mb' => 512,
            'last_recovery_test_at' => now()->subDays(10),
            'recovery_test_status' => 'ok',
            'notes' => 'Sample seeded backup status',
        ]);

        AlarmSetting::firstOrCreate([], [
            'night_mode_enabled' => false,
            'night_mode_start' => '22:00',
            'night_mode_end' => '06:00',
            'audible_policy' => 'standard',
            'volume_level' => 70,
            'snooze_enabled' => true,
            'snooze_minutes' => 5,
        ]);

        EscalationRule::firstOrCreate([
            'name' => 'Critical vitals escalation (ICU Ward A)',
        ], [
            'enabled' => true,
            'severity' => 'critical',
            'category' => 'Vitals',
            'ward_id' => $wardA->id,
            'ack_timeout_minutes' => 2,
            'resolve_timeout_minutes' => 15,
            'notify_channels' => 'dashboard,sms,email',
            'notify_targets' => 'icu-supervisor@icu.local,+255700000000',
            'priority' => 10,
        ]);

        EscalationRule::firstOrCreate([
            'name' => 'Device fault escalation (all wards)',
        ], [
            'enabled' => true,
            'severity' => 'high',
            'category' => 'Device',
            'ward_id' => null,
            'ack_timeout_minutes' => 5,
            'resolve_timeout_minutes' => 45,
            'notify_channels' => 'dashboard,email',
            'notify_targets' => 'biomed@icu.local',
            'priority' => 25,
        ]);

        $alertsToSeed = [
            [
                'severity' => 'critical',
                'status' => 'open',
                'category' => 'Vitals',
                'title' => 'SpO₂ dropped below threshold',
                'message' => 'SpO₂ = 82% for 35s. Immediate clinical review required.',
                'ward_id' => $wardA->id,
                'bed_id' => $bedsA->first()->id,
                'device_id' => $device3->id,
                'triggered_at' => now()->subMinutes(7),
                'metadata' => ['spo2' => 82, 'threshold' => 90],
            ],
            [
                'severity' => 'high',
                'status' => 'acknowledged',
                'category' => 'Device',
                'title' => 'Infusion Pump fault detected',
                'message' => 'Pump reports occlusion detected. Check line and restart.',
                'ward_id' => $wardA->id,
                'bed_id' => $bedsA->get(1)->id,
                'device_id' => $device2->id,
                'triggered_at' => now()->subMinutes(18),
                'acknowledged_at' => now()->subMinutes(14),
                'acknowledged_by_user_id' => $admin->id,
                'metadata' => ['fault_code' => 'OCCLUSION'],
            ],
            [
                'severity' => 'medium',
                'status' => 'resolved',
                'category' => 'Network',
                'title' => 'Packet loss elevated',
                'message' => 'Packet loss exceeded 2% for 3 minutes.',
                'ward_id' => null,
                'bed_id' => null,
                'device_id' => null,
                'triggered_at' => now()->subHours(2),
                'acknowledged_at' => now()->subHours(2)->addMinutes(3),
                'acknowledged_by_user_id' => $admin->id,
                'resolved_at' => now()->subHours(1)->addMinutes(40),
                'resolved_by_user_id' => $admin->id,
                'metadata' => ['link' => 'ISP 1', 'packet_loss_pct' => 2.2],
            ],
        ];

        foreach ($alertsToSeed as $row) {
            $alert = Alert::firstOrCreate([
                'title' => $row['title'],
                'triggered_at' => $row['triggered_at'],
            ], $row);

            AlertEvent::firstOrCreate([
                'alert_id' => $alert->id,
                'occurred_at' => $alert->triggered_at ?? now(),
                'type' => 'triggered',
            ], [
                'actor_type' => 'system',
                'actor_id' => null,
                'notes' => null,
                'metadata' => $row['metadata'] ?? null,
            ]);

            if (! empty($row['acknowledged_at'])) {
                AlertEvent::firstOrCreate([
                    'alert_id' => $alert->id,
                    'occurred_at' => $row['acknowledged_at'],
                    'type' => 'acknowledged',
                ], [
                    'actor_type' => 'user',
                    'actor_id' => (string) ($row['acknowledged_by_user_id'] ?? $admin->id),
                    'notes' => null,
                    'metadata' => null,
                ]);
            }

            if (! empty($row['resolved_at'])) {
                AlertEvent::firstOrCreate([
                    'alert_id' => $alert->id,
                    'occurred_at' => $row['resolved_at'],
                    'type' => 'resolved',
                ], [
                    'actor_type' => 'user',
                    'actor_id' => (string) ($row['resolved_by_user_id'] ?? $admin->id),
                    'notes' => null,
                    'metadata' => null,
                ]);
            }
        }

        SecuritySetting::firstOrCreate([], [
            'mfa_required_for_admin' => true,
            'ip_allowlist_enabled' => false,
            'ip_allowlist' => null,
            'session_timeout_minutes' => 60,
            'max_failed_logins_per_hour' => 10,
            'encryption_at_rest' => true,
            'encryption_in_transit' => true,
            'audit_logging_enabled' => true,
            'audit_retention_days' => 365,
            'password_policy' => 'strong',
        ]);

        ComplianceControl::firstOrCreate([
            'framework' => 'PDPA (Tanzania)',
            'control_code' => 'PDPA-01',
        ], [
            'title' => 'Lawful basis and consent records',
            'description' => 'Ensure consent records and lawful basis are documented for personal data processing.',
            'status' => 'warn',
            'enabled' => true,
            'last_checked_at' => now()->subDays(2),
            'owner' => 'Data Protection Officer',
        ]);

        ComplianceControl::firstOrCreate([
            'framework' => 'TMDA',
            'control_code' => 'TMDA-07',
        ], [
            'title' => 'Medical device incident reporting workflow',
            'description' => 'Incidents must be logged, triaged, and reported according to TMDA requirements.',
            'status' => 'pass',
            'enabled' => true,
            'last_checked_at' => now()->subDays(1),
            'owner' => 'Clinical Safety Officer',
        ]);

        ComplianceControl::firstOrCreate([
            'framework' => 'International',
            'control_code' => 'IEC-62304',
        ], [
            'title' => 'Software lifecycle documentation',
            'description' => 'Maintain lifecycle documentation, risk controls, and traceability for software changes.',
            'status' => 'fail',
            'enabled' => true,
            'last_checked_at' => now()->subDays(3),
            'owner' => 'Quality Manager',
        ]);

        PrivacyControl::firstOrCreate([
            'name' => 'Pseudonymization',
        ], [
            'enabled' => true,
            'mode' => 'standard',
            'config' => ['patient_id_hash' => true],
        ]);

        PrivacyControl::firstOrCreate([
            'name' => 'Data Minimization',
        ], [
            'enabled' => true,
            'mode' => 'strict',
            'config' => ['retain_telemetry_days' => 30],
        ]);

        PrivacyControl::firstOrCreate([
            'name' => 'Audit Access to Patient Records',
        ], [
            'enabled' => true,
            'mode' => 'always',
            'config' => ['log_fields' => ['who', 'when', 'what', 'why']],
        ]);

        PrivacyRequest::firstOrCreate([
            'request_type' => 'data_export',
            'subject_identifier' => 'patient:TZ-ICU-00012',
            'status' => 'open',
        ], [
            'notes' => 'Export clinical record for patient/guardian request.',
            'requested_at' => now()->subHours(6),
            'handled_by_user_id' => null,
            'metadata' => ['format' => 'csv'],
        ]);

        PrivacyRequest::firstOrCreate([
            'request_type' => 'access_log',
            'subject_identifier' => 'patient:TZ-ICU-00012',
            'status' => 'completed',
        ], [
            'notes' => 'Provided access log report.',
            'requested_at' => now()->subDays(2),
            'completed_at' => now()->subDays(2)->addHours(3),
            'handled_by_user_id' => $admin->id,
            'metadata' => null,
        ]);

        WardAccessRule::firstOrCreate([
            'ward_id' => $wardA->id,
            'role_id' => $roles->firstWhere('name', 'ICU Nurse')->id,
        ], [
            'allowed_beds' => '1,2,3,4,5',
            'shift_start' => '08:00',
            'shift_end' => '20:00',
            'reason' => 'Standard day shift access',
        ]);

        WardAccessRule::firstOrCreate([
            'ward_id' => $wardB->id,
            'user_id' => $doctor->id,
        ], [
            'allowed_beds' => 'all',
            'shift_start' => '00:00',
            'shift_end' => '23:59',
            'reason' => 'Consultant physician',
        ]);

        AuditLog::firstOrCreate([
            'action' => 'role.assigned',
            'target_type' => 'User',
            'target_id' => (string) $doctor->id,
        ], [
            'occurred_at' => now()->subMinutes(12),
            'actor_user_id' => $admin->id,
            'result' => 'ok',
            'ip' => '127.0.0.1',
            'user_agent' => 'Seeder',
            'metadata' => ['role' => 'ICU Physician'],
        ]);

        AuditLog::firstOrCreate([
            'action' => 'ward_access_rule.created',
            'target_type' => 'WardAccessRule',
            'target_id' => '1',
        ], [
            'occurred_at' => now()->subMinutes(6),
            'actor_user_id' => $admin->id,
            'result' => 'ok',
            'ip' => '127.0.0.1',
            'user_agent' => 'Seeder',
            'metadata' => ['ward' => 'ICU Ward A'],
        ]);

        AiModel::firstOrCreate([
            'name' => 'ICU Risk Scoring',
        ], [
            'provider' => 'local',
            'model_key' => 'icu-risk-v1',
            'status' => 'active',
            'risk_level' => 3,
            'requires_human_review' => true,
            'temperature' => 0.20,
            'max_tokens' => 1024,
            'guardrails' => ['no_phi_in_output' => true, 'cite_source' => false],
        ]);

        AiModel::firstOrCreate([
            'name' => 'Anomaly Detection',
        ], [
            'provider' => 'local',
            'model_key' => 'anomaly-v2',
            'status' => 'active',
            'risk_level' => 2,
            'requires_human_review' => false,
            'temperature' => 0.10,
            'max_tokens' => 512,
            'guardrails' => ['no_phi_in_output' => true],
        ]);

        $tmpl1 = ReportTemplate::firstOrCreate([
            'name' => 'Alerts Performance (24h)',
        ], [
            'category' => 'Safety',
            'status' => 'active',
            'description' => 'Acknowledgement and resolution performance by severity.',
            'definition' => ['source' => 'alerts', 'window' => '24h'],
        ]);

        $tmpl2 = ReportTemplate::firstOrCreate([
            'name' => 'Device Uptime Summary',
        ], [
            'category' => 'Operations',
            'status' => 'active',
            'description' => 'Device online/offline/fault counts by ward and type.',
            'definition' => ['source' => 'devices', 'group_by' => ['ward', 'type']],
        ]);

        ReportRun::firstOrCreate([
            'report_template_id' => $tmpl1->id,
            'requested_at' => now()->subHours(4),
        ], [
            'status' => 'completed',
            'started_at' => now()->subHours(4),
            'completed_at' => now()->subHours(4)->addMinutes(1),
            'rows' => 120,
            'output_format' => 'csv',
            'filters' => null,
            'notes' => 'Seeded sample report run',
        ]);

        ReportRun::firstOrCreate([
            'report_template_id' => $tmpl2->id,
            'requested_at' => now()->subDays(1),
        ], [
            'status' => 'completed',
            'started_at' => now()->subDays(1),
            'completed_at' => now()->subDays(1)->addMinutes(2),
            'rows' => 85,
            'output_format' => 'csv',
            'filters' => null,
            'notes' => 'Seeded sample report run',
        ]);

        GeneralSetting::firstOrCreate([], [
            'hospital_name' => 'ICU Monitoring Solutions',
            'timezone' => 'Africa/Dar_es_Salaam',
            'locale' => 'en',
            'maintenance_mode' => false,
            'data_retention_policy' => '365d',
            'alerts_enabled' => true,
            'default_severity' => 'medium',
            'metadata' => ['region' => 'TZ'],
        ]);

        IntegrationSetting::firstOrCreate([
            'name' => 'HL7 FHIR Gateway',
        ], [
            'type' => 'FHIR',
            'enabled' => false,
            'status' => 'disconnected',
            'endpoint_url' => 'https://example.local/fhir',
            'credentials' => ['token' => '***'],
            'config' => ['verify_ssl' => true],
            'last_sync_at' => null,
            'notes' => 'Wire to real hospital gateway',
        ]);

        IntegrationSetting::firstOrCreate([
            'name' => 'SMS Provider',
        ], [
            'type' => 'SMS',
            'enabled' => true,
            'status' => 'connected',
            'endpoint_url' => 'https://sms.example.local',
            'credentials' => ['api_key' => '***'],
            'config' => ['sender_id' => 'ICU'],
            'last_sync_at' => now()->subMinutes(30),
            'notes' => 'Seeded integration status',
        ]);

        $es = EmergencyState::firstOrCreate([], [
            'override_enabled' => false,
            'surge_mode_enabled' => false,
            'surge_level' => 'normal',
            'extra_capacity_beds' => 0,
            'lockdown_enabled' => false,
            'lockdown_scope' => 'admin',
        ]);

        EmergencyEvent::firstOrCreate([
            'type' => 'system.boot',
            'occurred_at' => now()->subHours(5),
        ], [
            'status' => 'ok',
            'actor_user_id' => $admin->id,
            'notes' => 'Seeded startup event',
            'metadata' => ['state_id' => $es->id],
        ]);

        BackupJob::firstOrCreate([
            'type' => 'backup',
            'requested_at' => now()->subHours(12),
        ], [
            'scope' => 'full',
            'status' => 'completed',
            'started_at' => now()->subHours(12),
            'completed_at' => now()->subHours(12)->addMinutes(3),
            'size_mb' => 640,
            'storage' => 'local',
            'artifact_path' => 'backups/backup_seed.zip',
            'notes' => 'Seeded backup job',
        ]);

        ExportJob::firstOrCreate([
            'dataset' => 'alerts',
            'requested_at' => now()->subHours(8),
        ], [
            'format' => 'csv',
            'status' => 'completed',
            'completed_at' => now()->subHours(8)->addMinutes(1),
            'rows' => 120,
            'artifact_path' => 'exports/alerts_seed.csv',
            'notes' => 'Seeded export job',
            'filters' => null,
        ]);

        $p1 = Patient::firstOrCreate([
            'mrn' => 'TZ-ICU-00012',
        ], [
            'full_name' => 'Asha M.',
            'sex' => 'F',
            'dob' => '1979-04-12',
            'phone' => '+255700000111',
            'national_id' => 'TZ-NID-123456',
            'status' => 'admitted',
        ]);

        $p2 = Patient::firstOrCreate([
            'mrn' => 'TZ-ICU-00013',
        ], [
            'full_name' => 'Juma K.',
            'sex' => 'M',
            'dob' => '1968-09-03',
            'phone' => '+255700000222',
            'national_id' => 'TZ-NID-789012',
            'status' => 'admitted',
        ]);

        $adm1 = PatientAdmission::firstOrCreate([
            'patient_id' => $p1->id,
            'status' => 'active',
        ], [
            'ward_id' => $wardA->id,
            'bed_id' => $bedsA->first()->id,
            'admitted_at' => now()->subDays(2),
            'primary_diagnosis' => 'Severe pneumonia',
            'attending_physician' => 'Dr. ICU Doctor',
        ]);

        $adm2 = PatientAdmission::firstOrCreate([
            'patient_id' => $p2->id,
            'status' => 'active',
        ], [
            'ward_id' => $wardB->id,
            'bed_id' => $bedsB->first()->id,
            'admitted_at' => now()->subDays(1),
            'primary_diagnosis' => 'Sepsis',
            'attending_physician' => 'Dr. ICU Doctor',
        ]);

        for ($i = 0; $i < 24; $i++) {
            $t = now()->subHours(24 - $i);

            PatientVital::firstOrCreate([
                'patient_id' => $p1->id,
                'admission_id' => $adm1->id,
                'measured_at' => $t,
            ], [
                'hr' => 85 + (($i % 5) - 2),
                'spo2' => 94 + (($i % 4) - 2),
                'rr' => 18 + (($i % 3) - 1),
                'temp_c' => 37.2,
                'sbp' => 118 + (($i % 6) - 3),
                'dbp' => 74 + (($i % 4) - 2),
            ]);

            PatientVital::firstOrCreate([
                'patient_id' => $p2->id,
                'admission_id' => $adm2->id,
                'measured_at' => $t,
            ], [
                'hr' => 98 + (($i % 6) - 3),
                'spo2' => 92 + (($i % 5) - 2),
                'rr' => 22 + (($i % 4) - 2),
                'temp_c' => 38.1,
                'sbp' => 105 + (($i % 8) - 4),
                'dbp' => 66 + (($i % 6) - 3),
            ]);
        }

        $waveSamples = [];
        for ($i = 0; $i < 180; $i++) {
            $waveSamples[] = (int) round(50 + 25 * sin($i / 8) + random_int(-3, 3));
        }

        PatientWaveform::firstOrCreate([
            'patient_id' => $p1->id,
            'admission_id' => $adm1->id,
            'captured_at' => now()->subMinutes(10),
            'type' => 'ecg',
        ], [
            'samples' => $waveSamples,
            'sample_rate_hz' => 50,
        ]);

        LabResult::firstOrCreate([
            'patient_id' => $p1->id,
            'test_code' => 'WBC',
            'resulted_at' => now()->subHours(5),
        ], [
            'admission_id' => $adm1->id,
            'panel' => 'CBC',
            'test_name' => 'White Blood Cells',
            'value' => '14.2',
            'unit' => '10^9/L',
            'flag' => 'H',
            'reference_range' => '4.0 - 11.0',
        ]);

        LabResult::firstOrCreate([
            'patient_id' => $p1->id,
            'test_code' => 'CRP',
            'resulted_at' => now()->subHours(5),
        ], [
            'admission_id' => $adm1->id,
            'panel' => 'Inflammation',
            'test_name' => 'C-Reactive Protein',
            'value' => '92',
            'unit' => 'mg/L',
            'flag' => 'H',
            'reference_range' => '< 5',
        ]);

        MedicationOrder::firstOrCreate([
            'patient_id' => $p1->id,
            'drug_name' => 'Ceftriaxone',
            'ordered_at' => now()->subHours(20),
        ], [
            'admission_id' => $adm1->id,
            'dose' => '2 g',
            'route' => 'IV',
            'frequency' => 'OD',
            'status' => 'active',
            'ordered_by' => 'Dr. ICU Doctor',
            'notes' => 'Empiric coverage',
        ]);

        AiRiskPrediction::firstOrCreate([
            'patient_id' => $p1->id,
            'model' => 'icu-risk-v1',
            'predicted_at' => now()->subHours(2),
        ], [
            'admission_id' => $adm1->id,
            'risk_score' => 78,
            'risk_level' => 'high',
            'top_factors' => ['SpO2 trend', 'CRP high', 'RR elevated'],
            'recommendation' => 'Increase monitoring frequency; evaluate for escalation of respiratory support.',
        ]);

        TeleIcuSession::firstOrCreate([
            'patient_id' => $p1->id,
            'started_at' => now()->subHours(3),
        ], [
            'admission_id' => $adm1->id,
            'remote_site' => 'Tele-ICU Hub (Dar es Salaam)',
            'clinician' => 'Dr. Remote Specialist',
            'status' => 'completed',
            'ended_at' => now()->subHours(2)->addMinutes(30),
            'link' => 'https://teleicu.example.local/session/seed',
            'notes' => 'Seeded Tele-ICU consult',
        ]);
    }
}
