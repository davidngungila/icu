<?php

return [
    'dashboard' => [
        'label' => 'Dashboard',
        'page' => 'dashboard',
        'icon' => 'dashboard',
        'priority' => 1,
        'badge' => null,
        'permissions' => ['view_dashboard'],
    ],

    'hms_system' => [
        'label' => 'HMS System',
        'icon' => 'workflow',
        'priority' => 1.5,
        'badge' => null,
        'permissions' => ['view_hms'],
        'url' => '/hms/dashboard',
        'external' => true,
    ],

    'patient_care' => [
        'label' => 'Patient Care',
        'icon' => 'patients',
        'priority' => 2,
        'badge' => null,
        'permissions' => ['view_patients'],
        'children' => [
            [
                'label' => 'View Patient Vitals',
                'page' => 'patient-vitals',
                'icon' => 'heart',
                'permissions' => ['view_vitals'],
                'badge' => [
                    'type' => 'critical',
                    'count' => 3,
                    'pulse' => true
                ]
            ],
            [
                'label' => 'Medication Administration',
                'page' => 'medication-admin',
                'icon' => 'pills',
                'permissions' => ['administer_medication'],
                'badge' => [
                    'type' => 'warning',
                    'count' => 5,
                    'pulse' => false
                ]
            ],
            [
                'label' => 'Record Observations',
                'page' => 'observations',
                'icon' => 'clipboard',
                'permissions' => ['record_observations'],
            ],
            [
                'label' => 'Alerts Management',
                'page' => 'alerts',
                'icon' => 'alerts',
                'permissions' => ['manage_alerts'],
                'badge' => [
                    'type' => 'critical',
                    'count' => 12,
                    'pulse' => true
                ]
            ],
            [
                'label' => 'Device Status',
                'page' => 'device-status',
                'icon' => 'device',
                'permissions' => ['view_devices'],
                'badge' => [
                    'type' => 'warning',
                    'count' => 2,
                    'pulse' => false
                ]
            ],
            [
                'label' => 'Shift Notes',
                'page' => 'shift-notes',
                'icon' => 'clipboard-text',
                'permissions' => ['view_shift_notes'],
            ],
            [
                'label' => 'Bed Management',
                'page' => 'bed-management',
                'icon' => 'bed',
                'permissions' => ['manage_beds'],
                'badge' => [
                    'type' => 'info',
                    'count' => 8,
                    'pulse' => false
                ]
            ],
        ]
    ],

    'monitoring' => [
        'label' => 'Real-time Monitoring',
        'icon' => 'monitor',
        'priority' => 3,
        'permissions' => ['view_monitoring'],
        'children' => [
            [
                'label' => 'Live Vitals Stream',
                'page' => 'live-vitals',
                'icon' => 'activity',
                'permissions' => ['view_live_vitals'],
                'realtime' => true
            ],
            [
                'label' => 'Ventilator Management',
                'page' => 'ventilators',
                'icon' => 'lungs',
                'permissions' => ['manage_ventilators'],
            ],
            [
                'label' => 'Infusion Pumps',
                'page' => 'infusion-pumps',
                'icon' => 'droplet',
                'permissions' => ['manage_pumps'],
            ],
            [
                'label' => 'Cardiac Monitors',
                'page' => 'cardiac-monitors',
                'icon' => 'heart-pulse',
                'permissions' => ['view_cardiac'],
            ],
        ]
    ],

    'clinical_workflows' => [
        'label' => 'Clinical Workflows',
        'icon' => 'workflow',
        'priority' => 4,
        'permissions' => ['view_workflows'],
        'children' => [
            [
                'label' => 'Admission Process',
                'page' => 'admission',
                'icon' => 'user-plus',
                'permissions' => ['manage_admission'],
            ],
            [
                'label' => 'Care Plans',
                'page' => 'care-plans',
                'icon' => 'file-medical',
                'permissions' => ['manage_care_plans'],
            ],
            [
                'label' => 'Discharge Planning',
                'page' => 'discharge',
                'icon' => 'user-minus',
                'permissions' => ['manage_discharge'],
            ],
            [
                'label' => 'Handover Protocol',
                'page' => 'handover',
                'icon' => 'repeat',
                'permissions' => ['manage_handover'],
            ],
        ]
    ],

    'analytics' => [
        'label' => 'Analytics & Reports',
        'icon' => 'reports',
        'priority' => 5,
        'permissions' => ['view_analytics'],
        'children' => [
            [
                'label' => 'Patient Trends',
                'page' => 'patient-trends',
                'icon' => 'trending-up',
                'permissions' => ['view_trends'],
            ],
            [
                'label' => 'ICU Performance',
                'page' => 'performance',
                'icon' => 'bar-chart',
                'permissions' => ['view_performance'],
            ],
            [
                'label' => 'Compliance Reports',
                'page' => 'compliance',
                'icon' => 'shield-check',
                'permissions' => ['view_compliance'],
            ],
            [
                'label' => 'Quality Metrics',
                'page' => 'quality-metrics',
                'icon' => 'award',
                'permissions' => ['view_quality'],
            ],
        ]
    ],

    'communication' => [
        'label' => 'Communication',
        'icon' => 'message-square',
        'priority' => 6,
        'permissions' => ['use_communication'],
        'badge' => [
            'type' => 'info',
            'count' => 7,
            'pulse' => false
        ],
        'children' => [
            [
                'label' => 'Team Messaging',
                'page' => 'team-chat',
                'icon' => 'users',
                'permissions' => ['use_chat'],
                'realtime' => true
            ],
            [
                'label' => 'Consultation Requests',
                'page' => 'consultations',
                'icon' => 'phone-call',
                'permissions' => ['request_consultation'],
            ],
            [
                'label' => 'Family Updates',
                'page' => 'family-updates',
                'icon' => 'user-check',
                'permissions' => ['update_family'],
            ],
            [
                'label' => 'Emergency Alerts',
                'page' => 'emergency-alerts',
                'icon' => 'alert-triangle',
                'permissions' => ['send_emergency_alerts'],
            ],
        ]
    ],

    'system' => [
        'label' => 'System Management',
        'icon' => 'settings',
        'priority' => 7,
        'permissions' => ['manage_system'],
        'children' => [
            [
                'label' => 'User Management',
                'page' => 'users',
                'icon' => 'users',
                'permissions' => ['manage_users'],
            ],
            [
                'label' => 'Device Configuration',
                'page' => 'device-config',
                'icon' => 'settings',
                'permissions' => ['configure_devices'],
            ],
            [
                'label' => 'System Health',
                'page' => 'system-health',
                'icon' => 'activity',
                'permissions' => ['view_system_health'],
            ],
            [
                'label' => 'Backup & Recovery',
                'page' => 'backup',
                'icon' => 'cloud',
                'permissions' => ['manage_backup'],
            ],
            [
                'label' => 'Audit Logs',
                'page' => 'audit-logs',
                'icon' => 'audit',
                'permissions' => ['view_audit_logs'],
            ],
        ]
    ],

    'help' => [
        'label' => 'Help & Support',
        'icon' => 'help-circle',
        'priority' => 8,
        'permissions' => ['view_help'],
        'children' => [
            [
                'label' => 'User Manual',
                'page' => 'manual',
                'icon' => 'book-open',
                'permissions' => ['view_manual'],
            ],
            [
                'label' => 'Training Resources',
                'page' => 'training',
                'icon' => 'graduation-cap',
                'permissions' => ['view_training'],
            ],
            [
                'label' => 'Technical Support',
                'page' => 'support',
                'icon' => 'headphones',
                'permissions' => ['contact_support'],
            ],
            [
                'label' => 'System Status',
                'page' => 'status',
                'icon' => 'server',
                'permissions' => ['view_status'],
            ],
        ]
    ],
];
