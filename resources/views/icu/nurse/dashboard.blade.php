@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Active Patients</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">{{ $activePatients ?? 24 }}</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-600 font-medium">+2 from yesterday</span>
                <svg class="w-4 h-4 text-emerald-600 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Critical Alerts</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">{{ $criticalAlerts ?? 3 }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center animate-pulse">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-red-600 font-medium">Requires immediate attention</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Pending Medications</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">{{ $pendingMeds ?? 8 }}</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-amber-600 font-medium">3 due within 1 hour</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Available Beds</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">{{ $availableBeds ?? 4 }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-blue-600 font-medium">2 in ICU, 2 in step-down</span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Patient Overview -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">Patient Overview</h2>
                    <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm font-medium">
                        View All Patients
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @php
                        $patients = [
                            [
                                'id' => 'P001',
                                'name' => 'John Smith',
                                'age' => 45,
                                'bed' => 'ICU-001',
                                'condition' => 'Post-operative',
                                'status' => 'stable',
                                'lastUpdate' => '2 mins ago'
                            ],
                            [
                                'id' => 'P002',
                                'name' => 'Maria Garcia',
                                'age' => 62,
                                'bed' => 'ICU-002',
                                'condition' => 'Respiratory Failure',
                                'status' => 'critical',
                                'lastUpdate' => '1 min ago'
                            ],
                            [
                                'id' => 'P003',
                                'name' => 'Robert Johnson',
                                'age' => 58,
                                'bed' => 'ICU-003',
                                'condition' => 'Cardiac Monitoring',
                                'status' => 'stable',
                                'lastUpdate' => '5 mins ago'
                            ],
                            [
                                'id' => 'P004',
                                'name' => 'Susan Chen',
                                'age' => 71,
                                'bed' => 'ICU-004',
                                'condition' => 'Sepsis Management',
                                'status' => 'warning',
                                'lastUpdate' => '3 mins ago'
                            ]
                        ];
                    @endphp

                    @foreach($patients as $patient)
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors cursor-pointer">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <p class="font-medium text-slate-900">{{ $patient['name'] }}</p>
                                        <span class="text-sm text-slate-500">{{ $patient['id'] }}</span>
                                    </div>
                                    <div class="flex items-center space-x-4 mt-1">
                                        <span class="text-sm text-slate-600">{{ $patient['age'] }} years</span>
                                        <span class="text-sm text-slate-600">{{ $patient['bed'] }}</span>
                                        <span class="text-sm text-slate-600">{{ $patient['condition'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($patient['status'] == 'stable') bg-green-100 text-green-800
                                        @elseif($patient['status'] == 'critical') bg-red-100 text-red-800
                                        @else bg-amber-100 text-amber-800 @endif">
                                        {{ ucfirst($patient['status']) }}
                                    </span>
                                    <p class="text-xs text-slate-500 mt-1">{{ $patient['lastUpdate'] }}</p>
                                </div>
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="space-y-6">
            <!-- Recent Alerts -->
            <div class="bg-white rounded-xl border border-slate-200/80">
                <div class="p-6 border-b border-slate-200/80">
                    <h2 class="text-lg font-semibold text-slate-900">Recent Alerts</h2>
                </div>
                <div class="p-6 space-y-3">
                    @php
                        $alerts = [
                            [
                                'type' => 'critical',
                                'message' => 'SpO2 dropped below 85%',
                                'patient' => 'Maria Garcia (P002)',
                                'time' => '2 mins ago'
                            ],
                            [
                                'type' => 'warning',
                                'message' => 'Blood pressure elevated',
                                'patient' => 'Susan Chen (P004)',
                                'time' => '5 mins ago'
                            ],
                            [
                                'type' => 'info',
                                'message' => 'Medication due',
                                'patient' => 'John Smith (P001)',
                                'time' => '10 mins ago'
                            ]
                        ];
                    @endphp

                    @foreach($alerts as $alert)
                        <div class="flex items-start space-x-3 p-3 rounded-lg
                            @if($alert['type'] == 'critical') bg-red-50
                            @elseif($alert['type'] == 'warning') bg-amber-50
                            @else bg-blue-50 @endif">
                            <div class="w-2 h-2 rounded-full mt-2
                                @if($alert['type'] == 'critical') bg-red-500
                                @elseif($alert['type'] == 'warning') bg-amber-500
                                @else bg-blue-500 @endif"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">{{ $alert['message'] }}</p>
                                <p class="text-xs text-slate-600 mt-1">{{ $alert['patient'] }}</p>
                                <p class="text-xs text-slate-500 mt-1">{{ $alert['time'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-slate-200/80">
                <div class="p-6 border-b border-slate-200/80">
                    <h2 class="text-lg font-semibold text-slate-900">Quick Actions</h2>
                </div>
                <div class="p-6 space-y-3">
                    <button class="w-full px-4 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium text-sm">
                        Record Vitals
                    </button>
                    <button class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">
                        Administer Medication
                    </button>
                    <button class="w-full px-4 py-3 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors font-medium text-sm">
                        Update Care Plan
                    </button>
                    <button class="w-full px-4 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors font-medium text-sm">
                        Start Shift Handover
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Recent Activity</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @php
                    $activities = [
                        [
                            'action' => 'Medication administered',
                            'details' => 'Morphine 2mg IV to John Smith (P001)',
                            'user' => 'Nurse Sarah Johnson',
                            'time' => '10 mins ago',
                            'type' => 'medication'
                        ],
                        [
                            'action' => 'Vitals recorded',
                            'details' => 'Routine vitals for Maria Garcia (P002)',
                            'user' => 'Nurse Mike Wilson',
                            'time' => '15 mins ago',
                            'type' => 'vitals'
                        ],
                        [
                            'action' => 'Alert acknowledged',
                            'details' => 'Low SpO2 alert for Susan Chen (P004)',
                            'user' => 'Nurse Emily Davis',
                            'time' => '20 mins ago',
                            'type' => 'alert'
                        ],
                        [
                            'action' => 'Patient admitted',
                            'details' => 'Robert Johnson admitted to ICU-003',
                            'user' => 'Dr. James Chen',
                            'time' => '1 hour ago',
                            'type' => 'admission'
                        ]
                    ];
                @endphp

                @foreach($activities as $activity)
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center
                            @if($activity['type'] == 'medication') bg-emerald-100
                            @elseif($activity['type'] == 'vitals') bg-blue-100
                            @elseif($activity['type'] == 'alert') bg-red-100
                            @else bg-amber-100 @endif">
                            @if($activity['type'] == 'medication')
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            @elseif($activity['type'] == 'vitals')
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            @elseif($activity['type'] == 'alert')
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-slate-900">{{ $activity['action'] }}</p>
                            <p class="text-sm text-slate-600 mt-1">{{ $activity['details'] }}</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="text-xs text-slate-500">{{ $activity['user'] }}</span>
                                <span class="text-xs text-slate-400">•</span>
                                <span class="text-xs text-slate-500">{{ $activity['time'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
