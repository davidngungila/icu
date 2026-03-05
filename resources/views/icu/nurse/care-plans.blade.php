@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Care Plans</h1>
            <p class="text-slate-500 mt-1">Manage and track patient care plans and interventions</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Care Plan
            </button>
        </div>
    </div>

    <!-- Care Plan Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Active Plans</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">12</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Due Today</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">8</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Completed</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">24</p>
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
                    <p class="text-sm text-slate-500">Overdue</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">3</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Care Plans -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Active Care Plans</h2>
                <div class="flex items-center space-x-2">
                    <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>All Patients</option>
                        <option>John Smith</option>
                        <option>Maria Garcia</option>
                        <option>Robert Johnson</option>
                        <option>Susan Chen</option>
                    </select>
                    <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>All Status</option>
                        <option>On Track</option>
                        <option>Needs Attention</option>
                        <option>Critical</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="divide-y divide-slate-200">
            @php
                $carePlans = [
                    [
                        'id' => 'CP001',
                        'patient' => 'Maria Garcia',
                        'patientId' => 'P002',
                        'bed' => 'ICU-002',
                        'diagnosis' => 'Respiratory Failure',
                        'primaryGoal' => 'Improve oxygenation and respiratory function',
                        'status' => 'critical',
                        'progress' => 45,
                        'lastUpdated' => '2 hours ago',
                        'nextReview' => 'Today, 2:00 PM',
                        'interventions' => [
                            ['task' => 'Ventilator weaning protocol', 'frequency' => 'Q2H', 'completed' => 8, 'total' => 12],
                            ['task' => 'Chest physiotherapy', 'frequency' => 'Q4H', 'completed' => 3, 'total' => 6],
                            ['task' => 'ABG monitoring', 'frequency' => 'Q6H', 'completed' => 2, 'total' => 4]
                        ],
                        'assignedNurse' => 'Sarah Johnson'
                    ],
                    [
                        'id' => 'CP002',
                        'patient' => 'John Smith',
                        'patientId' => 'P001',
                        'bed' => 'ICU-001',
                        'diagnosis' => 'Post-operative CABG',
                        'primaryGoal' => 'Promote cardiac recovery and prevent complications',
                        'status' => 'on-track',
                        'progress' => 75,
                        'lastUpdated' => '1 hour ago',
                        'nextReview' => 'Today, 4:00 PM',
                        'interventions' => [
                            ['task' => 'Wound assessment', 'frequency' => 'Q8H', 'completed' => 2, 'total' => 3],
                            ['task' => 'Cardiac monitoring', 'frequency' => 'Continuous', 'completed' => 24, 'total' => 24],
                            ['task' => 'Mobilization exercises', 'frequency' => 'Q12H', 'completed' => 1, 'total' => 2]
                        ],
                        'assignedNurse' => 'Mike Wilson'
                    ],
                    [
                        'id' => 'CP003',
                        'patient' => 'Robert Johnson',
                        'patientId' => 'P003',
                        'bed' => 'ICU-003',
                        'diagnosis' => 'Sepsis Management',
                        'primaryGoal' => 'Control infection and maintain hemodynamic stability',
                        'status' => 'needs-attention',
                        'progress' => 60,
                        'lastUpdated' => '30 mins ago',
                        'nextReview' => 'Today, 3:00 PM',
                        'interventions' => [
                            ['task' => 'Antibiotic administration', 'frequency' => 'Q8H', 'completed' => 2, 'total' => 3],
                            ['task' => 'Fluid balance monitoring', 'frequency' => 'Q1H', 'completed' => 18, 'total' => 24],
                            ['task' => 'Vital signs assessment', 'frequency' => 'Q1H', 'completed' => 20, 'total' => 24]
                        ],
                        'assignedNurse' => 'Emily Davis'
                    ],
                    [
                        'id' => 'CP004',
                        'patient' => 'Susan Chen',
                        'patientId' => 'P004',
                        'bed' => 'ICU-004',
                        'diagnosis' => 'Diabetic Ketoacidosis',
                        'primaryGoal' => 'Normalize blood glucose and prevent complications',
                        'status' => 'on-track',
                        'progress' => 85,
                        'lastUpdated' => '3 hours ago',
                        'nextReview' => 'Today, 5:00 PM',
                        'interventions' => [
                            ['task' => 'Blood glucose monitoring', 'frequency' => 'Q1H', 'completed' => 22, 'total' => 24],
                            ['task' => 'Insulin infusion management', 'frequency' => 'Continuous', 'completed' => 24, 'total' => 24],
                            ['task' => 'Electrolyte replacement', 'frequency' => 'Q6H', 'completed' => 3, 'total' => 4]
                        ],
                        'assignedNurse' => 'David Brown'
                    ]
                ];
            @endphp

            @foreach($carePlans as $plan)
                <div class="p-6 hover:bg-slate-50 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="mt-1">
                                <div class="w-3 h-3 rounded-full
                                    @if($plan['status'] == 'critical') bg-red-500
                                    @elseif($plan['status'] == 'needs-attention') bg-amber-500
                                    @else bg-emerald-500 @endif"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="text-sm font-medium text-slate-900">{{ $plan['id'] }}</span>
                                    <h3 class="font-semibold text-slate-900">{{ $plan['patient'] }}</h3>
                                    <span class="text-sm text-slate-500">{{ $plan['patientId'] }}</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($plan['status'] == 'critical') bg-red-100 text-red-800
                                        @elseif($plan['status'] == 'needs-attention') bg-amber-100 text-amber-800
                                        @else bg-emerald-100 text-emerald-800 @endif">
                                        @if($plan['status'] == 'critical') Critical
                                        @elseif($plan['status'] == 'needs-attention') Needs Attention
                                        @else On Track @endif
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-slate-500">Diagnosis</p>
                                        <p class="text-sm text-slate-900">{{ $plan['diagnosis'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Primary Goal</p>
                                        <p class="text-sm text-slate-900">{{ $plan['primaryGoal'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Assigned Nurse</p>
                                        <p class="text-sm text-slate-900">{{ $plan['assignedNurse'] }}</p>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm text-slate-600">Overall Progress</span>
                                        <span class="text-sm text-slate-600">{{ $plan['progress'] }}% Complete</span>
                                    </div>
                                    <div class="w-full bg-slate-200 rounded-full h-2">
                                        <div class="bg-emerald-500 h-2 rounded-full transition-all duration-300" style="width: {{ $plan['progress'] }}%"></div>
                                    </div>
                                </div>

                                <!-- Interventions -->
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-slate-900 mb-2">Key Interventions</h4>
                                    <div class="space-y-2">
                                        @foreach($plan['interventions'] as $intervention)
                                            <div class="flex items-center justify-between p-2 bg-slate-50 rounded">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-6 h-6 rounded-full border-2
                                                        @if($intervention['completed'] == $intervention['total']) border-emerald-500 bg-emerald-500
                                                        @else border-slate-300 @endif flex items-center justify-center">
                                                        @if($intervention['completed'] == $intervention['total'])
                                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="text-sm text-slate-900">{{ $intervention['task'] }}</p>
                                                        <p class="text-xs text-slate-500">{{ $intervention['frequency'] }}</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <span class="text-sm font-medium text-slate-900">{{ $intervention['completed'] }}/{{ $intervention['total'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 text-sm text-slate-500">
                                    <span>Last updated: {{ $plan['lastUpdated'] }}</span>
                                    <span>Next review: {{ $plan['nextReview'] }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2 ml-4">
                            <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                                Update Progress
                            </button>
                            <button class="px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Create New Care Plan -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Create New Care Plan</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Select Patient</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Choose patient...</option>
                        <option>John Smith (P001) - ICU-001</option>
                        <option>Maria Garcia (P002) - ICU-002</option>
                        <option>Robert Johnson (P003) - ICU-003</option>
                        <option>Susan Chen (P004) - ICU-004</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Primary Diagnosis</label>
                    <input type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Enter primary diagnosis">
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Primary Goal</label>
                <textarea rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="What is the primary goal of this care plan?"></textarea>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Nursing Diagnoses</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Impaired gas exchange</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Ineffective airway clearance</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Decreased cardiac output</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Fluid volume deficit</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Risk for infection</span>
                    </label>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Interventions</label>
                <div id="interventions" class="space-y-2">
                    <div class="flex items-center space-x-2 p-2 border border-slate-200 rounded">
                        <input type="text" placeholder="Intervention description" class="flex-1 px-3 py-2 border border-slate-300 rounded focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <select class="px-3 py-2 border border-slate-300 rounded focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option>Q1H</option>
                            <option>Q2H</option>
                            <option>Q4H</option>
                            <option>Q6H</option>
                            <option>Q8H</option>
                            <option>Q12H</option>
                            <option>Continuous</option>
                            <option>PRN</option>
                        </select>
                        <button class="px-3 py-2 text-red-600 hover:bg-red-50 rounded">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <button class="mt-2 px-4 py-2 text-emerald-600 border border-emerald-600 rounded-lg hover:bg-emerald-50 transition-colors">
                    + Add Intervention
                </button>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Expected Outcomes</label>
                <textarea rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="What are the expected outcomes of this care plan?"></textarea>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Review Frequency</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Daily</option>
                        <option>Every 48 hours</option>
                        <option>Weekly</option>
                        <option>As needed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Assigned Nurse</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Sarah Johnson</option>
                        <option>Mike Wilson</option>
                        <option>Emily Davis</option>
                        <option>David Brown</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3">
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Save as Draft
                </button>
                <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                    Create Care Plan
                </button>
            </div>
        </div>
    </div>

    <!-- Care Plan Templates -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Care Plan Templates</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $templates = [
                        [
                            'name' => 'Sepsis Management',
                            'description' => 'Comprehensive care plan for sepsis patients',
                            'diagnoses' => ['Infection', 'Fluid imbalance', 'Tissue perfusion alteration'],
                            'interventions' => 8,
                            'used' => 15
                        ],
                        [
                            'name' => 'Post-Operative Cardiac',
                            'description' => 'Standard care for post-cardiac surgery patients',
                            'diagnoses' => ['Pain', 'Decreased cardiac output', 'Risk for infection'],
                            'interventions' => 12,
                            'used' => 23
                        ],
                        [
                            'name' => 'Respiratory Failure',
                            'description' => 'Management of patients with respiratory compromise',
                            'diagnoses' => ['Impaired gas exchange', 'Ineffective airway clearance'],
                            'interventions' => 10,
                            'used' => 18
                        ],
                        [
                            'name' => 'Neurological Care',
                            'description' => 'Care plan for stroke and head injury patients',
                            'diagnoses' => ['Impaired cognition', 'Mobility impairment'],
                            'interventions' => 9,
                            'used' => 12
                        ],
                        [
                            'name' => 'Diabetic Management',
                            'description' => 'Comprehensive diabetes care in ICU',
                            'diagnoses' => ['Fluid imbalance', 'Risk for unstable glucose'],
                            'interventions' => 7,
                            'used' => 20
                        ],
                        [
                            'name' => 'Trauma Care',
                            'description' => 'Multi-trauma patient management',
                            'diagnoses' => ['Pain', 'Risk for infection', 'Mobility impairment'],
                            'interventions' => 15,
                            'used' => 8
                        ]
                    ];
                @endphp

                @foreach($templates as $template)
                    <div class="border border-slate-200 rounded-lg p-4 hover:border-emerald-300 transition-colors cursor-pointer">
                        <h4 class="font-medium text-slate-900 mb-2">{{ $template['name'] }}</h4>
                        <p class="text-sm text-slate-600 mb-3">{{ $template['description'] }}</p>
                        <div class="space-y-1 mb-3">
                            @foreach($template['diagnoses'] as $diagnosis)
                                <div class="text-xs text-slate-500">• {{ $diagnosis }}</div>
                            @endforeach
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">{{ $template['interventions'] }} interventions</span>
                            <span class="text-slate-500">Used {{ $template['used'] }} times</span>
                        </div>
                        <button class="mt-3 w-full px-3 py-1 text-emerald-600 border border-emerald-600 rounded hover:bg-emerald-50 transition-colors text-sm">
                            Use Template
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
