@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Discharge Planning</h1>
            <p class="text-slate-500 mt-1">Coordinate patient transfers and discharge processes</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Start Discharge
            </button>
        </div>
    </div>

    <!-- Discharge Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Pending Discharges</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">5</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Discharged Today</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">3</p>
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
                    <p class="text-sm text-slate-500">Avg LOS</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">4.2d</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-600 font-medium">-0.3d from target</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Readmission Rate</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">8.5%</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Discharge Planning Board -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Discharge Planning Board</h2>
                <div class="flex items-center space-x-2">
                    <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>All Patients</option>
                        <option>Ready for Discharge</option>
                        <option>Planning Phase</option>
                        <option>Medical Clearance</option>
                        <option>Family Coordination</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @php
                    $dischargePlans = [
                        [
                            'patient' => 'Thomas Taylor',
                            'patientId' => 'P012',
                            'bed' => 'ICU-014',
                            'admissionDate' => '2024-11-28',
                            'los' => 7,
                            'status' => 'ready',
                            'dischargeType' => 'Transfer to Med-Surg',
                            'estimatedDischarge' => 'Today, 2:00 PM',
                            'physician' => 'Dr. James Chen',
                            'caseManager' => 'Lisa Anderson',
                            'progress' => 95,
                            'tasks' => [
                                ['task' => 'Medical clearance', 'status' => 'completed'],
                                ['task' => 'Family notification', 'status' => 'completed'],
                                ['task' => 'Bed arrangement', 'status' => 'completed'],
                                ['task' => 'Transport arranged', 'status' => 'in-progress'],
                                ['task' => 'Documentation complete', 'status' => 'pending']
                            ]
                        ],
                        [
                            'patient' => 'Jennifer White',
                            'patientId' => 'P011',
                            'bed' => 'ICU-016',
                            'admissionDate' => '2024-11-30',
                            'los' => 5,
                            'status' => 'planning',
                            'dischargeType' => 'Home with Services',
                            'estimatedDischarge' => 'Tomorrow, 10:00 AM',
                            'physician' => 'Dr. Sarah Miller',
                            'caseManager' => 'Mark Thompson',
                            'progress' => 70,
                            'tasks' => [
                                ['task' => 'Medical clearance', 'status' => 'completed'],
                                ['task' => 'Family meeting', 'status' => 'completed'],
                                ['task' => 'Home health arranged', 'status' => 'in-progress'],
                                ['task' => 'Equipment ordered', 'status' => 'pending'],
                                ['task' => 'Medication reconciliation', 'status' => 'pending']
                            ]
                        ],
                        [
                            'patient' => 'Richard Lee',
                            'patientId' => 'P010',
                            'bed' => 'ICU-015',
                            'admissionDate' => '2024-12-01',
                            'los' => 4,
                            'status' => 'medical-clearance',
                            'dischargeType' => 'Rehab Facility',
                            'estimatedDischarge' => 'Tomorrow, 3:00 PM',
                            'physician' => 'Dr. Michael Brown',
                            'caseManager' => 'Jennifer Davis',
                            'progress' => 45,
                            'tasks' => [
                                ['task' => 'Stable vitals 24h', 'status' => 'in-progress'],
                                ['task' => 'Lab results normal', 'status' => 'pending'],
                                ['task' => 'Rehab facility acceptance', 'status' => 'completed'],
                                ['task' => 'Insurance approval', 'status' => 'pending'],
                                ['task' => 'Family education', 'status' => 'pending']
                            ]
                        ],
                        [
                            'patient' => 'David Brown',
                            'patientId' => 'P007',
                            'bed' => 'ICU-007',
                            'admissionDate' => '2024-11-25',
                            'los' => 10,
                            'status' => 'family-coordination',
                            'dischargeType' => 'Skilled Nursing',
                            'estimatedDischarge' => 'Dec 5, 11:00 AM',
                            'physician' => 'Dr. Emily Wilson',
                            'caseManager' => 'Robert Martinez',
                            'progress' => 60,
                            'tasks' => [
                                ['task' => 'Medical clearance', 'status' => 'completed'],
                                ['task' => 'Family contacted', 'status' => 'completed'],
                                ['task' => 'SNF selection', 'status' => 'in-progress'],
                                ['task' => 'Financial counseling', 'status' => 'pending'],
                                ['task' => 'Transport arranged', 'status' => 'pending']
                            ]
                        ],
                        [
                            'patient' => 'Lisa Anderson',
                            'patientId' => 'P008',
                            'bed' => 'ICU-008',
                            'admissionDate' => '2024-12-02',
                            'los' => 3,
                            'status' => 'planning',
                            'dischargeType' => 'Home',
                            'estimatedDischarge' => 'Dec 6, 1:00 PM',
                            'physician' => 'Dr. David Johnson',
                            'caseManager' => 'Susan White',
                            'progress' => 30,
                            'tasks' => [
                                ['task' => 'Medical assessment', 'status' => 'in-progress'],
                                ['task' => 'Family meeting scheduled', 'status' => 'pending'],
                                ['task' => 'Home safety assessment', 'status' => 'pending'],
                                ['task' => 'Medication list prepared', 'status' => 'pending'],
                                ['task' => 'Follow-up appointments', 'status' => 'pending']
                            ]
                        ]
                    ];
                @endphp

                @foreach($dischargePlans as $plan)
                    <div class="border-2 rounded-xl overflow-hidden
                        @if($plan['status'] == 'ready') border-emerald-200
                        @elseif($plan['status'] == 'planning') border-blue-200
                        @elseif($plan['status'] == 'medical-clearance') border-amber-200
                        @else border-purple-200 @endif">
                        <!-- Header -->
                        <div class="p-4 border-b
                            @if($plan['status'] == 'ready') border-emerald-200 bg-emerald-50
                            @elseif($plan['status'] == 'planning') border-blue-200 bg-blue-50
                            @elseif($plan['status'] == 'medical-clearance') border-amber-200 bg-amber-50
                            @else border-purple-200 bg-purple-50 @endif">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold text-slate-900">{{ $plan['patient'] }}</h3>
                                    <div class="text-sm text-slate-600 mt-1">
                                        {{ $plan['patientId'] }} • {{ $plan['bed'] }} • LOS: {{ $plan['los'] }} days
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($plan['status'] == 'ready') bg-emerald-100 text-emerald-800
                                        @elseif($plan['status'] == 'planning') bg-blue-100 text-blue-800
                                        @elseif($plan['status'] == 'medical-clearance') bg-amber-100 text-amber-800
                                        @else bg-purple-100 text-purple-800 @endif">
                                        @if($plan['status'] == 'ready') Ready for Discharge
                                        @elseif($plan['status'] == 'planning') Planning Phase
                                        @elseif($plan['status'] == 'medical-clearance') Medical Clearance
                                        @else Family Coordination @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Discharge Info -->
                        <div class="p-4 space-y-3">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-500">Discharge Type:</span>
                                    <span class="ml-2 text-slate-900">{{ $plan['dischargeType'] }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Est. Discharge:</span>
                                    <span class="ml-2 text-slate-900">{{ $plan['estimatedDischarge'] }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Physician:</span>
                                    <span class="ml-2 text-slate-900">{{ $plan['physician'] }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-500">Case Manager:</span>
                                    <span class="ml-2 text-slate-900">{{ $plan['caseManager'] }}</span>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm text-slate-600">Discharge Progress</span>
                                    <span class="text-sm text-slate-600">{{ $plan['progress'] }}%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-emerald-500 h-2 rounded-full transition-all duration-300" style="width: {{ $plan['progress'] }}%"></div>
                                </div>
                            </div>

                            <!-- Task Checklist -->
                            <div>
                                <h4 class="text-sm font-medium text-slate-900 mb-2">Key Tasks</h4>
                                <div class="space-y-1">
                                    @foreach($plan['tasks'] as $task)
                                        <div class="flex items-center space-x-2 text-sm">
                                            <div class="w-4 h-4 rounded border-2
                                                @if($task['status'] == 'completed') border-emerald-500 bg-emerald-500
                                                @elseif($task['status'] == 'in-progress') border-amber-500 bg-amber-500
                                                @else border-slate-300 @endif flex items-center justify-center">
                                                @if($task['status'] == 'completed')
                                                    <svg class="w-2 h-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                @elseif($task['status'] == 'in-progress')
                                                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                                @endif
                                            </div>
                                            <span class="text-slate-700
                                                @if($task['status'] == 'completed') line-through text-slate-400
                                                @elseif($task['status'] == 'in-progress') font-medium
                                                @endif">{{ $task['task'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="p-4 border-t border-slate-200 bg-slate-50">
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-slate-500">
                                    Admitted: {{ $plan['admissionDate'] }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="px-3 py-1 text-sm bg-white border border-slate-300 rounded hover:bg-slate-50">
                                        Update Plan
                                    </button>
                                    @if($plan['status'] == 'ready')
                                        <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded hover:bg-emerald-700">
                                            Process Discharge
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Discharge Checklist -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Discharge Readiness Checklist</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-medium text-slate-900 mb-4">Medical Requirements</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Physician clearance obtained</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Vital signs stable 24+ hours</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Lab results within normal limits</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Pain controlled with oral meds</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">No active infections</span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-medium text-slate-900 mb-4">Logistical Requirements</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Family notified and in agreement</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Transportation arranged</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Receiving facility confirmed</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Insurance authorization obtained</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Home health services scheduled</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-slate-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-medium text-slate-900 mb-4">Documentation</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Discharge summary completed</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Medication reconciliation done</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Patient education provided</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Follow-up appointments scheduled</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-medium text-slate-900 mb-4">Patient Readiness</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Patient able to ambulate</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Patient understands instructions</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Home safety assessed</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Equipment needs met</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Discharges -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Recent Discharges</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">LOS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Discharge Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Destination</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nurse</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $recentDischarges = [
                            [
                                'time' => '11:30 AM',
                                'patient' => 'Michael Davis',
                                'patientId' => 'P009',
                                'los' => 6,
                                'type' => 'Transfer',
                                'destination' => 'Med-Surg Floor',
                                'nurse' => 'Sarah Johnson'
                            ],
                            [
                                'time' => '09:15 AM',
                                'patient' => 'Patricia Miller',
                                'patientId' => 'P010',
                                'los' => 4,
                                'type' => 'Home',
                                'destination' => 'Home with Home Health',
                                'nurse' => 'Mike Wilson'
                            ],
                            [
                                'time' => '07:45 AM',
                                'patient' => 'James Wilson',
                                'patientId' => 'P005',
                                'los' => 8,
                                'type' => 'Rehab',
                                'destination' => 'Rehab Facility',
                                'nurse' => 'Emily Davis'
                            ]
                        ];
                    @endphp

                    @foreach($recentDischarges as $discharge)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $discharge['time'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900">{{ $discharge['patient'] }}</div>
                                <div class="text-sm text-slate-500">{{ $discharge['patientId'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $discharge['los'] }} days
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $discharge['type'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $discharge['destination'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $discharge['nurse'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
