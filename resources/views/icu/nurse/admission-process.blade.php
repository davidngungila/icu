@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Admission Process</h1>
            <p class="text-slate-500 mt-1">Manage patient admissions and ICU transfers</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Admission
            </button>
        </div>
    </div>

    <!-- Admission Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Today's Admissions</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">3</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-600 font-medium">+1 from yesterday</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Pending Admissions</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">2</p>
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
                    <p class="text-sm text-slate-500">Available Beds</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">4</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Avg Admission Time</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">45m</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-amber-600 font-medium">5m above target</span>
            </div>
        </div>
    </div>

    <!-- Current Admissions in Progress -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Admissions in Progress</h2>
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">2 Active</span>
                </div>
            </div>
        </div>
        <div class="divide-y divide-slate-200">
            @php
                $admissionsInProgress = [
                    [
                        'patient' => 'William Martinez',
                        'patientId' => 'P008',
                        'source' => 'Emergency Department',
                        'priority' => 'high',
                        'bed' => 'ICU-008',
                        'startedAt' => '15 mins ago',
                        'estimatedTime' => '30 mins',
                        'currentStep' => 'Bed Assignment',
                        'progress' => 60,
                        'assignedNurse' => 'Sarah Johnson'
                    ],
                    [
                        'patient' => 'Nancy Thompson',
                        'patientId' => 'P009',
                        'source' => 'Med-Surg Floor',
                        'priority' => 'medium',
                        'bed' => 'ICU-013',
                        'startedAt' => '45 mins ago',
                        'estimatedTime' => '20 mins',
                        'currentStep' => 'Equipment Setup',
                        'progress' => 80,
                        'assignedNurse' => 'Mike Wilson'
                    ]
                ];
            @endphp

            @foreach($admissionsInProgress as $admission)
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="mt-1">
                                <div class="w-3 h-3 rounded-full
                                    @if($admission['priority'] == 'critical') bg-red-500
                                    @elseif($admission['priority'] == 'high') bg-amber-500
                                    @else bg-blue-500 @endif animate-pulse"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="font-semibold text-slate-900">{{ $admission['patient'] }}</h3>
                                    <span class="text-sm text-slate-500">{{ $admission['patientId'] }}</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($admission['priority'] == 'critical') bg-red-100 text-red-800
                                        @elseif($admission['priority'] == 'high') bg-amber-100 text-amber-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($admission['priority']) }} Priority
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-slate-500">Source</p>
                                        <p class="text-sm text-slate-900">{{ $admission['source'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Assigned Bed</p>
                                        <p class="text-sm text-slate-900">{{ $admission['bed'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Assigned Nurse</p>
                                        <p class="text-sm text-slate-900">{{ $admission['assignedNurse'] }}</p>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm text-slate-600">Current Step: {{ $admission['currentStep'] }}</span>
                                        <span class="text-sm text-slate-600">{{ $admission['progress'] }}% Complete</span>
                                    </div>
                                    <div class="w-full bg-slate-200 rounded-full h-2">
                                        <div class="bg-emerald-500 h-2 rounded-full transition-all duration-300" style="width: {{ $admission['progress'] }}%"></div>
                                    </div>
                                </div>

                                <!-- Admission Steps -->
                                <div class="grid grid-cols-1 md:grid-cols-6 gap-2">
                                    <div class="text-center">
                                        <div class="w-8 h-8 mx-auto mb-1 rounded-full bg-emerald-500 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs text-slate-600">Patient Info</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="w-8 h-8 mx-auto mb-1 rounded-full bg-emerald-500 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs text-slate-600">Bed Assignment</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="w-8 h-8 mx-auto mb-1 rounded-full bg-emerald-500 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs text-slate-600">Equipment Setup</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="w-8 h-8 mx-auto mb-1 rounded-full bg-amber-500 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs text-slate-600">Vitals Setup</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="w-8 h-8 mx-auto mb-1 rounded-full bg-slate-300 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs text-slate-600">Documentation</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="w-8 h-8 mx-auto mb-1 rounded-full bg-slate-300 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-xs text-slate-600">Family Brief</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 mt-4 text-sm text-slate-500">
                                    <span>Started: {{ $admission['startedAt'] }}</span>
                                    <span>Est. completion: {{ $admission['estimatedTime'] }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2 ml-4">
                            <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                                View Details
                            </button>
                            <button class="px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                                Update Status
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- New Admission Form -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Start New Admission</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Patient Name</label>
                    <input type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Enter patient name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Patient ID</label>
                    <input type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Enter patient ID">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Admission Source</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Emergency Department</option>
                        <option>Operating Room</option>
                        <option>Medical-Surgical Floor</option>
                        <option>Other Hospital</option>
                        <option>Direct Admission</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Priority Level</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Critical</option>
                        <option>High</option>
                        <option>Medium</option>
                        <option>Low</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Assign Bed</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>ICU-008 - Available</option>
                        <option>ICU-013 - Available</option>
                        <option>ICU-015 - Available</option>
                        <option>ICU-016 - Available</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Assign Nurse</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Sarah Johnson</option>
                        <option>Mike Wilson</option>
                        <option>Emily Davis</option>
                        <option>David Brown</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Admission Reason</label>
                <textarea rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Brief reason for ICU admission..."></textarea>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Special Requirements</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Isolation precautions</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Ventilator support</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Continuous monitoring</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Special equipment</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3">
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                    Start Admission Process
                </button>
            </div>
        </div>
    </div>

    <!-- Recent Admissions -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Recent Admissions</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Source</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Bed</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nurse</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $recentAdmissions = [
                            [
                                'time' => '06:45 AM',
                                'patient' => 'Richard Lee',
                                'patientId' => 'P010',
                                'source' => 'Operating Room',
                                'bed' => 'ICU-015',
                                'nurse' => 'Sarah Johnson',
                                'duration' => '35 mins',
                                'status' => 'completed'
                            ],
                            [
                                'time' => '05:30 AM',
                                'patient' => 'Jennifer White',
                                'patientId' => 'P011',
                                'source' => 'Emergency Department',
                                'bed' => 'ICU-016',
                                'nurse' => 'Mike Wilson',
                                'duration' => '42 mins',
                                'status' => 'completed'
                            ],
                            [
                                'time' => '04:15 AM',
                                'patient' => 'Thomas Taylor',
                                'patientId' => 'P012',
                                'source' => 'Medical-Surgical Floor',
                                'bed' => 'ICU-014',
                                'nurse' => 'Emily Davis',
                                'duration' => '38 mins',
                                'status' => 'completed'
                            ]
                        ];
                    @endphp

                    @foreach($recentAdmissions as $admission)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admission['time'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900">{{ $admission['patient'] }}</div>
                                <div class="text-sm text-slate-500">{{ $admission['patientId'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admission['source'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admission['bed'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admission['nurse'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admission['duration'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ ucfirst($admission['status']) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
