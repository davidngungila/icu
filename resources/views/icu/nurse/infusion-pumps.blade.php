@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Infusion Pumps</h1>
            <p class="text-slate-500 mt-1">Manage and monitor intravenous medication delivery</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Infusion
            </button>
        </div>
    </div>

    <!-- Pump Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Pumps</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">16</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Active</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">12</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-600 font-medium">75% in use</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Alarms</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">3</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Available</p>
                    <p class="text-2xl font-bold text-slate-600 mt-1">4</p>
                </div>
                <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Infusions -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Active Infusions</h2>
                <div class="flex items-center space-x-2">
                    <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>All Patients</option>
                        <option>John Smith</option>
                        <option>Maria Garcia</option>
                        <option>Robert Johnson</option>
                        <option>Susan Chen</option>
                    </select>
                    <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                        Refresh
                    </button>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Pump</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Medication</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Rate</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Volume</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Time Remaining</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $infusions = [
                            [
                                'pumpId' => 'PUMP-001',
                                'patient' => 'Maria Garcia',
                                'patientId' => 'P002',
                                'bed' => 'ICU-002',
                                'medication' => 'Norepinephrine',
                                'concentration' => '16 mcg/mL',
                                'rate' => 12,
                                'rateUnit' => 'mcg/kg/min',
                                'volume' => '250',
                                'volumeInfused' => 125,
                                'timeRemaining' => '2h 15m',
                                'status' => 'infusing',
                                'startedAt' => '06:00 AM',
                                'alarms' => []
                            ],
                            [
                                'pumpId' => 'PUMP-002',
                                'patient' => 'Maria Garcia',
                                'patientId' => 'P002',
                                'bed' => 'ICU-002',
                                'medication' => 'Propofol',
                                'concentration' => '10 mg/mL',
                                'rate' => 60,
                                'rateUnit' => 'mcg/kg/min',
                                'volume' => '100',
                                'volumeInfused' => 45,
                                'timeRemaining' => '45m',
                                'status' => 'infusing',
                                'startedAt' => '07:15 AM',
                                'alarms' => ['Near End']
                            ],
                            [
                                'pumpId' => 'PUMP-003',
                                'patient' => 'John Smith',
                                'patientId' => 'P001',
                                'bed' => 'ICU-001',
                                'medication' => 'Morphine',
                                'concentration' => '2 mg/mL',
                                'rate' => 2,
                                'rateUnit' => 'mg/hr',
                                'volume' => '50',
                                'volumeInfused' => 30,
                                'timeRemaining' => '10h',
                                'status' => 'infusing',
                                'startedAt' => '09:00 PM',
                                'alarms' => []
                            ],
                            [
                                'pumpId' => 'PUMP-004',
                                'patient' => 'Robert Johnson',
                                'patientId' => 'P003',
                                'bed' => 'ICU-003',
                                'medication' => 'Furosemide',
                                'concentration' => '10 mg/mL',
                                'rate' => 40,
                                'rateUnit' => 'mg/hr',
                                'volume' => '100',
                                'volumeInfused' => 80,
                                'timeRemaining' => '30m',
                                'status' => 'infusing',
                                'startedAt' => '06:30 AM',
                                'alarms' => ['Occlusion']
                            ],
                            [
                                'pumpId' => 'PUMP-005',
                                'patient' => 'Susan Chen',
                                'patientId' => 'P004',
                                'bed' => 'ICU-004',
                                'medication' => 'Insulin',
                                'concentration' => '100 units/mL',
                                'rate' => 8,
                                'rateUnit' => 'units/hr',
                                'volume' => '100',
                                'volumeInfused' => 40,
                                'timeRemaining' => '7h 30m',
                                'status' => 'infusing',
                                'startedAt' => '02:30 AM',
                                'alarms' => []
                            ],
                            [
                                'pumpId' => 'PUMP-006',
                                'patient' => 'James Wilson',
                                'patientId' => 'P005',
                                'bed' => 'ICU-005',
                                'medication' => 'Dextrose 5%',
                                'concentration' => '5%',
                                'rate' => 100,
                                'rateUnit' => 'mL/hr',
                                'volume' => '1000',
                                'volumeInfused' => 600,
                                'timeRemaining' => '4h',
                                'status' => 'infusing',
                                'startedAt' => '04:00 AM',
                                'alarms' => []
                            ]
                        ];
                    @endphp

                    @foreach($infusions as $infusion)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 rounded-full mr-3
                                        @if($infusion['status'] == 'infusing') bg-emerald-500
                                        @elseif($infusion['status'] == 'stopped') bg-red-500
                                        @else bg-amber-500 @endif"></div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-900">{{ $infusion['pumpId'] }}</div>
                                        <div class="text-sm text-slate-500">{{ $infusion['bed'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900">{{ $infusion['patient'] }}</div>
                                <div class="text-sm text-slate-500">{{ $infusion['patientId'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-slate-900">{{ $infusion['medication'] }}</div>
                                    <div class="text-sm text-slate-500">{{ $infusion['concentration'] }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-slate-900">{{ $infusion['rate'] }} {{ $infusion['rateUnit'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-16 bg-slate-200 rounded-full h-2 mr-2">
                                        <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ ($infusion['volumeInfused'] / $infusion['volume']) * 100 }}%"></div>
                                    </div>
                                    <span class="text-sm text-slate-900">{{ $infusion['volumeInfused'] }}/{{ $infusion['volume'] }} mL</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $infusion['timeRemaining'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($infusion['status'] == 'infusing') bg-emerald-100 text-emerald-800
                                    @elseif($infusion['status'] == 'stopped') bg-red-100 text-red-800
                                    @else bg-amber-100 text-amber-800 @endif">
                                    {{ ucfirst($infusion['status']) }}
                                </span>
                                @if(!empty($infusion['alarms']))
                                    <div class="mt-1">
                                        @foreach($infusion['alarms'] as $alarm)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 mr-1">
                                                {{ $alarm }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-emerald-600 hover:text-emerald-900 mr-3">Adjust</button>
                                <button class="text-blue-600 hover:text-blue-900 mr-3">Pause</button>
                                <button class="text-red-600 hover:text-red-900">Stop</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- New Infusion Setup -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Start New Infusion</h2>
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
                    <label class="block text-sm font-medium text-slate-700 mb-1">Select Pump</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Choose pump...</option>
                        <option>PUMP-007 - Available</option>
                        <option>PUMP-008 - Available</option>
                        <option>PUMP-009 - Available</option>
                        <option>PUMP-010 - Available</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Medication</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Choose medication...</option>
                        <option>Norepinephrine</option>
                        <option>Dopamine</option>
                        <option>Epinephrine</option>
                        <option>Propofol</option>
                        <option>Morphine</option>
                        <option>Fentanyl</option>
                        <option>Insulin</option>
                        <option>Heparin</option>
                        <option>Dextrose 5%</option>
                        <option>Normal Saline</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Concentration</label>
                    <input type="text" placeholder="e.g., 16 mcg/mL" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Volume to Infuse (mL)</label>
                    <input type="number" placeholder="250" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Rate</label>
                    <div class="flex space-x-2">
                        <input type="number" placeholder="12" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option>mcg/kg/min</option>
                            <option>mg/hr</option>
                            <option>units/hr</option>
                            <option>mL/hr</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">VTBI (Volume to Be Infused)</label>
                    <input type="number" placeholder="250" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Dose Limit</label>
                    <input type="text" placeholder="e.g., 1000 mcg" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-blue-800">Double Check Required</p>
                        <p class="text-sm text-blue-700 mt-1">All high-alert medications require independent double-check by another qualified nurse before starting infusion.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3">
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                    Start Infusion
                </button>
            </div>
        </div>
    </div>

    <!-- Pump Maintenance -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Pump Maintenance Schedule</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                    $maintenance = [
                        [
                            'pumpId' => 'PUMP-007',
                            'location' => 'Storage Room A',
                            'lastMaintenance' => '2024-11-15',
                            'nextMaintenance' => '2024-12-15',
                            'status' => 'ready'
                        ],
                        [
                            'pumpId' => 'PUMP-008',
                            'location' => 'Storage Room B',
                            'lastMaintenance' => '2024-11-20',
                            'nextMaintenance' => '2024-12-20',
                            'status' => 'ready'
                        ],
                        [
                            'pumpId' => 'PUMP-009',
                            'location' => 'Storage Room A',
                            'lastMaintenance' => '2024-10-30',
                            'nextMaintenance' => '2024-11-30',
                            'status' => 'due'
                        ],
                        [
                            'pumpId' => 'PUMP-010',
                            'location' => 'Storage Room B',
                            'lastMaintenance' => '2024-11-10',
                            'nextMaintenance' => '2024-12-10',
                            'status' => 'ready'
                        ]
                    ];
                @endphp

                @foreach($maintenance as $pump)
                    <div class="border border-slate-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium text-slate-900">{{ $pump['pumpId'] }}</h4>
                                <p class="text-sm text-slate-600 mt-1">{{ $pump['location'] }}</p>
                                <div class="mt-2 text-xs text-slate-500">
                                    <div>Last: {{ $pump['lastMaintenance'] }}</div>
                                    <div>Next: {{ $pump['nextMaintenance'] }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($pump['status'] == 'ready') bg-emerald-100 text-emerald-800
                                    @elseif($pump['status'] == 'due') bg-amber-100 text-amber-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($pump['status']) }}
                                </span>
                                @if($pump['status'] == 'due')
                                    <button class="mt-2 px-3 py-1 text-sm bg-amber-600 text-white rounded hover:bg-amber-700 block w-full">
                                        Schedule Maintenance
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
