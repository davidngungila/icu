<?php

return [
    'roles' => [
        'admin' => 'Admin / IT Administrator',
        'doctor' => 'Doctor / ICU Physician',
        'nurse' => 'Nurse / ICU Nurse',
        'technician' => 'Technician / Biomedical Engineer',
        'pharmacist' => 'Pharmacist',
        'lab' => 'Lab Technician',
        'supervisor' => 'Hospital Management / Supervisor',
    ],

    'menus' => [
        'admin' => [
            [
                'label' => 'Command Center',
                'page' => 'admin/command-center',
            ],
            [
                'label' => 'User Management',
                'children' => [
                    ['label' => 'Users Overview', 'page' => 'admin/users/overview'],
                    ['label' => 'Roles & Permissions', 'page' => 'admin/users/roles'],
                    ['label' => 'Ward Access Control', 'page' => 'admin/users/ward-access'],
                    ['label' => 'Audit Trail', 'page' => 'admin/users/audit-trail'],
                ],
            ],
            [
                'label' => 'Device & Sensor Management',
                'children' => [
                    ['label' => 'ICU Device Overview', 'page' => 'admin/devices/overview'],
                    ['label' => 'Device Control Panel', 'page' => 'admin/devices/control'],
                    ['label' => 'Maintenance Scheduler', 'page' => 'admin/devices/maintenance'],
                ],
            ],
            [
                'label' => 'System Health Monitoring',
                'children' => [
                    ['label' => 'Server Monitoring', 'page' => 'admin/health/servers'],
                    ['label' => 'Network Monitoring', 'page' => 'admin/health/network'],
                    ['label' => 'Cloud Backup Monitoring', 'page' => 'admin/health/cloud-backup'],
                ],
            ],
            [
                'label' => 'Alert Management',
                'children' => [
                    ['label' => 'Alert Control Center', 'page' => 'admin/alerts/control-center'],
                    ['label' => 'Escalation Rules', 'page' => 'admin/alerts/escalation'],
                    ['label' => 'Alarm & Night Mode', 'page' => 'admin/alerts/alarm-settings'],
                ],
            ],
            [
                'label' => 'Security & Compliance',
                'children' => [
                    ['label' => 'Security Settings', 'page' => 'admin/security/settings'],
                    ['label' => 'Compliance Module', 'page' => 'admin/security/compliance'],
                    ['label' => 'Data Privacy Controls', 'page' => 'admin/security/privacy'],
                ],
            ],
            [
                'label' => 'AI & Analytics Control',
                'children' => [
                    ['label' => 'AI Model Settings', 'page' => 'admin/ai/model-settings'],
                    ['label' => 'Advanced Reports', 'page' => 'admin/ai/advanced-reports'],
                ],
            ],
            [
                'label' => 'System Configuration',
                'children' => [
                    ['label' => 'General Settings', 'page' => 'admin/config/general'],
                    ['label' => 'Integration Settings', 'page' => 'admin/config/integrations'],
                ],
            ],
            [
                'label' => 'Emergency Control',
                'children' => [
                    ['label' => 'Emergency Override', 'page' => 'admin/emergency/override'],
                    ['label' => 'Disaster & Surge Mode', 'page' => 'admin/emergency/surge-mode'],
                    ['label' => 'Manual System Lockdown', 'page' => 'admin/emergency/lockdown'],
                ],
            ],
            [
                'label' => 'Data Management',
                'children' => [
                    ['label' => 'Backup & Restore', 'page' => 'admin/data/backup-restore'],
                    ['label' => 'Data Export', 'page' => 'admin/data/export'],
                ],
            ],
        ],

        'doctor' => [
            [
                'label' => 'Dashboard',
                'page' => 'doctor/dashboard',
            ],
            [
                'label' => 'Live Monitor',
                'page' => 'doctor/live-monitor',
            ],
            [
                'label' => 'Patient List',
                'page' => 'doctor/patients',
            ],
            [
                'label' => 'Patient Details',
                'children' => [
                    ['label' => 'Vitals & Waveforms', 'page' => 'doctor/patient/vitals'],
                    ['label' => 'Lab Results', 'page' => 'doctor/patient/labs'],
                    ['label' => 'Medication Orders', 'page' => 'doctor/patient/meds'],
                    ['label' => 'AI Risk Prediction', 'page' => 'doctor/patient/ai-risk'],
                ],
            ],
            [
                'label' => 'Alerts',
                'children' => [
                    ['label' => 'Active Alerts', 'page' => 'doctor/alerts/active'],
                    ['label' => 'Acknowledged Alerts', 'page' => 'doctor/alerts/ack'],
                    ['label' => 'Alert History', 'page' => 'doctor/alerts/history'],
                ],
            ],
            [
                'label' => 'Reports',
                'children' => [
                    ['label' => 'Daily / Weekly Patient Trends', 'page' => 'doctor/reports/trends'],
                    ['label' => 'Risk Score Summaries', 'page' => 'doctor/reports/risk-summaries'],
                ],
            ],
            [
                'label' => 'Tele-ICU Access',
                'page' => 'doctor/tele-icu',
            ],
        ],

        'nurse' => [
            [
                'label' => 'Dashboard',
                'route' => 'icu.page',
                'params' => ['page' => 'dashboard'],
            ],
            [
                'label' => 'Patient Care',
                'children' => [
                    ['label' => 'View Patient Vitals', 'page' => 'nurse/patient/vitals'],
                    ['label' => 'Medication Administration', 'page' => 'nurse/patient/med-admin'],
                    ['label' => 'Record Observations', 'page' => 'nurse/patient/observations'],
                ],
            ],
            [
                'label' => 'Alerts',
                'page' => 'nurse/alerts',
            ],
            [
                'label' => 'Device Status',
                'page' => 'nurse/device-status',
            ],
            [
                'label' => 'Shift Notes',
                'page' => 'nurse/shift-notes',
            ],
            [
                'label' => 'Bed Management',
                'page' => 'nurse/bed-management',
            ],
        ],

        'technician' => [
            [
                'label' => 'Dashboard',
                'route' => 'icu.page',
                'params' => ['page' => 'dashboard'],
            ],
            [
                'label' => 'Device List',
                'page' => 'tech/devices',
            ],
            [
                'label' => 'Device Status',
                'page' => 'tech/device-status',
            ],
            [
                'label' => 'Maintenance Logs',
                'page' => 'tech/maintenance',
            ],
            [
                'label' => 'Alert History',
                'page' => 'tech/alerts',
            ],
            [
                'label' => 'System Tools',
                'page' => 'tech/tools',
            ],
        ],

        'pharmacist' => [
            [
                'label' => 'Dashboard',
                'route' => 'icu.page',
                'params' => ['page' => 'dashboard'],
            ],
            [
                'label' => 'Patient Medication Orders',
                'page' => 'pharmacy/orders',
            ],
            [
                'label' => 'Inventory Management',
                'page' => 'pharmacy/inventory',
            ],
            [
                'label' => 'Reports',
                'page' => 'pharmacy/reports',
            ],
        ],

        'lab' => [
            [
                'label' => 'Dashboard',
                'route' => 'icu.page',
                'params' => ['page' => 'dashboard'],
            ],
            [
                'label' => 'Test Orders',
                'page' => 'lab/orders',
            ],
            [
                'label' => 'Results Entry',
                'page' => 'lab/results-entry',
            ],
            [
                'label' => 'Reports',
                'page' => 'lab/reports',
            ],
        ],

        'supervisor' => [
            [
                'label' => 'Dashboard',
                'route' => 'icu.page',
                'params' => ['page' => 'dashboard'],
            ],
            [
                'label' => 'Reports',
                'page' => 'supervisor/reports',
            ],
            [
                'label' => 'Compliance',
                'page' => 'supervisor/compliance',
            ],
            [
                'label' => 'Staff Management',
                'page' => 'supervisor/staff',
            ],
            [
                'label' => 'Analytics',
                'page' => 'supervisor/analytics',
            ],
        ],
    ],
];
