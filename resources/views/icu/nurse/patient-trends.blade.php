@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Patient Trends</h1>
            <p class="text-slate-500 mt-1">Analyze patient data patterns and trends</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export Report
            </button>
        </div>
    </div>

    <!-- Advanced Analytics Controls -->
    <div class="bg-white rounded-xl border border-slate-200/80 p-4">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Time Range:</label>
                <select id="timeRange" class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="1h">Last Hour</option>
                    <option value="6h">Last 6 Hours</option>
                    <option value="12h">Last 12 Hours</option>
                    <option value="24h" selected>Last 24 Hours</option>
                    <option value="3d">Last 3 Days</option>
                    <option value="7d">Last 7 Days</option>
                    <option value="30d">Last 30 Days</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Patient:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Patients</option>
                    <option>John Smith (P001)</option>
                    <option>Maria Garcia (P002)</option>
                    <option>Robert Johnson (P003)</option>
                    <option>Susan Chen (P004)</option>
                    <option>James Wilson (P005)</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Metric:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Metrics</option>
                    <option>Vital Signs</option>
                    <option>Lab Values</option>
                    <option>Medication Response</option>
                    <option>Activity Levels</option>
                    <option>Pain Scores</option>
                    <option>Neurological Status</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Analysis:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>Trend Analysis</option>
                    <option>Predictive Analytics</option>
                    <option>Comparative Analysis</option>
                    <option>Statistical Summary</option>
                    <option>Anomaly Detection</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.707 0l-6.414-6.414A1 1 0 013 6.586V4z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.707 0l-6.414-6.414A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Export Data
                </button>
                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-1.756.426-1.756 2.924 0 3.35a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37a1.724 1.724 0 00-2.572-1.065c-1.756-.426-1.756-2.924 0-3.35z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Advanced Settings
                </button>
            </div>
        </div>
    </div>

    <!-- Key Trend Indicators -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Avg Heart Rate</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">78</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600">-2 bpm from last week</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Avg Blood Pressure</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">125/82</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-amber-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                        <span class="text-amber-600">+3/2 mmHg from last week</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Avg SpO2</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">94%</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600">+1% from last week</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Avg Temperature</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">37.2°C</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-slate-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                        </svg>
                        <span class="text-slate-600">No change from last week</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Trend Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Vital Signs Trend -->
        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h3 class="text-lg font-semibold text-slate-900">Vital Signs Trend</h3>
                <p class="text-sm text-slate-500 mt-1">7-day average comparison</p>
            </div>
            <div class="p-6">
                <canvas id="vitalSignsChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Patient Acuity Distribution -->
        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h3 class="text-lg font-semibold text-slate-900">Acuity Level Distribution</h3>
                <p class="text-sm text-slate-500 mt-1">Current patient acuity breakdown</p>
            </div>
            <div class="p-6">
                <canvas id="acuityChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Detailed Patient Trends -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Individual Patient Trends</h2>
                <div class="flex items-center space-x-2">
                    <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>All Trends</option>
                        <option>Improving</option>
                        <option>Stable</option>
                        <option>Deteriorating</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Heart Rate</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Blood Pressure</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">SpO2</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Temperature</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Trend</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $patientTrends = [
                            [
                                'patient' => 'John Smith',
                                'patientId' => 'P001',
                                'bed' => 'ICU-001',
                                'heartRate' => ['current' => 78, 'trend' => 'stable', 'change' => 0],
                                'bloodPressure' => ['current' => '120/80', 'trend' => 'stable', 'change' => '0/0'],
                                'spo2' => ['current' => 98, 'trend' => 'stable', 'change' => 0],
                                'temperature' => ['current' => 37.1, 'trend' => 'stable', 'change' => 0],
                                'overallTrend' => 'stable'
                            ],
                            [
                                'patient' => 'Maria Garcia',
                                'patientId' => 'P002',
                                'bed' => 'ICU-002',
                                'heartRate' => ['current' => 95, 'trend' => 'up', 'change' => 8],
                                'bloodPressure' => ['current' => '145/95', 'trend' => 'up', 'change' => '15/10'],
                                'spo2' => ['current' => 82, 'trend' => 'down', 'change' => -8],
                                'temperature' => ['current' => 38.5, 'trend' => 'up', 'change' => 1.2],
                                'overallTrend' => 'deteriorating'
                            ],
                            [
                                'patient' => 'Robert Johnson',
                                'patientId' => 'P003',
                                'bed' => 'ICU-003',
                                'heartRate' => ['current' => 72, 'trend' => 'down', 'change' => -3],
                                'bloodPressure' => ['current' => '118/76', 'trend' => 'down', 'change' => '-5/3'],
                                'spo2' => ['current' => 96, 'trend' => 'stable', 'change' => 0],
                                'temperature' => ['current' => 36.8, 'trend' => 'down', 'change' => -0.2],
                                'overallTrend' => 'improving'
                            ],
                            [
                                'patient' => 'Susan Chen',
                                'patientId' => 'P004',
                                'bed' => 'ICU-004',
                                'heartRate' => ['current' => 88, 'trend' => 'up', 'change' => 5],
                                'bloodPressure' => ['current' => '135/88', 'trend' => 'up', 'change' => '8/5'],
                                'spo2' => ['current' => 91, 'trend' => 'down', 'change' => -3],
                                'temperature' => ['current' => 37.6, 'trend' => 'up', 'change' => 0.4],
                                'overallTrend' => 'warning'
                            ]
                        ];
                    @endphp

                    @foreach($patientTrends as $trend)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-slate-900">{{ $trend['patient'] }}</div>
                                    <div class="text-sm text-slate-500">{{ $trend['patientId'] }} • {{ $trend['bed'] }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-sm text-slate-900 mr-2">{{ $trend['heartRate']['current'] }}</span>
                                    @if($trend['heartRate']['trend'] == 'up')
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                        </svg>
                                    @elseif($trend['heartRate']['trend'] == 'down')
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                        </svg>
                                    @endif
                                    <span class="text-xs text-slate-500 ml-1">({{ $trend['heartRate']['change'] > 0 ? '+' : '' }}{{ $trend['heartRate']['change'] }})</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-sm text-slate-900 mr-2">{{ $trend['bloodPressure']['current'] }}</span>
                                    @if($trend['bloodPressure']['trend'] == 'up')
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                        </svg>
                                    @elseif($trend['bloodPressure']['trend'] == 'down')
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                        </svg>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-sm text-slate-900 mr-2">{{ $trend['spo2']['current'] }}%</span>
                                    @if($trend['spo2']['trend'] == 'up')
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    @elseif($trend['spo2']['trend'] == 'down')
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                        </svg>
                                    @endif
                                    <span class="text-xs text-slate-500 ml-1">({{ $trend['spo2']['change'] > 0 ? '+' : '' }}{{ $trend['spo2']['change'] }})</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-sm text-slate-900 mr-2">{{ $trend['temperature']['current'] }}°C</span>
                                    @if($trend['temperature']['trend'] == 'up')
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                        </svg>
                                    @elseif($trend['temperature']['trend'] == 'down')
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                        </svg>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($trend['overallTrend'] == 'improving') bg-emerald-100 text-emerald-800
                                    @elseif($trend['overallTrend'] == 'deteriorating') bg-red-100 text-red-800
                                    @elseif($trend['overallTrend'] == 'warning') bg-amber-100 text-amber-800
                                    @else bg-slate-100 text-slate-800 @endif">
                                    {{ ucfirst($trend['overallTrend']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-emerald-600 hover:text-emerald-900 mr-3">View Details</button>
                                <button class="text-blue-600 hover:text-blue-900">Set Alert</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Advanced Predictive Analytics -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h3 class="text-lg font-semibold text-slate-900">Predictive Analytics</h3>
            <p class="text-sm text-slate-500 mt-1">AI-powered risk assessment and outcome prediction</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Risk Stratification -->
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-4">Risk Stratification</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-red-800">High Risk Patients</p>
                                <p class="text-xs text-red-700">Require immediate intervention</p>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl font-bold text-red-600">2</span>
                                <p class="text-xs text-red-600">patients</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-amber-50 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-amber-800">Medium Risk Patients</p>
                                <p class="text-xs text-amber-700">Close monitoring required</p>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl font-bold text-amber-600">3</span>
                                <p class="text-xs text-amber-600">patients</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-emerald-50 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-emerald-800">Low Risk Patients</p>
                                <p class="text-xs text-emerald-700">Stable condition</p>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl font-bold text-emerald-600">7</span>
                                <p class="text-xs text-emerald-600">patients</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Predictive Models -->
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-4">Predictive Models</h4>
                    <div class="space-y-3">
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Clinical Deterioration</span>
                                <span class="text-sm text-emerald-600">94% Accuracy</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: 94%"></div>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">Predicts patient deterioration within 6 hours</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Readmission Risk</span>
                                <span class="text-sm text-emerald-600">87% Accuracy</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: 87%"></div>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">30-day readmission probability prediction</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Length of Stay</span>
                                <span class="text-sm text-amber-600">76% Accuracy</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2">
                                <div class="bg-amber-500 h-2 rounded-full" style="width: 76%"></div>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">Predicted ICU stay duration</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Trend Analysis -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h3 class="text-lg font-semibold text-slate-900">Advanced Trend Analysis</h3>
            <p class="text-sm text-slate-500 mt-1">Multi-dimensional patient data analysis</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-3">Vital Sign Patterns</h4>
                    <canvas id="vitalPatternsChart" width="300" height="200"></canvas>
                </div>
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-3">Medication Response</h4>
                    <canvas id="medicationResponseChart" width="300" height="200"></canvas>
                </div>
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-3">Recovery Trajectory</h4>
                    <canvas id="recoveryTrajectoryChart" width="300" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h3 class="text-lg font-semibold text-slate-900">Key Insights</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-amber-500 rounded-full mt-2"></div>
                        <div>
                            <p class="text-sm font-medium text-slate-900">Maria Garcia showing deterioration</p>
                            <p class="text-sm text-slate-600">Multiple vital signs trending upward over past 48 hours. Consider physician review.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2"></div>
                        <div>
                            <p class="text-sm font-medium text-slate-900">Robert Johnson improving</p>
                            <p class="text-sm text-slate-600">All vital signs trending downward toward normal ranges. Continue current treatment plan.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                        <div>
                            <p class="text-sm font-medium text-slate-900">Unit average stable</p>
                            <p class="text-sm text-slate-600">Overall unit vitals within normal parameters. No concerning patterns detected.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h3 class="text-lg font-semibold text-slate-900">Predictive Alerts</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-red-800">High Risk Prediction</p>
                                <p class="text-sm text-red-700">Maria Garcia (P002) - 85% probability of clinical deterioration within 24 hours based on current trend patterns.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-amber-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-amber-800">Medication Response Alert</p>
                                <p class="text-sm text-amber-700">Susan Chen (P004) - Suboptimal response to current antihypertensive regimen. Consider dose adjustment.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Enhanced Patient Trends Analytics
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all charts
    initializeCharts();
    
    // Setup real-time updates
    setupRealTimeUpdates();
    
    // Setup advanced analytics
    setupAdvancedAnalytics();
});

function initializeCharts() {
    // Vital Signs Trend Chart
    const vitalSignsCtx = document.getElementById('vitalSignsChart');
    if (vitalSignsCtx) {
        new Chart(vitalSignsCtx, {
            type: 'line',
            data: {
                labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
                datasets: [
                    {
                        label: 'Heart Rate',
                        data: [82, 80, 79, 78, 77, 78, 78],
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'SpO2',
                        data: [93, 94, 93, 94, 95, 94, 94],
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: { y: { beginAtZero: false } }
            }
        });
    }

    // Acuity Distribution Chart
    const acuityCtx = document.getElementById('acuityChart');
    if (acuityCtx) {
        new Chart(acuityCtx, {
            type: 'doughnut',
            data: {
                labels: ['Critical', 'High', 'Medium', 'Low'],
                datasets: [{
                    data: [2, 3, 5, 2],
                    backgroundColor: [
                        'rgb(239, 68, 68)',
                        'rgb(245, 158, 11)',
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    // Advanced Pattern Charts
    initializeAdvancedCharts();
}

function initializeAdvancedCharts() {
    // Vital Patterns Chart
    const vitalPatternsCtx = document.getElementById('vitalPatternsChart');
    if (vitalPatternsCtx) {
        new Chart(vitalPatternsCtx, {
            type: 'radar',
            data: {
                labels: ['Stability', 'Consistency', 'Response to Treatment', 'Recovery Rate', 'Variability'],
                datasets: [{
                    label: 'Current Week',
                    data: [85, 92, 78, 88, 75],
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.2)'
                }, {
                    label: 'Previous Week',
                    data: [78, 88, 72, 82, 70],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { r: { min: 0, max: 100 } }
            }
        });
    }

    // Medication Response Chart
    const medicationResponseCtx = document.getElementById('medicationResponseChart');
    if (medicationResponseCtx) {
        new Chart(medicationResponseCtx, {
            type: 'bar',
            data: {
                labels: ['Pain Management', 'Antibiotics', 'Anticoagulants', 'Sedation', 'Vasopressors'],
                datasets: [{
                    label: 'Response Rate (%)',
                    data: [92, 88, 95, 85, 90],
                    backgroundColor: 'rgba(16, 185, 129, 0.8)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, max: 100 } }
            }
        });
    }

    // Recovery Trajectory Chart
    const recoveryTrajectoryCtx = document.getElementById('recoveryTrajectoryChart');
    if (recoveryTrajectoryCtx) {
        new Chart(recoveryTrajectoryCtx, {
            type: 'line',
            data: {
                labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
                datasets: [{
                    label: 'Expected Recovery',
                    data: [60, 70, 78, 85, 90, 93, 95],
                    borderColor: 'rgb(59, 130, 246)',
                    borderDash: [5, 5],
                    backgroundColor: 'rgba(59, 130, 246, 0.1)'
                }, {
                    label: 'Actual Recovery',
                    data: [55, 68, 75, 82, 88, 91, 94],
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: false, max: 100 } }
            }
        });
    }
}

function setupRealTimeUpdates() {
    // Simulate real-time vital signs updates
    setInterval(updateVitalSigns, 5000);
    
    // Setup time range selector
    const timeRange = document.getElementById('timeRange');
    if (timeRange) {
        timeRange.addEventListener('change', function() {
            updateDataForTimeRange(this.value);
        });
    }
}

function updateVitalSigns() {
    // Simulate real-time vital signs updates
    const vitalSigns = document.querySelectorAll('.vital-signs');
    vitalSigns.forEach(sign => {
        const currentValue = parseInt(sign.textContent);
        const change = (Math.random() - 0.5) * 2;
        const newValue = Math.max(60, Math.min(100, currentValue + change));
        sign.textContent = newValue.toFixed(0);
        
        // Update color based on value
        if (newValue < 70) {
            sign.className = 'text-lg font-bold text-red-600';
        } else if (newValue > 85) {
            sign.className = 'text-lg font-bold text-emerald-600';
        } else {
            sign.className = 'text-lg font-bold text-amber-600';
        }
    });
}

function updateDataForTimeRange(range) {
    // Update charts based on selected time range
    console.log('Updating data for range:', range);
    
    // Show loading state
    const charts = document.querySelectorAll('canvas');
    charts.forEach(chart => {
        chart.style.opacity = '0.5';
    });
    
    // Simulate data loading
    setTimeout(() => {
        charts.forEach(chart => {
            chart.style.opacity = '1';
        });
        
        // Update time range display
        const timeRangeDisplay = document.getElementById('timeRangeDisplay');
        if (timeRangeDisplay) {
            timeRangeDisplay.textContent = `Showing data for: ${range}`;
        }
    }, 1000);
}

function setupAdvancedAnalytics() {
    // Setup predictive analytics
    const analysisSelect = document.querySelector('select[placeholder*="Analysis"]');
    if (analysisSelect) {
        analysisSelect.addEventListener('change', function() {
            const analysisType = this.value;
            updateAnalysisView(analysisType);
        });
    }
}

function updateAnalysisView(analysisType) {
    // Update the view based on selected analysis type
    const analysisContainer = document.getElementById('advancedAnalysis');
    if (analysisContainer) {
        analysisContainer.innerHTML = `
            <div class="p-4 bg-slate-50 rounded">
                <h4 class="font-medium text-slate-900 mb-2">${analysisType} Analysis</h4>
                <div class="text-sm text-slate-600">
                    <p>Advanced ${analysisType.toLowerCase()} analysis is being processed...</p>
                    <div class="mt-2">
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full animate-pulse" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
}

// Export functionality
function exportData() {
    const data = {
        timestamp: new Date().toISOString(),
        timeRange: document.getElementById('timeRange')?.value || '7d',
        patient: document.querySelector('select[placeholder*="Patient"]')?.value || 'All Patients',
        metric: document.querySelector('select[placeholder*="Metric"]')?.value || 'All Metrics',
        vitalSigns: Array.from(document.querySelectorAll('.vital-signs')).map(el => el.textContent),
        trends: generateTrendReport()
    };
    
    // Create and download CSV
    const csv = convertToCSV(data);
    downloadCSV(csv, `patient-trends-${new Date().toISOString().split('T')[0]}.csv`);
}

function generateTrendReport() {
    // Generate comprehensive trend report
    return {
        heartRate: { current: 78, trend: 'stable', change: 0 },
        bloodPressure: { current: '125/82', trend: 'up', change: '+3/2' },
        spo2: { current: 94, trend: 'stable', change: 0 },
        temperature: { current: 37.2, trend: 'stable', change: 0 }
    };
}

function convertToCSV(data) {
    // Convert data to CSV format
    const headers = ['Timestamp', 'Time Range', 'Patient', 'Metric', 'Heart Rate', 'Blood Pressure', 'SpO2', 'Temperature', 'Trend'];
    const rows = [headers.join(',')];
    
    // Add data rows
    rows.push(`${data.timestamp},${data.timeRange},${data.patient},${data.metric},${data.trends.heartRate.current},${data.trends.bloodPressure.current},${data.trends.spo2.current},${data.trends.temperature.current},${data.trends.heartRate.trend}`);
    
    return rows.join('\n');
}

function downloadCSV(csv, filename) {
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    a.click();
    window.URL.revokeObjectURL(url);
}
</script>
@endpush
