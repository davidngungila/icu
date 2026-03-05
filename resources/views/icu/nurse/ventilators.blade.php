@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Ventilator Management</h1>
            <p class="text-slate-500 mt-1">Monitor and manage mechanical ventilation settings</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Adjust Settings
            </button>
        </div>
    </div>

    <!-- Ventilator Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Ventilators</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">8</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">In Use</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">6</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-600 font-medium">75% utilization</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Standby</p>
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
                    <p class="text-sm text-slate-500">Maintenance</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">0</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Ventilators Grid -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Active Ventilators</h2>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg">All</button>
                    <button class="px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50">Critical</button>
                    <button class="px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50">Weaning</button>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @php
                    $ventilators = [
                        [
                            'id' => 'VENT-001',
                            'patient' => 'Maria Garcia',
                            'patientId' => 'P002',
                            'bed' => 'ICU-002',
                            'mode' => 'AC/VC',
                            'status' => 'critical',
                            'settings' => [
                                'tidalVolume' => 450,
                                'rate' => 16,
                                'peep' => 5,
                                'fio2' => 40,
                                'pressureSupport' => 12
                            ],
                            'alarms' => ['High Pressure', 'Low Volume'],
                            'lastUpdate' => '1 min ago'
                        ],
                        [
                            'id' => 'VENT-002',
                            'patient' => 'Robert Johnson',
                            'patientId' => 'P003',
                            'bed' => 'ICU-003',
                            'mode' => 'SIMV',
                            'status' => 'stable',
                            'settings' => [
                                'tidalVolume' => 500,
                                'rate' => 14,
                                'peep' => 8,
                                'fio2' => 30,
                                'pressureSupport' => 10
                            ],
                            'alarms' => [],
                            'lastUpdate' => '2 mins ago'
                        ],
                        [
                            'id' => 'VENT-003',
                            'patient' => 'James Wilson',
                            'patientId' => 'P005',
                            'bed' => 'ICU-005',
                            'mode' => 'CPAP',
                            'status' => 'weaning',
                            'settings' => [
                                'tidalVolume' => 0,
                                'rate' => 0,
                                'peep' => 5,
                                'fio2' => 21,
                                'pressureSupport' => 8
                            ],
                            'alarms' => ['Low Spontaneous Effort'],
                            'lastUpdate' => '3 mins ago'
                        ],
                        [
                            'id' => 'VENT-004',
                            'patient' => 'Elena Rodriguez',
                            'patientId' => 'P006',
                            'bed' => 'ICU-006',
                            'mode' => 'PRVC',
                            'status' => 'stable',
                            'settings' => [
                                'tidalVolume' => 480,
                                'rate' => 15,
                                'peep' => 6,
                                'fio2' => 35,
                                'pressureSupport' => 0
                            ],
                            'alarms' => [],
                            'lastUpdate' => '1 min ago'
                        ]
                    ];
                @endphp

                @foreach($ventilators as $vent)
                    <div class="border rounded-xl p-4
                        @if($vent['status'] == 'critical') border-red-200 bg-red-50
                        @elseif($vent['status'] == 'weaning') border-amber-200 bg-amber-50
                        @else border-slate-200 @endif">
                        <!-- Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="font-semibold text-slate-900">{{ $vent['id'] }}</h3>
                                    @if($vent['status'] == 'critical')
                                        <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                                    @endif
                                </div>
                                <div class="text-sm text-slate-600 mt-1">
                                    {{ $vent['patient'] }} ({{ $vent['patientId'] }}) • {{ $vent['bed'] }}
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $vent['mode'] }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
                                    @if($vent['status'] == 'critical') bg-red-100 text-red-800
                                    @elseif($vent['status'] == 'weaning') bg-amber-100 text-amber-800
                                    @else bg-emerald-100 text-emerald-800
                                    @endif">
                                    {{ ucfirst($vent['status']) }}
                                </span>
                            </div>
                        </div>

                        <!-- Current Settings -->
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4">
                            <div class="text-center">
                                <p class="text-xs text-slate-500">Tidal Volume</p>
                                <p class="text-lg font-bold text-slate-900">{{ $vent['settings']['tidalVolume'] }}</p>
                                <p class="text-xs text-slate-500">mL</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-slate-500">Rate</p>
                                <p class="text-lg font-bold text-slate-900">{{ $vent['settings']['rate'] }}</p>
                                <p class="text-xs text-slate-500">bpm</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-slate-500">PEEP</p>
                                <p class="text-lg font-bold text-slate-900">{{ $vent['settings']['peep'] }}</p>
                                <p class="text-xs text-slate-500">cmH2O</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-slate-500">FiO2</p>
                                <p class="text-lg font-bold text-slate-900">{{ $vent['settings']['fio2'] }}</p>
                                <p class="text-xs text-slate-500">%</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-slate-500">PS</p>
                                <p class="text-lg font-bold text-slate-900">{{ $vent['settings']['pressureSupport'] }}</p>
                                <p class="text-xs text-slate-500">cmH2O</p>
                            </div>
                        </div>

                        <!-- Alarms -->
                        @if(!empty($vent['alarms']))
                            <div class="mb-4">
                                <p class="text-sm font-medium text-slate-700 mb-2">Active Alarms:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($vent['alarms'] as $alarm)
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                            </svg>
                                            {{ $alarm }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-slate-200">
                            <div class="text-xs text-slate-500">
                                Last updated: {{ $vent['lastUpdate'] }}
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="px-3 py-1 text-sm border border-slate-300 rounded hover:bg-slate-50">
                                    View Details
                                </button>
                                <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded hover:bg-emerald-700">
                                    Adjust Settings
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Ventilator Settings Panel -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Quick Settings Adjustment</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Select Ventilator</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>VENT-001 - Maria Garcia (ICU-002)</option>
                        <option>VENT-002 - Robert Johnson (ICU-003)</option>
                        <option>VENT-003 - James Wilson (ICU-005)</option>
                        <option>VENT-004 - Elena Rodriguez (ICU-006)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Ventilation Mode</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>AC/VC</option>
                        <option>SIMV</option>
                        <option>CPAP</option>
                        <option>PRVC</option>
                        <option>PSV</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tidal Volume (mL)</label>
                    <input type="number" value="450" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Rate (bpm)</label>
                    <input type="number" value="16" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">PEEP (cmH2O)</label>
                    <input type="number" value="5" step="0.5" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">FiO2 (%)</label>
                    <input type="number" value="40" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">PS (cmH2O)</label>
                    <input type="number" value="12" step="0.5" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-amber-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-amber-800">Clinical Warning</p>
                        <p class="text-sm text-amber-700 mt-1">Any ventilator setting changes should be confirmed by a respiratory therapist or physician before implementation.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3">
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                    Apply Changes
                </button>
            </div>
        </div>
    </div>

    <!-- Standby Ventilators -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Standby Equipment</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                    $standbyVentilators = [
                        ['id' => 'VENT-005', 'location' => 'Storage Room A', 'status' => 'Ready', 'lastMaintenance' => '2024-11-15'],
                        ['id' => 'VENT-006', 'location' => 'Storage Room B', 'status' => 'Ready', 'lastMaintenance' => '2024-11-20']
                    ];
                @endphp

                @foreach($standbyVentilators as $vent)
                    <div class="border border-slate-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium text-slate-900">{{ $vent['id'] }}</h4>
                                <p class="text-sm text-slate-600 mt-1">{{ $vent['location'] }}</p>
                                <p class="text-xs text-slate-500 mt-1">Last maintenance: {{ $vent['lastMaintenance'] }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ $vent['status'] }}
                                </span>
                                <button class="mt-2 px-3 py-1 text-sm border border-slate-300 rounded hover:bg-slate-50 block w-full">
                                    Deploy
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
