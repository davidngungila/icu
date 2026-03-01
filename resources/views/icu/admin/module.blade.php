@extends('layouts.app')

@php
    $modules = [
        'admin/users/overview' => [
            'title' => 'Users Overview',
            'cards' => ['Total Users', 'Active Sessions', 'Suspended Accounts', 'Failed Login Attempts'],
            'mode' => 'table',
            'primaryAction' => 'Create User',
            'table' => ['Name', 'Email', 'Role', 'Status', 'Last Login'],
        ],
        'admin/users/audit-trail' => [
            'title' => 'Audit Trail',
            'cards' => ['Logins', 'Data Access', 'Patient Record Edits', 'Alert Acknowledgments'],
            'mode' => 'table',
            'primaryAction' => 'Export Logs',
            'table' => ['Time', 'Actor', 'Action', 'Target', 'Result'],
        ],
        'admin/users/roles' => [
            'title' => 'Roles & Permissions',
            'cards' => ['Custom Roles', 'Module Access', 'Ward Restrictions', 'Shift-based Access'],
            'mode' => 'form',
            'primaryAction' => 'Create Role',
            'fields' => ['Role Name', 'Modules Allowed', 'Ward Scope', 'Time-Based Access', 'IP Restriction'],
        ],
        'admin/users/ward-access' => [
            'title' => 'Ward Access Control',
            'cards' => ['Wards', 'Restricted Users', 'Shift Rules', 'Overrides'],
            'mode' => 'form',
            'primaryAction' => 'Add Restriction',
            'fields' => ['Ward', 'Role/User', 'Allowed Beds', 'Shift Window', 'Reason'],
        ],
        'admin/devices/overview' => [
            'title' => 'ICU Device Overview',
            'cards' => ['Online', 'Offline', 'Fault', 'Calibration Due'],
            'mode' => 'table',
            'primaryAction' => 'Register Device',
            'table' => ['Ward', 'Bed', 'Device Type', 'Firmware', 'Last Calibration', 'Status'],
        ],
        'admin/devices/control' => [
            'title' => 'Device Control Panel',
            'cards' => ['Selected Device', 'Diagnostics', 'Threshold Profiles', 'Recent Faults'],
            'mode' => 'actions',
            'primaryAction' => 'Run Diagnostics',
            'actions' => ['Restart Device', 'Firmware Update', 'Remote Diagnostics', 'Configuration', 'Alert Thresholds'],
        ],
        'admin/devices/maintenance' => [
            'title' => 'Maintenance Scheduler',
            'cards' => ['Upcoming Maintenance', 'Calibration Reminders', 'Repair Logs', 'Replacement History'],
            'mode' => 'table',
            'primaryAction' => 'Schedule Maintenance',
            'table' => ['Device', 'Type', 'Due Date', 'Assigned', 'Status'],
        ],
        'admin/health/servers' => [
            'title' => 'Server Monitoring',
            'cards' => ['CPU', 'RAM', 'Disk/RAID', 'Temperature'],
            'mode' => 'table',
            'primaryAction' => 'Run Health Check',
            'table' => ['Node', 'CPU %', 'RAM %', 'Disk %', 'Temp', 'Status'],
        ],
        'admin/health/network' => [
            'title' => 'Network Monitoring',
            'cards' => ['Packet Loss %', 'Latency', 'Switch Status', 'VLAN Integrity'],
            'mode' => 'table',
            'primaryAction' => 'Run Network Test',
            'table' => ['Link', 'Latency', 'Packet Loss', 'Switch', 'VLAN', 'Firewall'],
        ],
        'admin/health/cloud-backup' => [
            'title' => 'Cloud Backup Monitoring',
            'cards' => ['Last Backup', 'Sync Status', 'Encryption Status', 'Recovery Tests'],
            'mode' => 'actions',
            'primaryAction' => 'Trigger Backup',
            'actions' => ['Trigger Manual Backup', 'Run Recovery Test', 'View Sync Logs', 'Rotate Keys'],
        ],
        'admin/alerts/control-center' => [
            'title' => 'Alert Control Center',
            'cards' => ['Warning', 'Critical', 'Device Failure', 'System Failure'],
            'mode' => 'form',
            'primaryAction' => 'Save Configuration',
            'fields' => ['Alert Levels', 'Notification Channels', 'Acknowledgement Window', 'Quiet Hours'],
        ],
        'admin/alerts/escalation' => [
            'title' => 'Escalation Rules',
            'cards' => ['Nurse → Doctor', 'Doctor → Supervisor', 'Supervisor → Emergency', 'Unacknowledged SLA'],
            'mode' => 'table',
            'primaryAction' => 'Add Escalation Rule',
            'table' => ['Level', 'From', 'To', 'Timeout', 'Channels'],
        ],
        'admin/alerts/alarm-settings' => [
            'title' => 'Alarm & Night Mode',
            'cards' => ['Volume', 'Sound Type', 'Silent Rules', 'Night Mode'],
            'mode' => 'form',
            'primaryAction' => 'Apply Alarm Profile',
            'fields' => ['Volume', 'Sound Type', 'Silent Mode Rules', 'Night Mode Schedule'],
        ],
        'admin/security/settings' => [
            'title' => 'Security Settings',
            'cards' => ['MFA', 'Password Policy', 'Session Timeout', 'Key Management'],
            'mode' => 'form',
            'primaryAction' => 'Update Security Policy',
            'fields' => ['Enable MFA', 'Password Policy', 'Session Timeout', 'Encryption Keys'],
        ],
        'admin/security/compliance' => [
            'title' => 'Compliance Module',
            'cards' => ['PDPA', 'TMDA', 'HISG', 'Retention Policies'],
            'mode' => 'table',
            'primaryAction' => 'Export Compliance Logs',
            'table' => ['Standard', 'Event', 'Actor', 'Scope', 'Timestamp'],
        ],
        'admin/security/privacy' => [
            'title' => 'Data Privacy Controls',
            'cards' => ['Data Masking', 'Restricted Fields', 'Emergency Override', 'Visibility Rules'],
            'mode' => 'form',
            'primaryAction' => 'Save Privacy Rules',
            'fields' => ['Masking Level', 'Restricted Fields', 'Emergency Override', 'Logging Detail'],
        ],
        'admin/ai/model-settings' => [
            'title' => 'AI Model Settings',
            'cards' => ['AI Modules', 'Thresholds', 'Model Version', 'Training Data Monitor'],
            'mode' => 'form',
            'primaryAction' => 'Apply AI Settings',
            'fields' => ['Enable Modules', 'Risk Thresholds', 'Model Version', 'Data Drift Monitor'],
        ],
        'admin/ai/advanced-reports' => [
            'title' => 'Advanced Reports',
            'cards' => ['Mortality Trends', 'Length of Stay', 'Sepsis Accuracy', 'Alert Fatigue'],
            'mode' => 'table',
            'primaryAction' => 'Generate Report',
            'table' => ['Report', 'Range', 'Status', 'Generated By', 'Last Run'],
        ],
        'admin/config/general' => [
            'title' => 'General Settings',
            'cards' => ['Hospital Info', 'Wards', 'Beds', 'Localization'],
            'mode' => 'form',
            'primaryAction' => 'Save Settings',
            'fields' => ['Hospital Information', 'ICU Ward Configuration', 'Bed Setup', 'Timezone & Localization'],
        ],
        'admin/config/integrations' => [
            'title' => 'Integration Settings',
            'cards' => ['EMR', 'Lab', 'Pharmacy', 'HL7 / FHIR'],
            'mode' => 'form',
            'primaryAction' => 'Save Integrations',
            'fields' => ['EMR API Keys', 'Lab Integration', 'Pharmacy Integration', 'HL7 / FHIR Configuration'],
        ],
        'admin/emergency/override' => [
            'title' => 'Emergency Override',
            'cards' => ['Mass Broadcast', 'Disaster Mode', 'Surge Mode', 'Lockdown'],
            'mode' => 'actions',
            'primaryAction' => 'Broadcast Alert',
            'actions' => ['Mass Alert Broadcast', 'Disaster Mode Activation', 'ICU Surge Mode', 'Manual Lockdown'],
        ],
        'admin/emergency/surge-mode' => [
            'title' => 'Disaster & Surge Mode',
            'cards' => ['Surge Capacity', 'Triage Rules', 'Resource Allocation', 'Broadcasts'],
            'mode' => 'form',
            'primaryAction' => 'Activate Mode',
            'fields' => ['Surge Capacity', 'Triage Rules', 'Staffing Overrides', 'Notification Template'],
        ],
        'admin/emergency/lockdown' => [
            'title' => 'Manual System Lockdown',
            'cards' => ['Lock Scope', 'Session Termination', 'Access Freeze', 'Audit Logging'],
            'mode' => 'actions',
            'primaryAction' => 'Lock System',
            'actions' => ['Lock Web Access', 'Lock Device Control', 'Invalidate Sessions', 'Enable Emergency Access'],
        ],
        'admin/data/backup-restore' => [
            'title' => 'Backup & Restore',
            'cards' => ['Last Backup', 'Sync Status', 'Encryption', 'Recovery Tests'],
            'mode' => 'actions',
            'primaryAction' => 'Trigger Backup',
            'actions' => ['Manual Backup Trigger', 'Backup Scheduling', 'Full System Restore', 'Partial Restore'],
        ],
        'admin/data/export' => [
            'title' => 'Data Export',
            'cards' => ['Patient Records', 'Device Logs', 'Audit Logs', 'Research Export'],
            'mode' => 'table',
            'primaryAction' => 'Export CSV',
            'table' => ['Dataset', 'Filters', 'Format', 'Last Export', 'Status'],
        ],
    ];

    $meta = $modules[$page] ?? [
        'title' => $title,
        'cards' => ['Module', 'Policies', 'Controls', 'Reports'],
        'mode' => 'table',
        'primaryAction' => 'Save',
        'table' => ['Field', 'Value', 'Updated By', 'Updated At'],
    ];
@endphp

@section('content')
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
            <h1 class="text-2xl font-semibold tracking-tight truncate">{{ $meta['title'] }}</h1>
            <div class="text-sm text-slate-500">Super Admin module page (structured placeholder)</div>
        </div>

        <div class="flex items-center gap-2">
            <x-search-input placeholder="Search in this module..." />
            <button type="button" class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">
                {{ $meta['primaryAction'] ?? 'Action' }}
            </button>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        @foreach ($meta['cards'] as $card)
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
                <div class="text-sm text-slate-500">{{ $card }}</div>
                <div class="mt-2 text-3xl font-semibold">—</div>
                <div class="mt-2 text-xs text-slate-500">Integrate live metrics here.</div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="xl:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="flex items-center justify-between gap-3">
                <div class="text-sm font-semibold">Control Panel</div>
                <div class="text-sm text-slate-500">Tailored placeholder UI for this module</div>
            </div>

            @if (($meta['mode'] ?? 'table') === 'actions')
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach (($meta['actions'] ?? []) as $action)
                        <button type="button" class="h-12 px-4 rounded-2xl bg-slate-50 hover:bg-slate-100 border border-slate-200/80 text-left">
                            <div class="text-sm font-medium">{{ $action }}</div>
                            <div class="text-xs text-slate-500">Simulated action (wire backend later)</div>
                        </button>
                    @endforeach
                </div>
            @elseif (($meta['mode'] ?? 'table') === 'form')
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach (($meta['fields'] ?? []) as $field)
                        <div>
                            <div class="text-xs text-slate-500">{{ $field }}</div>
                            <input type="text" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" placeholder="{{ $field }}" />
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <button type="button" class="h-11 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Save</button>
                </div>
            @else
                <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200/80">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50">
                            <tr>
                                @foreach (($meta['table'] ?? []) as $th)
                                    <th class="text-left px-4 py-3 font-semibold text-slate-600">{{ $th }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 6; $i++)
                                <tr class="border-t border-slate-200/80">
                                    @foreach (($meta['table'] ?? []) as $th)
                                        <td class="px-4 py-3 text-slate-600">—</td>
                                    @endforeach
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="bg-white border border-slate-200/80 rounded-2xl p-5">
            <div class="text-sm font-semibold">Audit / Activity</div>
            <div class="mt-4 space-y-2">
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-sm font-medium">Action event</div>
                    <div class="text-xs text-slate-500">Timestamp · Actor · Target</div>
                </div>
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-sm font-medium">Policy evaluation</div>
                    <div class="text-xs text-slate-500">Allowed / Denied · Reason</div>
                </div>
                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="text-sm font-medium">Export job</div>
                    <div class="text-xs text-slate-500">CSV/PDF · Queue status</div>
                </div>
            </div>
        </div>
    </div>
@endsection
