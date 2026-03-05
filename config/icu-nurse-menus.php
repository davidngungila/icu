<?php

return [
    'dashboard' => [
        'label' => 'Dashboard',
        'page' => 'nurse/dashboard',
        'icon' => 'dashboard',
        'priority' => 1,
        'badge' => null,
        'permissions' => ['view_dashboard'],
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
                'page' => 'nurse/patient-vitals',
                'icon' => 'heart',
                'permissions' => ['view_vitals'],
                'badge' => [
                    'type' => 'critical',
                    'count' => 3,
                    'pulse' => true
                ],
                'realtime' => true
            ],
            [
                'label' => 'Medication Administration',
                'page' => 'nurse/medication-admin',
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
                'page' => 'nurse/observations',
                'icon' => 'clipboard',
                'permissions' => ['record_observations'],
            ],
            [
                'label' => 'Alerts Management',
                'page' => 'nurse/alerts',
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
                'page' => 'nurse/device-status',
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
                'page' => 'nurse/shift-notes',
                'icon' => 'clipboard-text',
                'permissions' => ['view_shift_notes'],
            ],
            [
                'label' => 'Bed Management',
                'page' => 'nurse/bed-management',
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
                'page' => 'nurse/live-vitals',
                'icon' => 'activity',
                'permissions' => ['view_live_vitals'],
                'realtime' => true
            ],
            [
                'label' => 'Ventilator Management',
                'page' => 'nurse/ventilators',
                'icon' => 'lungs',
                'permissions' => ['manage_ventilators'],
            ],
            [
                'label' => 'Infusion Pumps',
                'page' => 'nurse/infusion-pumps',
                'icon' => 'droplet',
                'permissions' => ['manage_pumps'],
            ],
            [
                'label' => 'Cardiac Monitors',
                'page' => 'nurse/cardiac-monitors',
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
                'page' => 'nurse/admission-process',
                'icon' => 'user-plus',
                'permissions' => ['manage_admission'],
            ],
            [
                'label' => 'Care Plans',
                'page' => 'nurse/care-plans',
                'icon' => 'file-medical',
                'permissions' => ['manage_care_plans'],
            ],
            [
                'label' => 'Discharge Planning',
                'page' => 'nurse/discharge-planning',
                'icon' => 'user-minus',
                'permissions' => ['manage_discharge'],
            ],
            [
                'label' => 'Handover Protocol',
                'page' => 'nurse/handover-protocol',
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
                'page' => 'nurse/patient-trends',
                'icon' => 'trending-up',
                'permissions' => ['view_trends'],
            ],
            [
                'label' => 'ICU Performance',
                'page' => 'nurse/icu-performance',
                'icon' => 'bar-chart',
                'permissions' => ['view_performance'],
            ],
            [
                'label' => 'Compliance Reports',
                'page' => 'nurse/compliance-reports',
                'icon' => 'shield-check',
                'permissions' => ['view_compliance'],
            ],
            [
                'label' => 'Quality Metrics',
                'page' => 'nurse/quality-metrics',
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
                'page' => 'nurse/team-chat',
                'icon' => 'users',
                'permissions' => ['use_chat'],
                'realtime' => true
            ],
            [
                'label' => 'Consultation Requests',
                'page' => 'nurse/consultations',
                'icon' => 'phone-call',
                'permissions' => ['request_consultation'],
            ],
            [
                'label' => 'Family Updates',
                'page' => 'nurse/family-updates',
                'icon' => 'user-check',
                'permissions' => ['update_family'],
            ],
            [
                'label' => 'Emergency Alerts',
                'page' => 'nurse/emergency-alerts',
                'icon' => 'alert-triangle',
                'permissions' => ['send_emergency_alerts'],
            ],
        ]
    ],

    'help' => [
        'label' => 'Help & Support',
        'icon' => 'help-circle',
        'priority' => 7,
        'permissions' => ['view_help'],
        'children' => [
            [
                'label' => 'User Manual',
                'page' => 'nurse/manual',
                'icon' => 'book-open',
                'permissions' => ['view_manual'],
            ],
            [
                'label' => 'Training Resources',
                'page' => 'nurse/training',
                'icon' => 'graduation-cap',
                'permissions' => ['view_training'],
            ],
            [
                'label' => 'Technical Support',
                'page' => 'nurse/support',
                'icon' => 'headphones',
                'permissions' => ['contact_support'],
            ],
            [
                'label' => 'System Status',
                'page' => 'nurse/status',
                'icon' => 'server',
                'permissions' => ['view_status'],
            ],
        ]
    ],
];
