@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Alerts Management</h1>
            <p class="text-slate-500 mt-1">Monitor and manage patient alerts and notifications</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
                Test Alert
            </button>
        </div>
    </div>

    <!-- Critical Alerts Banner -->
    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-600 mr-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div class="flex-1">
                <p class="text-sm font-medium text-red-800">3 Critical Alerts Require Immediate Attention</p>
                <p class="text-sm text-red-600 mt-1">Maria Garcia - SpO2 below 85%, Robert Johnson - Arrhythmia detected, Susan Chen - BP critically elevated</p>
            </div>
            <button class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                View Critical
            </button>
        </div>
    </div>

    <!-- Alert Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Active</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">24</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Critical</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">3</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center animate-pulse">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Acknowledged</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">8</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Resolved Today</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">15</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Filters -->
    <div class="bg-white rounded-xl border border-slate-200/80 p-4">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Severity:</label>
                <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Levels</option>
                    <option>Critical</option>
                    <option>Warning</option>
                    <option>Info</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Status:</label>
                <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Status</option>
                    <option>Open</option>
                    <option>Acknowledged</option>
                    <option>Resolved</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Patient:</label>
                <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Patients</option>
                    <option>John Smith</option>
                    <option>Maria Garcia</option>
                    <option>Robert Johnson</option>
                    <option>Susan Chen</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Time Range:</label>
                <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>Last Hour</option>
                    <option>Last 6 Hours</option>
                    <option>Last 24 Hours</option>
                    <option>Last 7 Days</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Active Alerts -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Active Alerts</h2>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                        Acknowledge Selected
                    </button>
                    <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Bulk Actions
                    </button>
                </div>
            </div>
        </div>
        <div class="divide-y divide-slate-200">
            @php
                $alerts = [
                    [
                        'id' => 'ALT001',
                        'severity' => 'critical',
                        'status' => 'open',
                        'patient' => 'Maria Garcia',
                        'patientId' => 'P002',
                        'bed' => 'ICU-002',
                        'type' => 'Vital Signs',
                        'message' => 'SpO2 dropped to 82%',
                        'details' => 'Oxygen saturation below critical threshold for 3 minutes',
                        'triggeredAt' => '2 mins ago',
                        'duration' => '3 mins',
                        'device' => 'Pulse Oximeter-002',
                        'trend' => 'worsening'
                    ],
                    [
                        'id' => 'ALT002',
                        'severity' => 'critical',
                        'status' => 'acknowledged',
                        'patient' => 'Robert Johnson',
                        'patientId' => 'P003',
                        'bed' => 'ICU-003',
                        'type' => 'Cardiac',
                        'message' => 'Arrhythmia detected',
                        'details' => 'Atrial fibrillation with rapid ventricular response',
                        'triggeredAt' => '15 mins ago',
                        'duration' => '15 mins',
                        'device' => 'Cardiac Monitor-003',
                        'acknowledgedBy' => 'Dr. James Chen',
                        'acknowledgedAt' => '10 mins ago',
                        'trend' => 'stable'
                    ],
                    [
                        'id' => 'ALT003',
                        'severity' => 'critical',
                        'status' => 'open',
                        'patient' => 'Susan Chen',
                        'patientId' => 'P004',
                        'bed' => 'ICU-004',
                        'type' => 'Blood Pressure',
                        'message' => 'BP critically elevated',
                        'details' => 'Systolic BP > 180 mmHg for 5 minutes',
                        'triggeredAt' => '5 mins ago',
                        'duration' => '5 mins',
                        'device' => 'BP Monitor-004',
                        'trend' => 'improving'
                    ],
                    [
                        'id' => 'ALT004',
                        'severity' => 'warning',
                        'status' => 'acknowledged',
                        'patient' => 'John Smith',
                        'patientId' => 'P001',
                        'bed' => 'ICU-001',
                        'type' => 'Medication',
                        'message' => 'Medication due',
                        'details' => 'Morphine 2mg IV scheduled for pain management',
                        'triggeredAt' => '30 mins ago',
                        'duration' => '30 mins',
                        'device' => 'Medication System',
                        'acknowledgedBy' => 'Sarah Johnson',
                        'acknowledgedAt' => '25 mins ago',
                        'trend' => 'stable'
                    ],
                    [
                        'id' => 'ALT005',
                        'severity' => 'warning',
                        'status' => 'open',
                        'patient' => 'Maria Garcia',
                        'patientId' => 'P002',
                        'bed' => 'ICU-002',
                        'type' => 'Device',
                        'message' => 'IV pump alarm',
                        'details' => 'Occlusion detected in IV line',
                        'triggeredAt' => '8 mins ago',
                        'duration' => '8 mins',
                        'device' => 'IV Pump-002',
                        'trend' => 'stable'
                    ]
                ];
            @endphp

            @foreach($alerts as $alert)
                <div class="p-6 hover:bg-slate-50 transition-colors
                    @if($alert['severity'] == 'critical') border-l-4 border-red-500
                    @elseif($alert['severity'] == 'warning') border-l-4 border-amber-500
                    @else border-l-4 border-blue-500 @endif">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="mt-1">
                                <div class="w-3 h-3 rounded-full
                                    @if($alert['severity'] == 'critical') bg-red-500 animate-pulse
                                    @elseif($alert['severity'] == 'warning') bg-amber-500
                                    @else bg-blue-500 @endif"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="text-sm font-medium text-slate-900">{{ $alert['id'] }}</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($alert['severity'] == 'critical') bg-red-100 text-red-800
                                        @elseif($alert['severity'] == 'warning') bg-amber-100 text-amber-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($alert['severity']) }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($alert['status'] == 'open') bg-slate-100 text-slate-800
                                        @elseif($alert['status'] == 'acknowledged') bg-amber-100 text-amber-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ ucfirst($alert['status']) }}
                                    </span>
                                    @if($alert['trend'] == 'worsening')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                            </svg>
                                            Worsening
                                        </span>
                                    @elseif($alert['trend'] == 'improving')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                            Improving
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="mb-2">
                                    <p class="font-medium text-slate-900">{{ $alert['message'] }}</p>
                                    <p class="text-sm text-slate-600 mt-1">{{ $alert['details'] }}</p>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                    <div>
                                        <span class="text-slate-500">Patient:</span>
                                        <span class="ml-2 text-slate-900">{{ $alert['patient'] }} ({{ $alert['patientId'] }})</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-500">Bed:</span>
                                        <span class="ml-2 text-slate-900">{{ $alert['bed'] }}</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-500">Type:</span>
                                        <span class="ml-2 text-slate-900">{{ $alert['type'] }}</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-500">Device:</span>
                                        <span class="ml-2 text-slate-900">{{ $alert['device'] ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 mt-3 text-sm text-slate-500">
                                    <span>Triggered: {{ $alert['triggeredAt'] }}</span>
                                    <span>Duration: {{ $alert['duration'] }}</span>
                                    @if(isset($alert['acknowledgedBy']))
                                        <span>Acknowledged by {{ $alert['acknowledgedBy'] }} @if(isset($alert['acknowledgedAt']))({{ $alert['acknowledgedAt'] }})@endif</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2 ml-4">
                            @if($alert['status'] == 'open')
                                <button class="px-3 py-1 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors text-sm">
                                    Acknowledge
                                </button>
                            @endif
                            <button class="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                View Details
                            </button>
                            @if($alert['status'] != 'resolved')
                                <button class="px-3 py-1 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm">
                                    Resolve
                                </button>
                            @endif>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Alert History -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Recent Alert History</h2>
                <button class="text-emerald-600 hover:text-emerald-700 text-sm font-medium">
                    View Full History
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Alert</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Severity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $alertHistory = [
                            [
                                'time' => '06:45',
                                'patient' => 'John Smith',
                                'alert' => 'BP elevated',
                                'severity' => 'warning',
                                'status' => 'resolved',
                                'duration' => '12 mins',
                                'resolvedBy' => 'Sarah Johnson'
                            ],
                            [
                                'time' => '06:30',
                                'patient' => 'Maria Garcia',
                                'alert' => 'High heart rate',
                                'severity' => 'warning',
                                'status' => 'resolved',
                                'duration' => '8 mins',
                                'resolvedBy' => 'Mike Wilson'
                            ],
                            [
                                'time' => '06:15',
                                'patient' => 'Robert Johnson',
                                'alert' => 'Low urine output',
                                'severity' => 'warning',
                                'status' => 'acknowledged',
                                'duration' => '45 mins',
                                'acknowledgedBy' => 'Emily Davis'
                            ],
                            [
                                'time' => '05:45',
                                'patient' => 'Susan Chen',
                                'alert' => 'Temperature elevated',
                                'severity' => 'info',
                                'status' => 'resolved',
                                'duration' => '30 mins',
                                'resolvedBy' => 'Sarah Johnson'
                            ]
                        ];
                    @endphp

                    @foreach($alertHistory as $history)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $history['time'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $history['patient'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $history['alert'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($history['severity'] == 'critical') bg-red-100 text-red-800
                                    @elseif($history['severity'] == 'warning') bg-amber-100 text-amber-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($history['severity']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($history['status'] == 'resolved') bg-green-100 text-green-800
                                    @elseif($history['status'] == 'acknowledged') bg-amber-100 text-amber-800
                                    @else bg-slate-100 text-slate-800 @endif">
                                    {{ ucfirst($history['status']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $history['duration'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                @if(isset($history['resolvedBy']))
                                    Resolved by {{ $history['resolvedBy'] }}
                                @elseif(isset($history['acknowledgedBy']))
                                    Ack by {{ $history['acknowledgedBy'] }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
