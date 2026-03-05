@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Handover Protocol</h1>
            <p class="text-slate-500 mt-1">Standardized shift change and patient handover procedures</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                Start Handover
            </button>
        </div>
    </div>

    <!-- Current Shift Status -->
    <div class="bg-white rounded-xl border border-slate-200/80 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-slate-900">Current Shift Information</h2>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-medium">Day Shift</span>
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">In Progress</span>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <p class="text-sm text-slate-500">Shift Time</p>
                <p class="font-medium text-slate-900">7:00 AM - 7:00 PM</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Charge Nurse</p>
                <p class="font-medium text-slate-900">Sarah Johnson</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Team Size</p>
                <p class="font-medium text-slate-900">4 Nurses, 2 CNAs</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Patient Census</p>
                <p class="font-medium text-slate-900">12 Patients</p>
            </div>
        </div>
    </div>

    <!-- Handover Checklist -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">SBAR Handover Checklist</h2>
            <p class="text-sm text-slate-500 mt-1">Situation, Background, Assessment, Recommendation</p>
        </div>
        <div class="p-6">
            <div class="space-y-6">
                <!-- Situation -->
                <div class="border-l-4 border-blue-500 pl-4">
                    <h3 class="font-medium text-slate-900 mb-3">S - Situation</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Patient name, age, bed number identified</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Current shift and time stated</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Reason for ICU admission communicated</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Code status reviewed</span>
                        </label>
                    </div>
                </div>

                <!-- Background -->
                <div class="border-l-4 border-amber-500 pl-4">
                    <h3 class="font-medium text-slate-900 mb-3">B - Background</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Relevant medical history summarized</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Allergies documented</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Current medications reviewed</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Recent procedures/tests mentioned</span>
                        </label>
                    </div>
                </div>

                <!-- Assessment -->
                <div class="border-l-4 border-emerald-500 pl-4">
                    <h3 class="font-medium text-slate-900 mb-3">A - Assessment</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Current vital signs shared</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Neurological status assessed</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Cardiovascular status evaluated</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Respiratory status reviewed</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Lines, tubes, drains checked</span>
                        </label>
                    </div>
                </div>

                <!-- Recommendation -->
                <div class="border-l-4 border-purple-500 pl-4">
                    <h3 class="font-medium text-slate-900 mb-3">R - Recommendation</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Plan of care clarified</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Pending tasks identified</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Concerns highlighted</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Follow-up needs specified</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-blue-800">Handover Best Practices</p>
                        <p class="text-sm text-blue-700 mt-1">Use the SBAR format for every patient handover. Allow time for questions and clarification. Document handover completion in the patient record.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Handover Queue -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Patient Handover Queue</h2>
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">4 Pending</span>
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-medium">8 Completed</span>
                </div>
            </div>
        </div>
        <div class="divide-y divide-slate-200">
            @php
                $handoverQueue = [
                    [
                        'patient' => 'Maria Garcia',
                        'patientId' => 'P002',
                        'bed' => 'ICU-002',
                        'acuity' => 'critical',
                        'status' => 'pending',
                        'assignedTo' => 'Emily Davis',
                        'handoverType' => 'Complete',
                        'estimatedTime' => '15 mins',
                        'priority' => 'high'
                    ],
                    [
                        'patient' => 'John Smith',
                        'patientId' => 'P001',
                        'bed' => 'ICU-001',
                        'acuity' => 'stable',
                        'status' => 'pending',
                        'assignedTo' => 'David Brown',
                        'handoverType' => 'Brief',
                        'estimatedTime' => '5 mins',
                        'priority' => 'medium'
                    ],
                    [
                        'patient' => 'Robert Johnson',
                        'patientId' => 'P003',
                        'bed' => 'ICU-003',
                        'acuity' => 'stable',
                        'status' => 'in-progress',
                        'assignedTo' => 'Lisa Anderson',
                        'handoverType' => 'Complete',
                        'estimatedTime' => '10 mins',
                        'priority' => 'medium'
                    ],
                    [
                        'patient' => 'Susan Chen',
                        'patientId' => 'P004',
                        'bed' => 'ICU-004',
                        'acuity' => 'warning',
                        'status' => 'completed',
                        'assignedTo' => 'Mark Thompson',
                        'handoverType' => 'Complete',
                        'estimatedTime' => '12 mins',
                        'priority' => 'high'
                    ]
                ];
            @endphp

            @foreach($handoverQueue as $handover)
                <div class="p-6 hover:bg-slate-50 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="mt-1">
                                <div class="w-3 h-3 rounded-full
                                    @if($handover['status'] == 'completed') bg-emerald-500
                                    @elseif($handover['status'] == 'in-progress') bg-amber-500
                                    @else bg-slate-400 @endif"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="font-semibold text-slate-900">{{ $handover['patient'] }}</h3>
                                    <span class="text-sm text-slate-500">{{ $handover['patientId'] }}</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($handover['acuity'] == 'critical') bg-red-100 text-red-800
                                        @elseif($handover['acuity'] == 'warning') bg-amber-100 text-amber-800
                                        @else bg-emerald-100 text-emerald-800 @endif">
                                        {{ ucfirst($handover['acuity']) }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($handover['status'] == 'completed') bg-emerald-100 text-emerald-800
                                        @elseif($handover['status'] == 'in-progress') bg-amber-100 text-amber-800
                                        @else bg-slate-100 text-slate-800 @endif">
                                        @if($handover['status'] == 'completed') Completed
                                        @elseif($handover['status'] == 'in-progress') In Progress
                                        @else Pending @endif
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-slate-500">Bed</p>
                                        <p class="text-sm text-slate-900">{{ $handover['bed'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Assigned To</p>
                                        <p class="text-sm text-slate-900">{{ $handover['assignedTo'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Handover Type</p>
                                        <p class="text-sm text-slate-900">{{ $handover['handoverType'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Estimated Time</p>
                                        <p class="text-sm text-slate-900">{{ $handover['estimatedTime'] }}</p>
                                    </div>
                                </div>

                                @if($handover['status'] == 'in-progress')
                                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-3">
                                        <p class="text-sm text-amber-800">Handover currently in progress with {{ $handover['assignedTo'] }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2 ml-4">
                            @if($handover['status'] == 'pending')
                                <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                                    Start Handover
                                </button>
                            @elseif($handover['status'] == 'in-progress')
                                <button class="px-3 py-1 text-sm bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                                    View Progress
                                </button>
                            @endif
                            <button class="px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                                Patient Details
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Handover Templates -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Handover Templates</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $templates = [
                        [
                            'name' => 'Critical Care Patient',
                            'type' => 'Complete',
                            'duration' => '15-20 mins',
                            'sections' => ['Full SBAR', 'Vitals trends 24h', 'Medication review', 'Family communication', 'Pending labs/tests'],
                            'used' => 45
                        ],
                        [
                            'name' => 'Stable Patient',
                            'type' => 'Brief',
                            'duration' => '5-8 mins',
                            'sections' => ['Brief SBAR', 'Current status', 'Key interventions', 'Follow-up needs'],
                            'used' => 78
                        ],
                        [
                            'name' => 'Post-Operative',
                            'type' => 'Complete',
                            'duration' => '12-15 mins',
                            'sections' => ['Surgery details', 'Anesthesia concerns', 'Pain management', 'Wound care', 'Drain management'],
                            'used' => 32
                        ],
                        [
                            'name' => 'Ventilator Patient',
                            'type' => 'Complete',
                            'duration' => '15-20 mins',
                            'sections' => ['Ventilator settings', 'Weaning progress', 'ABG trends', 'Sedation protocol', 'Extubation plan'],
                            'used' => 28
                        ]
                    ];
                @endphp

                @foreach($templates as $template)
                    <div class="border border-slate-200 rounded-lg p-4 hover:border-emerald-300 transition-colors">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-medium text-slate-900">{{ $template['name'] }}</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($template['type'] == 'Complete') bg-blue-100 text-blue-800
                                @else bg-emerald-100 text-emerald-800 @endif">
                                {{ $template['type'] }}
                            </span>
                        </div>
                        <div class="space-y-2 mb-3">
                            <div class="flex items-center text-sm text-slate-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $template['duration'] }}
                            </div>
                            <div class="text-sm text-slate-600">
                                <span class="font-medium">Used {{ $template['used'] }} times</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm font-medium text-slate-700 mb-1">Key Sections:</p>
                            <div class="flex flex-wrap gap-1">
                                @foreach($template['sections'] as $section)
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-slate-100 text-slate-700">
                                        {{ $section }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <button class="w-full px-3 py-2 text-emerald-600 border border-emerald-600 rounded hover:bg-emerald-50 transition-colors text-sm">
                            Use Template
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Handover Documentation -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Handover Documentation</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="border border-slate-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="font-medium text-slate-900">Shift Change Log</h4>
                        <span class="text-sm text-slate-500">Last 24 hours</span>
                    </div>
                    <div class="space-y-2">
                        @php
                            $handoverLog = [
                                ['time' => '7:00 AM', 'from' => 'Night Shift', 'to' => 'Day Shift', 'nurse' => 'Sarah Johnson', 'patients' => 12],
                                ['time' => '7:00 PM', 'from' => 'Day Shift', 'to' => 'Night Shift', 'nurse' => 'Mike Wilson', 'patients' => 11],
                                ['time' => '7:00 AM', 'from' => 'Night Shift', 'to' => 'Day Shift', 'nurse' => 'Emily Davis', 'patients' => 13]
                            ];
                        @endphp

                        @foreach($handoverLog as $log)
                            <div class="flex items-center justify-between p-2 bg-slate-50 rounded">
                                <div class="flex items-center space-x-4 text-sm">
                                    <span class="font-medium text-slate-900">{{ $log['time'] }}</span>
                                    <span class="text-slate-600">{{ $log['from'] }} → {{ $log['to'] }}</span>
                                    <span class="text-slate-600">{{ $log['nurse'] }}</span>
                                    <span class="text-slate-600">{{ $log['patients'] }} patients</span>
                                </div>
                                <button class="text-emerald-600 hover:text-emerald-700 text-sm">View Details</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border border-slate-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="font-medium text-slate-900">Critical Information Handover</h4>
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">High Priority</span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-3 p-3 bg-red-50 rounded">
                            <div class="w-2 h-2 bg-red-500 rounded-full mt-1.5"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-red-800">Maria Garcia (P002) - ICU-002</p>
                                <p class="text-sm text-red-700">Critical: A-fib with RVR, SpO2 trending down, family notified of condition change</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-3 bg-amber-50 rounded">
                            <div class="w-2 h-2 bg-amber-500 rounded-full mt-1.5"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-amber-800">Robert Johnson (P003) - ICU-003</p>
                                <p class="text-sm text-amber-700">Warning: New onset atrial fibrillation, cardiology consulted, monitor for response</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
