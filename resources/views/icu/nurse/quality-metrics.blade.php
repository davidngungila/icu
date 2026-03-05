@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Quality Metrics</h1>
            <p class="text-slate-500 mt-1">Track and analyze quality improvement indicators</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Quality Dashboard
            </button>
        </div>
    </div>

    <!-- Metrics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Quality Score</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">94.2</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600 font-medium">+3.1 points</span>
                    </div>
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
                    <p class="text-sm text-slate-500">Patient Satisfaction</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">4.6/5.0</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600 font-medium">+0.2 vs last month</span>
                    </div>
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
                    <p class="text-sm text-slate-500">Clinical Outcomes</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">91.8%</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-amber-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                        <span class="text-amber-600 font-medium">-1.2% vs target</span>
                    </div>
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
                    <p class="text-sm text-slate-500">Process Efficiency</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">96.5%</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600 font-medium">+2.8% vs target</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Quality Analytics -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h3 class="text-lg font-semibold text-slate-900">AI-Powered Quality Analytics</h3>
            <p class="text-sm text-slate-500 mt-1">Machine learning insights and predictive quality monitoring</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Quality Trend Analysis -->
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-4">Quality Trend Analysis</h4>
                    <div class="space-y-3">
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Overall Quality Trend</span>
                                <span class="text-sm text-emerald-600">Improving</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                <p class="mb-2">Quality score has <strong class="text-emerald-600">increased by 8.3%</strong> over the past 90 days</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• Clinical outcomes: +12.5%</li>
                                    <li>• Patient safety: +6.2%</li>
                                    <li>• Process efficiency: +4.8%</li>
                                    <li>• Patient satisfaction: +9.7%</li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Predicted Quality Score</span>
                                <span class="text-sm text-blue-600">Next Quarter</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                <p class="mb-2">AI model predicts <strong class="text-blue-600">95.7</strong> quality score</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• 85% confidence level</li>
                                    <li>• Based on current trends and interventions</li>
                                    <li>• Key drivers: staff training, process optimization</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Predictive Quality Insights -->
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-4">Predictive Quality Insights</h4>
                    <div class="space-y-3">
                        <div class="p-3 bg-amber-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Quality Risk Factors</span>
                                <span class="text-sm text-amber-600">3 Identified</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                <p class="mb-2">Potential quality concerns:</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• Staffing shortages on night shift (risk: high)</li>
                                    <li>• Equipment downtime increasing (risk: medium)</li>
                                    <li>• Documentation delays (risk: low)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-3 bg-blue-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Improvement Opportunities</span>
                                <span class="text-sm text-blue-600">AI-Generated</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                <p class="mb-2">Recommended focus areas:</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• Enhance medication safety protocols</li>
                                    <li>• Implement real-time quality monitoring</li>
                                    <li>• Standardize handoff procedures</li>
                                    <li>• Optimize staff scheduling algorithms</li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-3 bg-emerald-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Success Predictors</span>
                                <span class="text-sm text-emerald-600">Positive</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                <p class="mb-2">Factors driving quality improvement:</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• New quality management system</li>
                                    <li>• Enhanced staff training programs</li>
                                    <li>• Improved patient communication</li>
                                    <li>• Real-time monitoring dashboards</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Quality Metrics -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h3 class="text-lg font-semibold text-slate-900">Advanced Quality Metrics</h3>
            <p class="text-sm text-slate-500 mt-1">Comprehensive quality measurement with real-time tracking</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $advancedMetrics = [
                        [
                            'metric' => 'Clinical Outcomes',
                            'score' => 91.8,
                            'target' => 90.0,
                            'trend' => 'improving',
                            'components' => ['Mortality Rate', 'Complication Rate', 'Readmission Rate', 'Recovery Time'],
                            'insight' => 'Exceeding targets across all clinical outcome measures'
                        ],
                        [
                            'metric' => 'Patient Safety',
                            'score' => 96.2,
                            'target' => 95.0,
                            'trend' => 'stable',
                            'components' => ['Fall Prevention', 'Medication Safety', 'Infection Control', 'Pressure Injury Prevention'],
                            'insight' => 'Consistently meeting safety benchmarks with room for improvement'
                        ],
                        [
                            'metric' => 'Process Efficiency',
                            'score' => 88.5,
                            'target' => 85.0,
                            'trend' => 'improving',
                            'components' => ['Documentation Timeliness', 'Order Response Time', 'Bed Turnover', 'Resource Utilization'],
                            'insight' => 'Good efficiency gains with focus on documentation compliance'
                        ],
                        [
                            'metric' => 'Staff Performance',
                            'score' => 94.5,
                            'target' => 92.0,
                            'trend' => 'improving',
                            'components' => ['Competency Assessment', 'Training Completion', 'Satisfaction Scores', 'Productivity Metrics'],
                            'insight' => 'Strong staff performance with excellent training outcomes'
                        ],
                        [
                            'metric' => 'Patient Experience',
                            'score' => 92.7,
                            'target' => 90.0,
                            'trend' => 'improving',
                            'components' => ['Overall Satisfaction', 'Communication Quality', 'Pain Management', 'Family Engagement'],
                            'insight' => 'High patient satisfaction with continuous improvement focus'
                        ],
                        [
                            'metric' => 'Resource Management',
                            'score' => 89.3,
                            'target' => 88.0,
                            'trend' => 'stable',
                            'components' => ['Equipment Utilization', 'Supply Management', 'Bed Management', 'Staff Allocation'],
                            'insight' => 'Efficient resource utilization with optimization opportunities'
                        ],
                        [
                            'metric' => 'Regulatory Compliance',
                            'score' => 97.1,
                            'target' => 95.0,
                            'trend' => 'stable',
                            'components' => ['Documentation Standards', 'Safety Protocols', 'Privacy Compliance', 'Quality Measures'],
                            'insight' => 'Excellent regulatory compliance with continuous monitoring'
                        ],
                        [
                            'metric' => 'Innovation & Improvement',
                            'score' => 85.6,
                            'target' => 80.0,
                            'trend' => 'improving',
                            'components' => ['Process Innovation', 'Technology Adoption', 'Best Practice Implementation', 'Continuous Improvement'],
                            'insight' => 'Strong innovation culture with successful improvement initiatives'
                        ]
                    ];
                @endphp

                @foreach($advancedMetrics as $metric)
                    <div class="border border-slate-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h5 class="text-sm font-medium text-slate-900">{{ $metric['metric'] }}</h5>
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-bold
                                    @if($metric['score'] >= 95) text-emerald-600
                                    @elseif($metric['score'] >= 85) text-amber-600
                                    @else text-red-600 @endif">{{ $metric['score'] }}</span>
                                <div class="flex items-center space-x-1">
                                    @if($metric['trend'] == 'improving')
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    @elseif($metric['trend'] == 'declining')
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                        </svg>
                                    @endif
                                    <span class="text-xs text-slate-500">Target: {{ $metric['target'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2 mb-3">
                            <div class="bg-emerald-500 h-2 rounded-full transition-all duration-300" style="width: {{ $metric['score'] }}%"></div>
                        </div>
                        <div class="text-xs text-slate-600 mb-2">
                            <p class="font-medium text-slate-900">Components:</p>
                            <p>{{ implode(', ', $metric['components']) }}</p>
                        </div>
                        <div class="p-2 bg-slate-50 rounded text-xs text-slate-600">
                            <p class="font-medium text-slate-900">AI Insight:</p>
                            <p>{{ $metric['insight'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200/80 p-4">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Time Period:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="shift">Current Shift</option>
                    <option value="today">Today</option>
                    <option value="week" selected>This Week</option>
                    <option value="month">This Month</option>
                    <option value="quarter">This Quarter</option>
                    <option value="year">This Year</option>
                    <option value="ytd">Year to Date</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Metric Type:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Metrics</option>
                    <option>Clinical Outcomes</option>
                    <option>Patient Safety</option>
                    <option>Process Efficiency</option>
                    <option>Staff Performance</option>
                    <option>Resource Utilization</option>
                    <option>Patient Satisfaction</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Benchmark:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>Internal Target</option>
                    <option>National Average</option>
                    <option>Top Quartile</option>
                    <option>Best Practice</option>
                    <option>Regulatory Standard</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Dashboard
                </button>
                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Advanced Analytics
                </button>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Clinical Quality Indicators -->
        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h3 class="text-lg font-semibold text-slate-900">Clinical Quality Indicators</h3>
                <p class="text-sm text-slate-500 mt-1">Patient care quality metrics</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @php
                        $clinicalMetrics = [
                            [
                                'metric' => 'Pressure Injury Prevention',
                                'current' => 2.8,
                                'target' => 3.0,
                                'unit' => '%',
                                'status' => 'meeting',
                                'trend' => 'improving'
                            ],
                            [
                                'metric' => 'Fall Prevention',
                                'current' => 0.8,
                                'target' => 1.0,
                                'unit' => '%',
                                'status' => 'exceeding',
                                'trend' => 'stable'
                            ],
                            [
                                'metric' => 'Pain Management',
                                'current' => 4.2,
                                'target' => 4.0,
                                'unit' => '/5.0',
                                'status' => 'below',
                                'trend' => 'declining'
                            ],
                            [
                                'metric' => 'Medication Error Rate',
                                'current' => 0.6,
                                'target' => 1.0,
                                'unit' => '%',
                                'status' => 'exceeding',
                                'trend' => 'improving'
                            ],
                            [
                                'metric' => 'Readmission Rate',
                                'current' => 8.5,
                                'target' => 8.0,
                                'unit' => '%',
                                'status' => 'below',
                                'trend' => 'stable'
                            ]
                        ];
                    @endphp

                    @foreach($clinicalMetrics as $metric)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">{{ $metric['metric'] }}</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-lg font-bold
                                        @if($metric['status'] == 'exceeding') text-emerald-600
                                        @elseif($metric['status'] == 'below') text-amber-600
                                        @else text-slate-900 @endif">{{ $metric['current'] }}{{ $metric['unit'] }}</span>
                                    <span class="text-sm text-slate-500 ml-2">Target: {{ $metric['target'] }}{{ $metric['unit'] }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($metric['trend'] == 'improving')
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                @elseif($metric['trend'] == 'declining')
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                    </svg>
                                @endif
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                    @if($metric['status'] == 'exceeding') bg-emerald-100 text-emerald-800
                                    @elseif($metric['status'] == 'below') bg-amber-100 text-amber-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($metric['status']) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Process Quality Indicators -->
        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h3 class="text-lg font-semibold text-slate-900">Process Quality Indicators</h3>
                <p class="text-sm text-slate-500 mt-1">Operational efficiency metrics</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @php
                        $processMetrics = [
                            [
                                'metric' => 'Documentation Timeliness',
                                'current' => 94,
                                'target' => 90,
                                'unit' => '%',
                                'status' => 'exceeding',
                                'trend' => 'improving'
                            ],
                            [
                                'metric' => 'Handoff Compliance',
                                'current' => 88,
                                'target' => 95,
                                'unit' => '%',
                                'status' => 'below',
                                'trend' => 'stable'
                            ],
                            [
                                'metric' => 'Order Response Time',
                                'current' => 8.3,
                                'target' => 10.0,
                                'unit' => 'min',
                                'status' => 'exceeding',
                                'trend' => 'improving'
                            ],
                            [
                                'metric' => 'Bed Turnover Time',
                                'current' => 45,
                                'target' => 60,
                                'unit' => 'min',
                                'status' => 'exceeding',
                                'trend' => 'stable'
                            ],
                            [
                                'metric' => 'Equipment Availability',
                                'current' => 98.5,
                                'target' => 95,
                                'unit' => '%',
                                'status' => 'exceeding',
                                'trend' => 'stable'
                            ]
                        ];
                    @endphp

                    @foreach($processMetrics as $metric)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">{{ $metric['metric'] }}</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-lg font-bold
                                        @if($metric['status'] == 'exceeding') text-emerald-600
                                        @elseif($metric['status'] == 'below') text-amber-600
                                        @else text-slate-900 @endif">{{ $metric['current'] }}{{ $metric['unit'] }}</span>
                                    <span class="text-sm text-slate-500 ml-2">Target: {{ $metric['target'] }}{{ $metric['unit'] }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($metric['trend'] == 'improving')
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                @elseif($metric['trend'] == 'declining')
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"></path>
                                    </svg>
                                @endif
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                    @if($metric['status'] == 'exceeding') bg-emerald-100 text-emerald-800
                                    @elseif($metric['status'] == 'below') bg-amber-100 text-amber-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($metric['status']) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Quality Trends Chart -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h3 class="text-lg font-semibold text-slate-900">Quality Trends</h3>
            <p class="text-sm text-slate-500 mt-1">6-month quality score progression</p>
        </div>
        <div class="p-6">
            <canvas id="qualityTrendsChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Improvement Initiatives -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Quality Improvement Initiatives</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @php
                    $initiatives = [
                        [
                            'title' => 'Reduce CLABSI Rate by 50%',
                            'description' => 'Implement enhanced central line care bundle',
                            'status' => 'in-progress',
                            'progress' => 65,
                            'targetDate' => '2024-12-31',
                            'owner' => 'Infection Control Team',
                            'impact' => 'high'
                        ],
                        [
                            'title' => 'Improve Handoff Communication',
                            'description' => 'Standardize SBAR process across all shifts',
                            'status' => 'in-progress',
                            'progress' => 40,
                            'targetDate' => '2024-12-15',
                            'owner' => 'Clinical Nurse Specialist',
                            'impact' => 'medium'
                        ],
                        [
                            'title' => 'Enhance Pain Management',
                            'description' => 'Implement comprehensive pain assessment protocol',
                            'status' => 'completed',
                            'progress' => 100,
                            'targetDate' => '2024-11-30',
                            'owner' => 'Pain Management Team',
                            'impact' => 'high'
                        ],
                        [
                            'title' => 'Reduce Medication Errors',
                            'description' => 'Implement barcode scanning for all medications',
                            'status' => 'planning',
                            'progress' => 10,
                            'targetDate' => '2025-01-31',
                            'owner' => 'Pharmacy Director',
                            'impact' => 'critical'
                        ]
                    ];
                @endphp

                @foreach($initiatives as $initiative)
                    <div class="border border-slate-200 rounded-lg p-4">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h4 class="font-medium text-slate-900">{{ $initiative['title'] }}</h4>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($initiative['status'] == 'completed') bg-emerald-100 text-emerald-800
                                        @elseif($initiative['status'] == 'in-progress') bg-amber-100 text-amber-800
                                        @elseif($initiative['status'] == 'planning') bg-blue-100 text-blue-800
                                        @else bg-slate-100 text-slate-800 @endif">
                                        {{ ucfirst(str_replace('-', ' ', $initiative['status'])) }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($initiative['impact'] == 'critical') bg-red-100 text-red-800
                                        @elseif($initiative['impact'] == 'high') bg-amber-100 text-amber-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($initiative['impact']) }} Impact
                                    </span>
                                </div>
                                <p class="text-sm text-slate-600">{{ $initiative['description'] }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3 text-sm">
                            <div>
                                <span class="text-slate-500">Owner:</span>
                                <span class="ml-2 text-slate-900">{{ $initiative['owner'] }}</span>
                            </div>
                            <div>
                                <span class="text-slate-500">Target:</span>
                                <span class="ml-2 text-slate-900">{{ $initiative['targetDate'] }}</span>
                            </div>
                            <div>
                                <span class="text-slate-500">Progress:</span>
                                <span class="ml-2 text-slate-900">{{ $initiative['progress'] }}%</span>
                            </div>
                        </div>

                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full transition-all duration-300" style="width: {{ $initiative['progress'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Benchmark Comparison -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Benchmark Comparison</h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Metric</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Our ICU</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">National Average</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Top Quartile</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Performance</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @php
                            $benchmarks = [
                                [
                                    'metric' => 'Mortality Rate',
                                    'ourValue' => '3.2%',
                                    'nationalAvg' => '4.5%',
                                    'topQuartile' => '2.8%',
                                    'performance' => 'excellent'
                                ],
                                [
                                    'metric' => 'Length of Stay',
                                    'ourValue' => '4.2 days',
                                    'nationalAvg' => '5.1 days',
                                    'topQuartile' => '3.8 days',
                                    'performance' => 'excellent'
                                ],
                                [
                                    'metric' => 'Readmission Rate',
                                    'ourValue' => '8.5%',
                                    'nationalAvg' => '12.3%',
                                    'topQuartile' => '7.2%',
                                    'performance' => 'good'
                                ],
                                [
                                    'metric' => 'Patient Satisfaction',
                                    'ourValue' => '4.6/5.0',
                                    'nationalAvg' => '4.2/5.0',
                                    'topQuartile' => '4.7/5.0',
                                    'performance' => 'good'
                                ],
                                [
                                    'metric' => 'Staff Satisfaction',
                                    'ourValue' => '4.5/5.0',
                                    'nationalAvg' => '4.1/5.0',
                                    'topQuartile' => '4.6/5.0',
                                    'performance' => 'excellent'
                                ]
                            ];
                        @endphp

                        @foreach($benchmarks as $benchmark)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                    {{ $benchmark['metric'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                    {{ $benchmark['ourValue'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                    {{ $benchmark['nationalAvg'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                    {{ $benchmark['topQuartile'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($benchmark['performance'] == 'excellent') bg-emerald-100 text-emerald-800
                                        @elseif($benchmark['performance'] == 'good') bg-blue-100 text-blue-800
                                        @elseif($benchmark['performance'] == 'average') bg-amber-100 text-amber-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($benchmark['performance']) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Quality Trends Chart
const qualityTrendsCtx = document.getElementById('qualityTrendsChart').getContext('2d');
new Chart(qualityTrendsCtx, {
    type: 'line',
    data: {
        labels: ['July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [
            {
                label: 'Quality Score',
                data: [89.2, 90.1, 91.5, 92.8, 91.1, 94.2],
                borderColor: 'rgb(16, 185, 129)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true
            },
            {
                label: 'Patient Satisfaction',
                data: [4.2, 4.3, 4.4, 4.5, 4.4, 4.6],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: false,
                max: 100
            }
        }
    }
});
</script>
@endpush
