@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Cardiac Monitors</h1>
            <p class="text-slate-500 mt-1">Real-time cardiac rhythm and hemodynamic monitoring</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                View Rhythms
            </button>
        </div>
    </div>

    <!-- Monitor Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Monitors</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">12</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Monitoring</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">12</p>
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
                    <p class="text-sm text-slate-500">Arrhythmias</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">2</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">ST Changes</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">1</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Cardiac Monitoring Grid -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Live Cardiac Monitoring</h2>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-slate-600">Live streaming</span>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @php
                    $cardiacMonitors = [
                        [
                            'monitorId' => 'CM-001',
                            'patient' => 'John Smith',
                            'patientId' => 'P001',
                            'bed' => 'ICU-001',
                            'rhythm' => 'Sinus Rhythm',
                            'heartRate' => 78,
                            'bloodPressure' => ['systolic' => 120, 'diastolic' => 80],
                            'spo2' => 98,
                            'status' => 'normal',
                            'alarms' => [],
                            'lastUpdate' => '2 secs ago'
                        ],
                        [
                            'monitorId' => 'CM-002',
                            'patient' => 'Maria Garcia',
                            'patientId' => 'P002',
                            'bed' => 'ICU-002',
                            'rhythm' => 'Atrial Fibrillation',
                            'heartRate' => 95,
                            'bloodPressure' => ['systolic' => 145, 'diastolic' => 95],
                            'spo2' => 82,
                            'status' => 'critical',
                            'alarms' => ['A-Fib with RVR', 'High HR'],
                            'lastUpdate' => '1 sec ago'
                        ],
                        [
                            'monitorId' => 'CM-003',
                            'patient' => 'Robert Johnson',
                            'patientId' => 'P003',
                            'bed' => 'ICU-003',
                            'rhythm' => 'Sinus Tachycardia',
                            'heartRate' => 105,
                            'bloodPressure' => ['systolic' => 118, 'diastolic' => 76],
                            'spo2' => 96,
                            'status' => 'warning',
                            'alarms' => ['Tachycardia'],
                            'lastUpdate' => '3 secs ago'
                        ],
                        [
                            'monitorId' => 'CM-004',
                            'patient' => 'Susan Chen',
                            'patientId' => 'P004',
                            'bed' => 'ICU-004',
                            'rhythm' => 'Sinus Rhythm',
                            'heartRate' => 88,
                            'bloodPressure' => ['systolic' => 135, 'diastolic' => 88],
                            'spo2' => 91,
                            'status' => 'warning',
                            'alarms' => ['ST Depression'],
                            'lastUpdate' => '2 secs ago'
                        ],
                        [
                            'monitorId' => 'CM-005',
                            'patient' => 'James Wilson',
                            'patientId' => 'P005',
                            'bed' => 'ICU-005',
                            'rhythm' => 'Sinus Bradycardia',
                            'heartRate' => 52,
                            'bloodPressure' => ['systolic' => 110, 'diastolic' => 70],
                            'spo2' => 97,
                            'status' => 'warning',
                            'alarms' => ['Bradycardia'],
                            'lastUpdate' => '1 sec ago'
                        ],
                        [
                            'monitorId' => 'CM-006',
                            'patient' => 'Elena Rodriguez',
                            'patientId' => 'P006',
                            'bed' => 'ICU-006',
                            'rhythm' => 'Normal Sinus Rhythm',
                            'heartRate' => 72,
                            'bloodPressure' => ['systolic' => 125, 'diastolic' => 82],
                            'spo2' => 95,
                            'status' => 'normal',
                            'alarms' => [],
                            'lastUpdate' => '2 secs ago'
                        ]
                    ];
                @endphp

                @foreach($cardiacMonitors as $monitor)
                    <div class="border-2 rounded-xl overflow-hidden
                        @if($monitor['status'] == 'critical') border-red-200
                        @elseif($monitor['status'] == 'warning') border-amber-200
                        @else border-slate-200 @endif">
                        <!-- Header -->
                        <div class="p-4 border-b
                            @if($monitor['status'] == 'critical') border-red-200 bg-red-50
                            @elseif($monitor['status'] == 'warning') border-amber-200 bg-amber-50
                            @else border-slate-200 @endif">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <h3 class="font-semibold text-slate-900">{{ $monitor['monitorId'] }}</h3>
                                        @if($monitor['status'] == 'critical')
                                            <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                                        @endif
                                    </div>
                                    <div class="text-sm text-slate-600 mt-1">
                                        {{ $monitor['patient'] }} ({{ $monitor['patientId'] }}) • {{ $monitor['bed'] }}
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($monitor['status'] == 'critical') bg-red-100 text-red-800
                                        @elseif($monitor['status'] == 'warning') bg-amber-100 text-amber-800
                                        @else bg-emerald-100 text-emerald-800
                                        @endif">
                                        {{ ucfirst($monitor['status']) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- ECG Display -->
                        <div class="p-4 bg-slate-900">
                            <div class="h-24 flex items-center justify-center">
                                <svg class="w-full h-full" viewBox="0 0 400 100">
                                    <polyline
                                        points="0,50 20,50 30,20 40,80 50,50 70,50 80,30 90,70 100,50 120,50 130,25 140,75 150,50 170,50 180,35 190,65 200,50 220,50 230,40 240,60 250,50 270,50 280,45 290,55 300,50 320,50 330,30 340,70 350,50 370,50 380,40 390,60 400,50"
                                        fill="none"
                                        stroke="@if($monitor['status'] == 'critical') #ef4444 @elseif($monitor['status'] == 'warning') #f59e0b @else #10b981 @endif"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                            <div class="text-center text-xs text-slate-400 mt-2">
                                {{ $monitor['rhythm'] }}
                            </div>
                        </div>

                        <!-- Vital Signs -->
                        <div class="p-4 space-y-3">
                            <!-- Heart Rate -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-emerald-100 rounded flex items-center justify-center">
                                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-slate-600">HR</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-slate-900">{{ $monitor['heartRate'] }}</span>
                                    <span class="text-xs text-slate-500 ml-1">bpm</span>
                                </div>
                            </div>

                            <!-- Blood Pressure -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-blue-100 rounded flex items-center justify-center">
                                        <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-slate-600">BP</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-slate-900">{{ $monitor['bloodPressure']['systolic'] }}/{{ $monitor['bloodPressure']['diastolic'] }}</span>
                                    <span class="text-xs text-slate-500 ml-1">mmHg</span>
                                </div>
                            </div>

                            <!-- SpO2 -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-red-100 rounded flex items-center justify-center">
                                        <svg class="w-3 h-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-slate-600">SpO2</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-lg font-bold text-slate-900">{{ $monitor['spo2'] }}</span>
                                    <span class="text-xs text-slate-500 ml-1">%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Alarms -->
                        @if(!empty($monitor['alarms']))
                            <div class="px-4 pb-4">
                                <div class="space-y-1">
                                    @foreach($monitor['alarms'] as $alarm)
                                        <div class="flex items-center space-x-2 text-xs">
                                            <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                                            <span class="text-red-700 font-medium">{{ $alarm }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="px-4 pb-4 pt-2 border-t border-slate-200">
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-slate-500">
                                    {{ $monitor['lastUpdate'] }}
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="px-2 py-1 text-xs bg-white border border-slate-300 rounded hover:bg-slate-50">
                                        12-Lead
                                    </button>
                                    <button class="px-2 py-1 text-xs bg-emerald-600 text-white rounded hover:bg-emerald-700">
                                        Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Arrhythmia Detection -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Arrhythmia Detection</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $arrhythmias = [
                        [
                            'patient' => 'Maria Garcia (P002)',
                            'monitor' => 'CM-002',
                            'rhythm' => 'Atrial Fibrillation',
                            'detection' => '2:15 AM',
                            'duration' => '4h 30m',
                            'severity' => 'critical',
                            'treatment' => 'Rate control with beta-blocker',
                            'status' => 'active'
                        ],
                        [
                            'patient' => 'Robert Johnson (P003)',
                            'monitor' => 'CM-003',
                            'rhythm' => 'Sinus Tachycardia',
                            'detection' => '3:45 AM',
                            'duration' => '3h',
                            'severity' => 'warning',
                            'treatment' => 'Fluid resuscitation',
                            'status' => 'monitoring'
                        ],
                        [
                            'patient' => 'James Wilson (P005)',
                            'monitor' => 'CM-005',
                            'rhythm' => 'Sinus Bradycardia',
                            'detection' => '4:30 AM',
                            'duration' => '2h 15m',
                            'severity' => 'warning',
                            'treatment' => 'Atropine ready',
                            'status' => 'monitoring'
                        ]
                    ];
                @endphp

                @foreach($arrhythmias as $arrhythmia)
                    <div class="border rounded-lg p-4
                        @if($arrhythmia['severity'] == 'critical') border-red-200 bg-red-50
                        @else border-amber-200 bg-amber-50 @endif">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h4 class="font-medium text-slate-900">{{ $arrhythmia['rhythm'] }}</h4>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($arrhythmia['severity'] == 'critical') bg-red-100 text-red-800
                                        @else bg-amber-100 text-amber-800 @endif">
                                        {{ ucfirst($arrhythmia['severity']) }}
                                    </span>
                                </div>
                                <div class="text-sm text-slate-600 mb-2">
                                    <p>{{ $arrhythmia['patient'] }} • {{ $arrhythmia['monitor'] }}</p>
                                    <p>Detected: {{ $arrhythmia['detection'] }} • Duration: {{ $arrhythmia['duration'] }}</p>
                                </div>
                                <div class="text-sm">
                                    <span class="font-medium text-slate-700">Treatment:</span> {{ $arrhythmia['treatment'] }}
                                </div>
                            </div>
                            <div class="ml-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($arrhythmia['status'] == 'active') bg-red-100 text-red-800
                                    @else bg-amber-100 text-amber-800 @endif">
                                    {{ ucfirst($arrhythmia['status']) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ST Segment Analysis -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">ST Segment Analysis</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $stAnalysis = [
                        ['patient' => 'John Smith', 'patientId' => 'P001', 'leads' => 'II, III, aVF', 'changes' => 'Normal', 'status' => 'stable'],
                        ['patient' => 'Maria Garcia', 'patientId' => 'P002', 'leads' => 'V1-V4', 'changes' => 'Elevation 2mm', 'status' => 'critical'],
                        ['patient' => 'Susan Chen', 'patientId' => 'P004', 'leads' => 'II, III, aVF', 'changes' => 'Depression 1mm', 'status' => 'warning'],
                        ['patient' => 'Robert Johnson', 'patientId' => 'P003', 'leads' => 'All leads', 'changes' => 'Normal', 'status' => 'stable']
                    ];
                @endphp

                @foreach($stAnalysis as $st)
                    <div class="border rounded-lg p-4
                        @if($st['status'] == 'critical') border-red-200 bg-red-50
                        @elseif($st['status'] == 'warning') border-amber-200 bg-amber-50
                        @else border-slate-200 @endif">
                        <div class="text-center">
                            <h4 class="font-medium text-slate-900 mb-2">{{ $st['patient'] }}</h4>
                            <p class="text-sm text-slate-600 mb-1">{{ $st['patientId'] }}</p>
                            <p class="text-xs text-slate-500 mb-2">Leads: {{ $st['leads'] }}</p>
                            <div class="text-sm font-medium
                                @if($st['status'] == 'critical') text-red-700
                                @elseif($st['status'] == 'warning') text-amber-700
                                @else text-emerald-700 @endif">
                                {{ $st['changes'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
