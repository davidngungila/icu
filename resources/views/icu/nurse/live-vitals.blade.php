@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Live Vitals Stream</h1>
            <p class="text-slate-500 mt-1">Real-time monitoring of all patient vital signs</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <span class="text-sm text-slate-600">Live Streaming</span>
            </div>
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Export Data
            </button>
        </div>
    </div>

    <!-- Patient Selection -->
    <div class="bg-white rounded-xl border border-slate-200/80 p-4">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Select Patient:</label>
                <select id="patientSelect" class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="all">All Patients</option>
                    <option value="P001">John Smith (P001)</option>
                    <option value="P002">Maria Garcia (P002)</option>
                    <option value="P003">Robert Johnson (P003)</option>
                    <option value="P004">Susan Chen (P004)</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Update Rate:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="1">1 second</option>
                    <option value="5" selected>5 seconds</option>
                    <option value="10">10 seconds</option>
                    <option value="30">30 seconds</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">View:</label>
                <div class="flex items-center bg-slate-100 rounded-lg p-1">
                    <button class="px-3 py-1 text-sm bg-white rounded shadow-sm">Grid</button>
                    <button class="px-3 py-1 text-sm text-slate-600">List</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Live Vitals Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
        @php
            $livePatients = [
                [
                    'id' => 'P001',
                    'name' => 'John Smith',
                    'bed' => 'ICU-001',
                    'age' => 45,
                    'gender' => 'Male',
                    'condition' => 'Post-operative',
                    'status' => 'stable',
                    'vitals' => [
                        'heartRate' => ['value' => 78, 'trend' => 'stable', 'lastUpdate' => '2 secs ago'],
                        'bloodPressure' => ['systolic' => 120, 'diastolic' => 80, 'trend' => 'stable', 'lastUpdate' => '2 secs ago'],
                        'spo2' => ['value' => 98, 'trend' => 'stable', 'lastUpdate' => '1 sec ago'],
                        'respiratory' => ['value' => 16, 'trend' => 'stable', 'lastUpdate' => '3 secs ago'],
                        'temperature' => ['value' => 37.1, 'trend' => 'stable', 'lastUpdate' => '5 secs ago']
                    ]
                ],
                [
                    'id' => 'P002',
                    'name' => 'Maria Garcia',
                    'bed' => 'ICU-002',
                    'age' => 62,
                    'gender' => 'Female',
                    'condition' => 'Respiratory Failure',
                    'status' => 'critical',
                    'vitals' => [
                        'heartRate' => ['value' => 95, 'trend' => 'up', 'lastUpdate' => '1 sec ago'],
                        'bloodPressure' => ['systolic' => 145, 'diastolic' => 95, 'trend' => 'up', 'lastUpdate' => '2 secs ago'],
                        'spo2' => ['value' => 82, 'trend' => 'down', 'lastUpdate' => '1 sec ago'],
                        'respiratory' => ['value' => 24, 'trend' => 'up', 'lastUpdate' => '1 sec ago'],
                        'temperature' => ['value' => 38.5, 'trend' => 'up', 'lastUpdate' => '3 secs ago']
                    ]
                ],
                [
                    'id' => 'P003',
                    'name' => 'Robert Johnson',
                    'bed' => 'ICU-003',
                    'age' => 58,
                    'gender' => 'Male',
                    'condition' => 'Cardiac Monitoring',
                    'status' => 'stable',
                    'vitals' => [
                        'heartRate' => ['value' => 72, 'trend' => 'stable', 'lastUpdate' => '2 secs ago'],
                        'bloodPressure' => ['systolic' => 118, 'diastolic' => 76, 'trend' => 'stable', 'lastUpdate' => '3 secs ago'],
                        'spo2' => ['value' => 96, 'trend' => 'stable', 'lastUpdate' => '1 sec ago'],
                        'respiratory' => ['value' => 14, 'trend' => 'stable', 'lastUpdate' => '2 secs ago'],
                        'temperature' => ['value' => 36.8, 'trend' => 'stable', 'lastUpdate' => '4 secs ago']
                    ]
                ],
                [
                    'id' => 'P004',
                    'name' => 'Susan Chen',
                    'bed' => 'ICU-004',
                    'age' => 71,
                    'gender' => 'Female',
                    'condition' => 'Sepsis Management',
                    'status' => 'warning',
                    'vitals' => [
                        'heartRate' => ['value' => 88, 'trend' => 'up', 'lastUpdate' => '1 sec ago'],
                        'bloodPressure' => ['systolic' => 135, 'diastolic' => 88, 'trend' => 'up', 'lastUpdate' => '2 secs ago'],
                        'spo2' => ['value' => 91, 'trend' => 'down', 'lastUpdate' => '1 sec ago'],
                        'respiratory' => ['value' => 18, 'trend' => 'stable', 'lastUpdate' => '3 secs ago'],
                        'temperature' => ['value' => 37.6, 'trend' => 'up', 'lastUpdate' => '2 secs ago']
                    ]
                ]
            ];
        @endphp

        @foreach($livePatients as $patient)
            <div class="bg-white rounded-xl border-2 
                @if($patient['status'] == 'critical') border-red-200
                @elseif($patient['status'] == 'warning') border-amber-200
                @else border-slate-200 @endif overflow-hidden">
                <!-- Patient Header -->
                <div class="p-4 border-b
                    @if($patient['status'] == 'critical') border-red-200 bg-red-50
                    @elseif($patient['status'] == 'warning') border-amber-200 bg-amber-50
                    @else border-slate-200 @endif">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-2">
                                <h3 class="font-semibold text-slate-900">{{ $patient['name'] }}</h3>
                                <span class="text-sm text-slate-500">{{ $patient['id'] }}</span>
                                @if($patient['status'] == 'critical')
                                    <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                                @endif
                            </div>
                            <div class="text-sm text-slate-600 mt-1">
                                {{ $patient['bed'] }} • {{ $patient['age'] }}y {{ $patient['gender'] }} • {{ $patient['condition'] }}
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($patient['status'] == 'critical') bg-red-100 text-red-800
                                @elseif($patient['status'] == 'warning') bg-amber-100 text-amber-800
                                @else bg-emerald-100 text-emerald-800
                                @endif">
                                {{ ucfirst($patient['status']) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Live Vitals -->
                <div class="p-4 space-y-3">
                    <!-- Heart Rate -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Heart Rate</p>
                                <p class="text-lg font-bold text-slate-900">{{ $patient['vitals']['heartRate']['value'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center space-x-1">
                                @if($patient['vitals']['heartRate']['trend'] == 'up')
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                @elseif($patient['vitals']['heartRate']['trend'] == 'down')
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                    </svg>
                                @endif
                                <span class="text-xs text-slate-500">{{ $patient['vitals']['heartRate']['lastUpdate'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Blood Pressure -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Blood Pressure</p>
                                <p class="text-lg font-bold text-slate-900">{{ $patient['vitals']['bloodPressure']['systolic'] }}/{{ $patient['vitals']['bloodPressure']['diastolic'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center space-x-1">
                                @if($patient['vitals']['bloodPressure']['trend'] == 'up')
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                @elseif($patient['vitals']['bloodPressure']['trend'] == 'down')
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                    </svg>
                                @endif
                                <span class="text-xs text-slate-500">{{ $patient['vitals']['bloodPressure']['lastUpdate'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- SpO2 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">SpO2</p>
                                <p class="text-lg font-bold text-slate-900">{{ $patient['vitals']['spo2']['value'] }}%</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center space-x-1">
                                @if($patient['vitals']['spo2']['trend'] == 'up')
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                @elseif($patient['vitals']['spo2']['trend'] == 'down')
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                    </svg>
                                @endif
                                <span class="text-xs text-slate-500">{{ $patient['vitals']['spo2']['lastUpdate'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Respiratory Rate -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Respiratory</p>
                                <p class="text-lg font-bold text-slate-900">{{ $patient['vitals']['respiratory']['value'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center space-x-1">
                                @if($patient['vitals']['respiratory']['trend'] == 'up')
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                @elseif($patient['vitals']['respiratory']['trend'] == 'down')
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                    </svg>
                                @endif
                                <span class="text-xs text-slate-500">{{ $patient['vitals']['respiratory']['lastUpdate'] }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Temperature -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">Temperature</p>
                                <p class="text-lg font-bold text-slate-900">{{ $patient['vitals']['temperature']['value'] }}°C</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="flex items-center space-x-1">
                                @if($patient['vitals']['temperature']['trend'] == 'up')
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                @elseif($patient['vitals']['temperature']['trend'] == 'down')
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                    </svg>
                                @endif
                                <span class="text-xs text-slate-500">{{ $patient['vitals']['temperature']['lastUpdate'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-4 border-t border-slate-200 bg-slate-50">
                    <div class="flex items-center justify-between">
                        <div class="text-xs text-slate-500">
                            Last updated: {{ $patient['vitals']['heartRate']['lastUpdate'] }}
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 text-sm bg-white border border-slate-300 rounded hover:bg-slate-50">
                                Details
                            </button>
                            <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded hover:bg-emerald-700">
                                Trends
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Live Alerts Panel -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Live Alerts</h2>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-slate-600">3 Active</span>
                </div>
            </div>
        </div>
        <div class="divide-y divide-slate-200">
            @php
                $liveAlerts = [
                    [
                        'patient' => 'Maria Garcia (P002)',
                        'bed' => 'ICU-002',
                        'alert' => 'SpO2 Critical',
                        'value' => '82%',
                        'threshold' => '< 85%',
                        'time' => '30 secs ago',
                        'severity' => 'critical'
                    ],
                    [
                        'patient' => 'Susan Chen (P004)',
                        'bed' => 'ICU-004',
                        'alert' => 'BP Elevated',
                        'value' => '135/88',
                        'threshold' => '> 130/85',
                        'time' => '2 mins ago',
                        'severity' => 'warning'
                    ],
                    [
                        'patient' => 'Maria Garcia (P002)',
                        'bed' => 'ICU-002',
                        'alert' => 'Heart Rate High',
                        'value' => '95 bpm',
                        'threshold' => '> 90 bpm',
                        'time' => '5 mins ago',
                        'severity' => 'warning'
                    ]
                ];
            @endphp

            @foreach($liveAlerts as $alert)
                <div class="p-4 hover:bg-slate-50 transition-colors">
                    <div class="flex items-start space-x-4">
                        <div class="mt-1">
                            <div class="w-2 h-2 rounded-full
                                @if($alert['severity'] == 'critical') bg-red-500 animate-pulse
                                @else bg-amber-500 @endif"></div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-slate-900">{{ $alert['alert'] }}</p>
                                    <p class="text-sm text-slate-600 mt-1">
                                        {{ $alert['patient'] }} • {{ $alert['bed'] }} • {{ $alert['value'] }} (Threshold: {{ $alert['threshold'] }})
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-slate-500">{{ $alert['time'] }}</p>
                                    <button class="mt-1 px-3 py-1 text-sm bg-emerald-600 text-white rounded hover:bg-emerald-700">
                                        Acknowledge
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
// Live Vitals Updates
let updateInterval;

function startLiveUpdates() {
    const updateRate = parseInt(document.querySelector('select').value) * 1000;
    
    updateInterval = setInterval(() => {
        updateVitals();
    }, updateRate);
}

function updateVitals() {
    // Simulate real-time vital updates
    document.querySelectorAll('[data-patient-id]').forEach(patientCard => {
        const patientId = patientCard.dataset.patientId;
        
        // Update heart rate
        const hrElement = patientCard.querySelector('[data-vital="heart-rate"]');
        if (hrElement) {
            const currentHR = parseInt(hrElement.textContent);
            const newHR = currentHR + Math.floor(Math.random() * 5) - 2; // ±2 variation
            hrElement.textContent = Math.max(60, Math.min(120, newHR));
        }
        
        // Update SpO2
        const spo2Element = patientCard.querySelector('[data-vital="spo2"]');
        if (spo2Element) {
            const currentSpO2 = parseInt(spo2Element.textContent);
            const newSpO2 = currentSpO2 + Math.floor(Math.random() * 3) - 1; // ±1 variation
            spo2Element.textContent = Math.max(85, Math.min(100, newSpO2)) + '%';
        }
        
        // Update timestamps
        patientCard.querySelectorAll('[data-last-update]').forEach(element => {
            element.textContent = 'Just now';
        });
    });
}

// Initialize live updates on page load
document.addEventListener('DOMContentLoaded', function() {
    startLiveUpdates();
    
    // Restart updates when rate changes
    document.querySelector('select').addEventListener('change', function() {
        clearInterval(updateInterval);
        startLiveUpdates();
    });
});

// Clean up on page unload
window.addEventListener('beforeunload', function() {
    if (updateInterval) {
        clearInterval(updateInterval);
    }
});
</script>
@endpush
