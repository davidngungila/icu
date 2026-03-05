@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Compliance Reports</h1>
            <p class="text-slate-500 mt-1">Regulatory compliance and quality assurance reports</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Generate Report
            </button>
        </div>
    </div>

    <!-- Advanced Compliance Controls -->
    <div class="bg-white rounded-xl border border-slate-200/80 p-4">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Report Type:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Compliance Areas</option>
                    <option>Clinical Documentation</option>
                    <option>Medication Safety</option>
                    <option>Infection Control</option>
                    <option>Patient Safety</option>
                    <option>Staff Competency</option>
                    <option>Regulatory Compliance</option>
                    <option>Quality Metrics</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Period:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>Last 24 Hours</option>
                    <option>This Week</option>
                    <option>This Month</option>
                    <option>This Quarter</option>
                    <option>This Year</option>
                    <option>Custom Range</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Status:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Status</option>
                    <option>Compliant</option>
                    <option>Non-Compliant</option>
                    <option>Pending Review</option>
                    <option>Requires Action</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Risk Level:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Risk Levels</option>
                    <option>Critical</option>
                    <option>High</option>
                    <option>Medium</option>
                    <option>Low</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Generate Report
                </button>
                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Schedule Audit
                </button>
            </div>
        </div>
    </div>

    <!-- Compliance Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Overall Compliance</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">92.3%</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600 font-medium">+2.1% vs last month</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Critical Findings</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">3</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-amber-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span class="text-amber-600 font-medium">Requires action</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Audits Completed</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">24</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600 font-medium">On schedule</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Corrective Actions</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">8</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-blue-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span class="text-blue-600 font-medium">In progress</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-1.756.426-1.756 2.924 0 3.35a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 00-2.573-1.066c-1.543-.94-3.31.826-2.37-2.37a1.724 1.724 0 00-2.572-1.065c-1.756-.426-1.756-2.924 0-3.35z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Compliance Analytics -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h3 class="text-lg font-semibold text-slate-900">AI-Powered Compliance Analytics</h3>
            <p class="text-sm text-slate-500 mt-1">Machine learning insights and predictive compliance monitoring</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Compliance Risk Assessment -->
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-4">Compliance Risk Assessment</h4>
                    <div class="space-y-3">
                        <div class="p-3 bg-red-50 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-red-800">High Risk Areas</span>
                                <span class="text-sm text-red-600">Immediate Action Required</span>
                            </div>
                            <div class="text-sm text-red-700">
                                <ul class="space-y-1">
                                    <li>• Medication double-check process (78% compliance)</li>
                                    <li>• Hand hygiene documentation (82% compliance)</li>
                                    <li>• Fall risk assessment (85% compliance)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-3 bg-amber-50 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-amber-800">Medium Risk Areas</span>
                                <span class="text-sm text-amber-600">Monitor Closely</span>
                            </div>
                            <div class="text-sm text-amber-700">
                                <ul class="space-y-1">
                                    <li>• Care plan documentation (88% compliance)</li>
                                    <li>• Vital sign frequency (90% compliance)</li>
                                    <li>• Family communication logs (87% compliance)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-3 bg-emerald-50 rounded-lg">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-emerald-800">Low Risk Areas</span>
                                <span class="text-sm text-emerald-600">Maintain Current Standards</span>
                            </div>
                            <div class="text-sm text-emerald-700">
                                <ul class="space-y-1">
                                    <li>• Patient identification (98% compliance)</li>
                                    <li>• Code blue response time (96% compliance)</li>
                                    <li>• Equipment maintenance (95% compliance)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Predictive Compliance Insights -->
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-4">Predictive Insights</h4>
                    <div class="space-y-3">
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Compliance Trend Forecast</span>
                                <span class="text-sm text-amber-600">Next 30 Days</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                <p class="mb-2">Overall compliance expected to <strong class="text-amber-600">decrease by 2.3%</strong> due to:</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• Seasonal staffing changes</li>
                                    <li>• New medication protocols</li>
                                    <li>• Upcoming regulatory changes</li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Automated Monitoring Alerts</span>
                                <span class="text-sm text-emerald-600">AI-Enabled</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                <p class="mb-2">System will automatically flag:</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• Documentation delays > 2 hours</li>
                                    <li>• Missing critical care elements</li>
                                    <li>• Compliance score drops below 85%</li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Improvement Recommendations</span>
                                <span class="text-sm text-blue-600">AI-Generated</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                <p class="mb-2">Top priority actions:</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• Implement barcode medication scanning</li>
                                    <li>• Enhance hand hygiene monitoring</li>
                                    <li>• Standardize care plan templates</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Regulatory Compliance Dashboard -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h3 class="text-lg font-semibold text-slate-900">Regulatory Compliance Dashboard</h3>
            <p class="text-sm text-slate-500 mt-1">Joint Commission, CMS, and state regulatory compliance tracking</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $regulatoryMetrics = [
                        [
                            'standard' => 'Joint Commission - Patient Safety',
                            'compliance' => 94,
                            'status' => 'compliant',
                            'lastSurvey' => '2024-03-15',
                            'nextSurvey' => '2025-03-15'
                        ],
                        [
                            'standard' => 'CMS - Quality Reporting',
                            'compliance' => 89,
                            'status' => 'warning',
                            'lastSurvey' => '2024-01-20',
                            'nextSurvey' => '2025-01-20'
                        ],
                        [
                            'standard' => 'State - Infection Control',
                            'compliance' => 96,
                            'status' => 'compliant',
                            'lastSurvey' => '2024-02-10',
                            'nextSurvey' => '2025-02-10'
                        ],
                        [
                            'standard' => 'HIPAA - Privacy & Security',
                            'compliance' => 98,
                            'status' => 'compliant',
                            'lastSurvey' => '2024-01-05',
                            'nextSurvey' => '2025-01-05'
                        ],
                        [
                            'standard' => 'OSHA - Workplace Safety',
                            'compliance' => 92,
                            'status' => 'warning',
                            'lastSurvey' => '2024-02-20',
                            'nextSurvey' => '2025-02-20'
                        ],
                        [
                            'standard' => 'CMS - EMR Meaningful Use',
                            'compliance' => 87,
                            'status' => 'non-compliant',
                            'lastSurvey' => '2024-03-01',
                            'nextSurvey' => '2025-03-01'
                        ]
                    ];
                @endphp

                @foreach($regulatoryMetrics as $metric)
                    <div class="border border-slate-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h5 class="text-sm font-medium text-slate-900">{{ $metric['standard'] }}</h5>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($metric['status'] == 'compliant') bg-emerald-100 text-emerald-800
                                @elseif($metric['status'] == 'warning') bg-amber-100 text-amber-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($metric['status']) }}
                            </span>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Compliance Score</span>
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg font-bold
                                        @if($metric['compliance'] >= 95) text-emerald-600
                                        @elseif($metric['compliance'] >= 85) text-amber-600
                                        @else text-red-600 @endif">{{ $metric['compliance'] }}%</span>
                                    <div class="w-16 bg-slate-200 rounded-full h-2">
                                        <div class="bg-emerald-500 h-2 rounded-full transition-all duration-300" style="width: {{ $metric['compliance'] }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Last Survey</span>
                                <span class="text-sm text-slate-900">{{ $metric['lastSurvey'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Next Survey</span>
                                <span class="text-sm text-slate-900">{{ $metric['nextSurvey'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Compliance Areas</h2>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                        Run Audit
                    </button>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $complianceAreas = [
                        [
                            'area' => 'Clinical Documentation',
                            'score' => 94,
                            'status' => 'compliant',
                            'lastAudit' => '2024-11-28',
                            'findings' => 2,
                            'critical' => 0,
                            'items' => [
                                ['item' => 'Progress Notes', 'compliance' => 96, 'status' => 'compliant'],
                                ['item' => 'Medication Records', 'compliance' => 92, 'status' => 'compliant'],
                                ['item' => 'Vital Signs Documentation', 'compliance' => 98, 'status' => 'compliant'],
                                ['item' => 'Care Plan Updates', 'compliance' => 89, 'status' => 'warning']
                            ]
                        ],
                        [
                            'area' => 'Medication Safety',
                            'score' => 88,
                            'status' => 'warning',
                            'lastAudit' => '2024-11-25',
                            'findings' => 5,
                            'critical' => 1,
                            'items' => [
                                ['item' => 'Five Rights Verification', 'compliance' => 92, 'status' => 'compliant'],
                                ['item' => 'High Alert Medications', 'compliance' => 85, 'status' => 'warning'],
                                ['item' => 'Double Check Process', 'compliance' => 78, 'status' => 'non-compliant'],
                                ['item' => 'Medication Reconciliation', 'compliance' => 95, 'status' => 'compliant']
                            ]
                        ],
                        [
                            'area' => 'Infection Control',
                            'score' => 91,
                            'status' => 'compliant',
                            'lastAudit' => '2024-11-30',
                            'findings' => 3,
                            'critical' => 0,
                            'items' => [
                                ['item' => 'Hand Hygiene', 'compliance' => 94, 'status' => 'compliant'],
                                ['item' => 'PPE Usage', 'compliance' => 89, 'status' => 'warning'],
                                ['item' => 'Isolation Precautions', 'compliance' => 92, 'status' => 'compliant'],
                                ['item' => 'Environmental Cleaning', 'compliance' => 88, 'status' => 'warning']
                            ]
                        ],
                        [
                            'area' => 'Patient Safety',
                            'score' => 96,
                            'status' => 'compliant',
                            'lastAudit' => '2024-11-27',
                            'findings' => 1,
                            'critical' => 0,
                            'items' => [
                                ['item' => 'Fall Prevention', 'compliance' => 98, 'status' => 'compliant'],
                                ['item' => 'Restraint Documentation', 'compliance' => 94, 'status' => 'compliant'],
                                ['item' => 'Patient Identification', 'compliance' => 99, 'status' => 'compliant'],
                                ['item' => 'Bed Alarm Usage', 'compliance' => 93, 'status' => 'compliant']
                            ]
                        ]
                    ];
                @endphp

                @foreach($complianceAreas as $area)
                    <div class="border border-slate-200 rounded-lg p-4
                        @if($area['status'] == 'non-compliant') border-red-200
                        @elseif($area['status'] == 'warning') border-amber-200
                        @else border-emerald-200 @endif">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-slate-900">{{ $area['area'] }}</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-2xl font-bold
                                    @if($area['score'] >= 95) text-emerald-600
                                    @elseif($area['score'] >= 85) text-amber-600
                                    @else text-red-600 @endif">{{ $area['score'] }}%</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($area['status'] == 'non-compliant') bg-red-100 text-red-800
                                    @elseif($area['status'] == 'warning') bg-amber-100 text-amber-800
                                    @else bg-emerald-100 text-emerald-800 @endif">
                                    {{ ucfirst($area['status']) }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                            <div>
                                <span class="text-slate-500">Last Audit:</span>
                                <span class="ml-2 text-slate-900">{{ $area['lastAudit'] }}</span>
                            </div>
                            <div>
                                <span class="text-slate-500">Findings:</span>
                                <span class="ml-2 text-slate-900">{{ $area['findings'] }} total
                                    @if($area['critical'] > 0) ({{ $area['critical'] }} critical)@endif</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            @foreach($area['items'] as $item)
                                <div class="flex items-center justify-between p-2 bg-slate-50 rounded">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 rounded-full
                                            @if($item['status'] == 'non-compliant') bg-red-500
                                            @elseif($item['status'] == 'warning') bg-amber-500
                                            @else bg-emerald-500 @endif"></div>
                                        <span class="text-sm text-slate-900">{{ $item['item'] }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm font-medium text-slate-900">{{ $item['compliance'] }}%</span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                            @if($item['status'] == 'non-compliant') bg-red-100 text-red-800
                                            @elseif($item['status'] == 'warning') bg-amber-100 text-amber-800
                                            @else bg-emerald-100 text-emerald-800 @endif">
                                            {{ ucfirst($item['status']) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-200">
                            <button class="w-full px-3 py-2 text-emerald-600 border border-emerald-600 rounded hover:bg-emerald-50 transition-colors text-sm">
                                View Detailed Report
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Audit Findings -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Recent Audit Findings</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Area</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Finding</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Risk Level</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Assigned To</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Due Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $auditFindings = [
                            [
                                'date' => '2024-12-02',
                                'area' => 'Medication Safety',
                                'finding' => 'Double check process not consistently followed for high-alert medications',
                                'riskLevel' => 'high',
                                'status' => 'open',
                                'assignedTo' => 'Sarah Johnson',
                                'dueDate' => '2024-12-09'
                            ],
                            [
                                'date' => '2024-12-01',
                                'area' => 'Infection Control',
                                'finding' => 'Hand hygiene compliance below 90% in night shift',
                                'riskLevel' => 'medium',
                                'status' => 'in-progress',
                                'assignedTo' => 'Mike Wilson',
                                'dueDate' => '2024-12-08'
                            ],
                            [
                                'date' => '2024-11-30',
                                'area' => 'Clinical Documentation',
                                'finding' => 'Care plan updates not completed within 24 hours as required',
                                'riskLevel' => 'medium',
                                'status' => 'resolved',
                                'assignedTo' => 'Emily Davis',
                                'dueDate' => '2024-12-07'
                            ],
                            [
                                'date' => '2024-11-29',
                                'area' => 'Patient Safety',
                                'finding' => 'Bed alarms not consistently activated for high-risk patients',
                                'riskLevel' => 'high',
                                'status' => 'in-progress',
                                'assignedTo' => 'David Brown',
                                'dueDate' => '2024-12-06'
                            ]
                        ];
                    @endphp

                    @foreach($auditFindings as $finding)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $finding['date'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $finding['area'] }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-900 max-w-xs truncate" title="{{ $finding['finding'] }}">
                                {{ $finding['finding'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($finding['riskLevel'] == 'high') bg-red-100 text-red-800
                                    @elseif($finding['riskLevel'] == 'medium') bg-amber-100 text-amber-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($finding['riskLevel']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($finding['status'] == 'open') bg-red-100 text-red-800
                                    @elseif($finding['status'] == 'in-progress') bg-amber-100 text-amber-800
                                    @else bg-emerald-100 text-emerald-800 @endif">
                                    @if($finding['status'] == 'open') Open
                                    @elseif($finding['status'] == 'in-progress') In Progress
                                    @else Resolved @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $finding['assignedTo'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $finding['dueDate'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Corrective Action Plan -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Corrective Action Plan</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @php
                    $actionPlans = [
                        [
                            'finding' => 'Double check process not consistently followed',
                            'action' => 'Implement mandatory double-check verification for all high-alert medications',
                            'responsible' => 'Pharmacy Director',
                            'timeline' => '2 weeks',
                            'status' => 'in-progress',
                            'progress' => 60
                        ],
                        [
                            'finding' => 'Hand hygiene compliance below 90%',
                            'action' => 'Conduct hand hygiene training and increase monitoring frequency',
                            'responsible' => 'Infection Control Nurse',
                            'timeline' => '1 week',
                            'status' => 'not-started',
                            'progress' => 0
                        ],
                        [
                            'finding' => 'Care plan updates delayed',
                            'action' => 'Implement automated care plan review reminders',
                            'responsible' => 'Clinical Nurse Specialist',
                            'timeline' => '3 weeks',
                            'status' => 'in-progress',
                            'progress' => 30
                        ]
                    ];
                @endphp

                @foreach($actionPlans as $plan)
                    <div class="border border-slate-200 rounded-lg p-4">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h4 class="font-medium text-slate-900 mb-1">{{ $plan['action'] }}</h4>
                                <p class="text-sm text-slate-600">Addressing: {{ $plan['finding'] }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($plan['status'] == 'completed') bg-emerald-100 text-emerald-800
                                @elseif($plan['status'] == 'in-progress') bg-amber-100 text-amber-800
                                @else bg-slate-100 text-slate-800 @endif">
                                @if($plan['status'] == 'completed') Completed
                                @elseif($plan['status'] == 'in-progress') In Progress
                                @else Not Started @endif
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3 text-sm">
                            <div>
                                <span class="text-slate-500">Responsible:</span>
                                <span class="ml-2 text-slate-900">{{ $plan['responsible'] }}</span>
                            </div>
                            <div>
                                <span class="text-slate-500">Timeline:</span>
                                <span class="ml-2 text-slate-900">{{ $plan['timeline'] }}</span>
                            </div>
                            <div>
                                <span class="text-slate-500">Progress:</span>
                                <span class="ml-2 text-slate-900">{{ $plan['progress'] }}%</span>
                            </div>
                        </div>

                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full transition-all duration-300" style="width: {{ $plan['progress'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
