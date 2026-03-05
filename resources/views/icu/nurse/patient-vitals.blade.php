@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Patient Vitals</h1>
            <p class="text-slate-500 mt-1">Real-time monitoring of patient vital signs</p>
        </div>
        <div class="flex items-center space-x-3">
            <select class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option>All Patients</option>
                <option>ICU-001 - John Smith</option>
                <option>ICU-002 - Maria Garcia</option>
                <option>ICU-003 - Robert Johnson</option>
                <option>ICU-004 - Susan Chen</option>
            </select>
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Record Vitals
            </button>
        </div>
    </div>

    <!-- Critical Alerts Banner -->
    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div class="flex-1">
                <p class="text-sm font-medium text-red-800">Critical Alert: Maria Garcia (ICU-002)</p>
                <p class="text-sm text-red-600 mt-1">SpO2 dropped to 82% - Immediate attention required</p>
            </div>
            <button class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                View Details
            </button>
        </div>
    </div>

    <!-- Vitals Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
        @php
            $vitalCards = [
                [
                    'title' => 'Heart Rate',
                    'value' => '78',
                    'unit' => 'bpm',
                    'status' => 'normal',
                    'trend' => 'stable',
                    'range' => '60-100',
                    'icon' => 'heart-pulse',
                    'color' => 'emerald'
                ],
                [
                    'title' => 'Blood Pressure',
                    'value' => '120/80',
                    'unit' => 'mmHg',
                    'status' => 'normal',
                    'trend' => 'up',
                    'range' => '90-140/60-90',
                    'icon' => 'activity',
                    'color' => 'emerald'
                ],
                [
                    'title' => 'Oxygen Saturation',
                    'value' => '94',
                    'unit' => '%',
                    'status' => 'warning',
                    'trend' => 'down',
                    'range' => '95-100',
                    'icon' => 'lungs',
                    'color' => 'amber'
                ],
                [
                    'title' => 'Temperature',
                    'value' => '37.2',
                    'unit' => '°C',
                    'status' => 'normal',
                    'trend' => 'stable',
                    'range' => '36.1-37.2',
                    'icon' => 'thermometer',
                    'color' => 'emerald'
                ],
                [
                    'title' => 'Respiratory Rate',
                    'value' => '16',
                    'unit' => 'bpm',
                    'status' => 'normal',
                    'trend' => 'stable',
                    'range' => '12-20',
                    'icon' => 'wind',
                    'color' => 'emerald'
                ],
                [
                    'title' => 'GCS Score',
                    'value' => '15',
                    'unit' => '/15',
                    'status' => 'normal',
                    'trend' => 'stable',
                    'range' => '13-15',
                    'icon' => 'brain',
                    'color' => 'emerald'
                ],
                [
                    'title' => 'Pain Score',
                    'value' => '3',
                    'unit' => '/10',
                    'status' => 'normal',
                    'trend' => 'down',
                    'range' => '0-10',
                    'icon' => 'frown',
                    'color' => 'emerald'
                ],
                [
                    'title' => 'Urine Output',
                    'value' => '45',
                    'unit' => 'ml/hr',
                    'status' => 'warning',
                    'trend' => 'down',
                    'range' => '30-50',
                    'icon' => 'droplet',
                    'color' => 'amber'
                ]
            ];
        @endphp

        @foreach($vitalCards as $vital)
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-{{ $vital['color'] }}-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-{{ $vital['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($vital['icon'] == 'heart-pulse')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                @elseif($vital['icon'] == 'activity')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                @elseif($vital['icon'] == 'lungs')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                @elseif($vital['icon'] == 'thermometer')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                @elseif($vital['icon'] == 'wind')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                @elseif($vital['icon'] == 'brain')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                @elseif($vital['icon'] == 'frown')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                @endif
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">{{ $vital['title'] }}</p>
                            <p class="text-xs text-slate-400">Normal: {{ $vital['range'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-1">
                        @if($vital['trend'] == 'up')
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        @elseif($vital['trend'] == 'down')
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                            </svg>
                        @else
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                            </svg>
                        @endif
                        <span class="text-xs text-slate-500">{{ $vital['trend'] }}</span>
                    </div>
                </div>
                
                <div class="flex items-baseline space-x-2">
                    <span class="text-3xl font-bold text-slate-900">{{ $vital['value'] }}</span>
                    <span class="text-sm text-slate-500">{{ $vital['unit'] }}</span>
                </div>
                
                <div class="mt-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($vital['status'] == 'normal') bg-green-100 text-green-800
                        @elseif($vital['status'] == 'warning') bg-amber-100 text-amber-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($vital['status']) }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Detailed Vitals Chart -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Vitals Trend - Last 24 Hours</h2>
                <div class="flex items-center space-x-2">
                    <button onclick="updateChartTimeRange('1H')" class="time-range-btn px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50" data-range="1H">1H</button>
                    <button onclick="updateChartTimeRange('24H')" class="time-range-btn px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg" data-range="24H">24H</button>
                    <button onclick="updateChartTimeRange('7D')" class="time-range-btn px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50" data-range="7D">7D</button>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="relative">
                <!-- Chart Container -->
                <div class="h-96 bg-slate-50 rounded-lg border border-slate-200">
                    <canvas id="vitalsChart"></canvas>
                </div>
                
                <!-- Chart Legend -->
                <div class="mt-4 flex flex-wrap items-center justify-center gap-4 text-sm">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full mr-2"></div>
                        <span>Heart Rate</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                        <span>Blood Pressure (Sys)</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-amber-500 rounded-full mr-2"></div>
                        <span>Blood Pressure (Dias)</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                        <span>SpO2</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                        <span>Temperature</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-indigo-500 rounded-full mr-2"></div>
                        <span>Respiratory Rate</span>
                    </div>
                </div>
                
                <!-- Real-time Status -->
                <div class="absolute top-4 right-4 flex items-center space-x-2">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-xs text-slate-600">Live</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Vitals Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl border border-slate-200/80 p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">24-Hour Statistics</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-slate-600">Avg Heart Rate</span>
                    <span class="font-semibold text-emerald-600">76 bpm</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-slate-600">Avg BP</span>
                    <span class="font-semibold text-blue-600">118/78 mmHg</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-slate-600">Avg SpO2</span>
                    <span class="font-semibold text-red-600">96%</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-slate-600">Avg Temp</span>
                    <span class="font-semibold text-purple-600">37.1°C</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl border border-slate-200/80 p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Critical Events</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-2 bg-red-50 rounded">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <span class="text-sm text-slate-700">SpO2 < 85%</span>
                    </div>
                    <span class="text-xs text-slate-500">2:30 AM</span>
                </div>
                <div class="flex items-center justify-between p-2 bg-amber-50 rounded">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                        <span class="text-sm text-slate-700">HR > 100</span>
                    </div>
                    <span class="text-xs text-slate-500">4:15 AM</span>
                </div>
                <div class="flex items-center justify-between p-2 bg-blue-50 rounded">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span class="text-sm text-slate-700">BP > 140/90</span>
                    </div>
                    <span class="text-xs text-slate-500">6:45 AM</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl border border-slate-200/80 p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Trend Analysis</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Heart Rate</span>
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-sm text-emerald-600">Stable</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Blood Pressure</span>
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                        <span class="text-sm text-amber-600">Improving</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Oxygen Sat</span>
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                        <span class="text-sm text-red-600">Worsening</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient List with Vitals -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">All Patients Vitals</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">HR</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">BP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">SpO2</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Temp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">RR</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Last Update</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $patientVitals = [
                            [
                                'name' => 'John Smith',
                                'id' => 'P001',
                                'bed' => 'ICU-001',
                                'hr' => '78',
                                'bp' => '120/80',
                                'spo2' => '98',
                                'temp' => '37.1',
                                'rr' => '16',
                                'status' => 'stable',
                                'lastUpdate' => '2 mins ago'
                            ],
                            [
                                'name' => 'Maria Garcia',
                                'id' => 'P002',
                                'bed' => 'ICU-002',
                                'hr' => '95',
                                'bp' => '145/95',
                                'spo2' => '82',
                                'temp' => '38.5',
                                'rr' => '24',
                                'status' => 'critical',
                                'lastUpdate' => '1 min ago'
                            ],
                            [
                                'name' => 'Robert Johnson',
                                'id' => 'P003',
                                'bed' => 'ICU-003',
                                'hr' => '72',
                                'bp' => '118/76',
                                'spo2' => '96',
                                'temp' => '36.8',
                                'rr' => '14',
                                'status' => 'stable',
                                'lastUpdate' => '5 mins ago'
                            ],
                            [
                                'name' => 'Susan Chen',
                                'id' => 'P004',
                                'bed' => 'ICU-004',
                                'hr' => '88',
                                'bp' => '135/88',
                                'spo2' => '91',
                                'temp' => '37.6',
                                'rr' => '18',
                                'status' => 'warning',
                                'lastUpdate' => '3 mins ago'
                            ]
                        ];
                    @endphp

                    @foreach($patientVitals as $patient)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-slate-900">{{ $patient['name'] }}</div>
                                    <div class="text-sm text-slate-500">{{ $patient['id'] }} • {{ $patient['bed'] }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-900 {{ $patient['hr'] > 100 || $patient['hr'] < 60 ? 'text-red-600 font-medium' : '' }}">{{ $patient['hr'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-900 {{ $patient['bp'] > '140/90' || $patient['bp'] < '90/60' ? 'text-red-600 font-medium' : '' }}">{{ $patient['bp'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-900 {{ $patient['spo2'] < 95 ? 'text-red-600 font-medium' : '' }}">{{ $patient['spo2'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-900 {{ $patient['temp'] > 38 || $patient['temp'] < 36 ? 'text-red-600 font-medium' : '' }}">{{ $patient['temp'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-slate-900 {{ $patient['rr'] > 20 || $patient['rr'] < 12 ? 'text-red-600 font-medium' : '' }}">{{ $patient['rr'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($patient['status'] == 'stable') bg-green-100 text-green-800
                                    @elseif($patient['status'] == 'warning') bg-amber-100 text-amber-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($patient['status']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ $patient['lastUpdate'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-emerald-600 hover:text-emerald-900 mr-3">View</button>
                                <button class="text-blue-600 hover:text-blue-900">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Vitals Chart Implementation
let vitalsChart;
let currentTimeRange = '24H';
let realTimeInterval;

// Initialize chart when page loads
document.addEventListener('DOMContentLoaded', function() {
    initializeVitalsChart();
    startRealTimeUpdates();
});

function initializeVitalsChart() {
    const ctx = document.getElementById('vitalsChart').getContext('2d');
    
    // Generate initial data based on current time range
    const data = generateVitalsData(currentTimeRange);
    
    vitalsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: 'Heart Rate',
                    data: data.heartRate,
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    yAxisID: 'y-primary',
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5
                },
                {
                    label: 'Blood Pressure (Sys)',
                    data: data.bpSystolic,
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    yAxisID: 'y-primary',
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5
                },
                {
                    label: 'Blood Pressure (Dias)',
                    data: data.bpDiastolic,
                    borderColor: 'rgb(245, 158, 11)',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    yAxisID: 'y-primary',
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5
                },
                {
                    label: 'SpO2',
                    data: data.spO2,
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    yAxisID: 'y-secondary',
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5
                },
                {
                    label: 'Temperature',
                    data: data.temperature,
                    borderColor: 'rgb(147, 51, 234)',
                    backgroundColor: 'rgba(147, 51, 234, 0.1)',
                    yAxisID: 'y-tertiary',
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5
                },
                {
                    label: 'Respiratory Rate',
                    data: data.respiratoryRate,
                    borderColor: 'rgb(99, 102, 241)',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    yAxisID: 'y-primary',
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    display: false // Using custom legend
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        title: function(context) {
                            return 'Time: ' + context[0].label;
                        },
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                // Add appropriate units
                                if (context.dataset.label.includes('Heart Rate') || context.dataset.label.includes('Respiratory')) {
                                    label += context.parsed.y + ' bpm';
                                } else if (context.dataset.label.includes('Blood Pressure')) {
                                    label += context.parsed.y + ' mmHg';
                                } else if (context.dataset.label.includes('SpO2')) {
                                    label += context.parsed.y + '%';
                                } else if (context.dataset.label.includes('Temperature')) {
                                    label += context.parsed.y + '°C';
                                } else {
                                    label += context.parsed.y;
                                }
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    display: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45
                    }
                },
                'y-primary': {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return value + ' bpm';
                        }
                    }
                },
                'y-secondary': {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false,
                    },
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                },
                'y-tertiary': {
                    type: 'linear',
                    display: false,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false,
                    }
                }
            }
        }
    });
}

function generateVitalsData(timeRange) {
    let labels = [];
    let dataPoints = 0;
    let timeFormat = '';
    
    switch(timeRange) {
        case '1H':
            dataPoints = 12;
            timeFormat = 'HH:mm';
            for (let i = dataPoints - 1; i >= 0; i--) {
                const time = new Date();
                time.setMinutes(time.getMinutes() - (i * 5));
                labels.push(time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }));
            }
            break;
        case '24H':
            dataPoints = 24;
            timeFormat = 'HH:mm';
            for (let i = dataPoints - 1; i >= 0; i--) {
                const time = new Date();
                time.setHours(time.getHours() - i);
                labels.push(time.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }));
            }
            break;
        case '7D':
            dataPoints = 7;
            for (let i = dataPoints - 1; i >= 0; i--) {
                const time = new Date();
                time.setDate(time.getDate() - i);
                labels.push(time.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));
            }
            break;
    }
    
    // Generate realistic vitals data with some variation
    return {
        labels: labels,
        heartRate: generateRealisticData(dataPoints, 70, 85, 78),
        bpSystolic: generateRealisticData(dataPoints, 110, 140, 120),
        bpDiastolic: generateRealisticData(dataPoints, 70, 90, 80),
        spO2: generateRealisticData(dataPoints, 92, 98, 96),
        temperature: generateRealisticData(dataPoints, 36.5, 37.5, 37.1),
        respiratoryRate: generateRealisticData(dataPoints, 14, 20, 16)
    };
}

function generateRealisticData(points, min, max, baseline) {
    const data = [];
    let current = baseline;
    
    for (let i = 0; i < points; i++) {
        // Add some realistic variation
        const change = (Math.random() - 0.5) * (max - min) * 0.1;
        current = Math.max(min, Math.min(max, current + change));
        
        // Add some occasional spikes or drops
        if (Math.random() < 0.1) {
            current = baseline + (Math.random() - 0.5) * (max - min) * 0.3;
        }
        
        data.push(Math.round(current * 10) / 10);
    }
    
    return data;
}

function updateChartTimeRange(range) {
    currentTimeRange = range;
    
    // Update button styles
    document.querySelectorAll('.time-range-btn').forEach(btn => {
        if (btn.dataset.range === range) {
            btn.className = 'time-range-btn px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg';
        } else {
            btn.className = 'time-range-btn px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50';
        }
    });
    
    // Update chart data
    const newData = generateVitalsData(range);
    vitalsChart.data.labels = newData.labels;
    vitalsChart.data.datasets[0].data = newData.heartRate;
    vitalsChart.data.datasets[1].data = newData.bpSystolic;
    vitalsChart.data.datasets[2].data = newData.bpDiastolic;
    vitalsChart.data.datasets[3].data = newData.spO2;
    vitalsChart.data.datasets[4].data = newData.temperature;
    vitalsChart.data.datasets[5].data = newData.respiratoryRate;
    
    vitalsChart.update();
}

function startRealTimeUpdates() {
    // Update chart every 30 seconds for real-time effect
    realTimeInterval = setInterval(() => {
        if (currentTimeRange === '1H') {
            // Add new data point and remove oldest
            addRealTimeDataPoint();
        }
    }, 30000);
}

function addRealTimeDataPoint() {
    const chart = vitalsChart;
    
    // Add new time label
    const now = new Date();
    const timeLabel = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
    
    chart.data.labels.push(timeLabel);
    
    // Add new data points with slight variations from last values
    chart.data.datasets.forEach(dataset => {
        const lastIndex = dataset.data.length - 1;
        const lastValue = dataset.data[lastIndex];
        const variation = (Math.random() - 0.5) * 2; // Small variation
        let newValue = lastValue + variation;
        
        // Keep within realistic bounds
        if (dataset.label.includes('Heart Rate')) {
            newValue = Math.max(60, Math.min(100, newValue));
        } else if (dataset.label.includes('Blood Pressure')) {
            newValue = Math.max(80, Math.min(160, newValue));
        } else if (dataset.label.includes('SpO2')) {
            newValue = Math.max(85, Math.min(100, newValue));
        } else if (dataset.label.includes('Temperature')) {
            newValue = Math.max(36.0, Math.min(38.0, newValue));
        } else if (dataset.label.includes('Respiratory')) {
            newValue = Math.max(12, Math.min(24, newValue));
        }
        
        dataset.data.push(Math.round(newValue * 10) / 10);
        
        // Remove oldest data point if we have too many
        if (dataset.data.length > 12) {
            dataset.data.shift();
        }
    });
    
    // Remove oldest label if we have too many
    if (chart.data.labels.length > 12) {
        chart.data.labels.shift();
    }
    
    chart.update('none'); // Update without animation for smooth real-time effect
}

// Clean up interval when page is unloaded
window.addEventListener('beforeunload', function() {
    if (realTimeInterval) {
        clearInterval(realTimeInterval);
    }
});
</script>
@endpush
