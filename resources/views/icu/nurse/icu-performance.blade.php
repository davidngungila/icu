@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">ICU Performance</h1>
            <p class="text-slate-500 mt-1">Monitor ICU operational metrics and KPIs</p>
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

    <!-- Advanced Performance Controls -->
    <div class="bg-white rounded-xl border border-slate-200/80 p-4">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Period:</label>
                <select id="timePeriod" class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="shift">Current Shift</option>
                    <option value="today" selected>Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="quarter">This Quarter</option>
                    <option value="year">This Year</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Compare:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>Previous Period</option>
                    <option>Same Period Last Year</option>
                    <option>Target/Benchmark</option>
                    <option>National Average</option>
                    <option>Top Quartile</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-slate-700">Department:</label>
                <select class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Departments</option>
                    <option>Medical ICU</option>
                    <option>Surgical ICU</option>
                    <option>Cardiac ICU</option>
                    <option>Neuro ICU</option>
                    <option>Trauma ICU</option>
                </select>
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Generate Report
                </button>
                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Advanced Analytics
                </button>
            </div>
        </div>
    </div>

    <!-- Key Performance Indicators -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Bed Occupancy Rate</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">87.5%</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600 font-medium">+2.3% vs target</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1 1v10a1 1 0 001 1h3"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Average Length of Stay</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">4.2 days</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600 font-medium">-0.8 days vs target</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Readmission Rate</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">8.5%</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-amber-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                        <span class="text-amber-600 font-medium">+0.5% vs target</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Mortality Rate</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">3.2%</p>
                    <div class="flex items-center mt-2 text-sm">
                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="text-emerald-600 font-medium">-0.8% vs target</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Real-time Performance Monitoring -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h3 class="text-lg font-semibold text-slate-900">Real-time Performance Monitoring</h3>
            <p class="text-sm text-slate-500 mt-1">Live ICU performance metrics with AI-powered insights</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Live Performance Dashboard -->
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-4">Current Shift Performance</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Patient Throughput</span>
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-bold text-slate-900">8.2</span>
                                <span class="text-sm text-emerald-600">↑ 12%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Response Time</span>
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-bold text-slate-900">2.3 min</span>
                                <span class="text-sm text-emerald-600">↓ 18%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Resource Utilization</span>
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-bold text-slate-900">91.5%</span>
                                <span class="text-sm text-amber-600">→ 0%</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Quality Score</span>
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-bold text-slate-900">94.8</span>
                                <span class="text-sm text-emerald-600">↑ 2.1</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Predictive Analytics -->
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-4">Predictive Analytics</h4>
                    <div class="space-y-3">
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Admission Forecast</span>
                                <span class="text-sm text-emerald-600">Next 6 hours</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-bold text-slate-900">4-6</span>
                                <span class="text-sm text-slate-600">expected admissions</span>
                            </div>
                        </div>
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Staffing Optimization</span>
                                <span class="text-sm text-amber-600">AI Recommendation</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                Add 2 nurses for upcoming high-acuity admissions
                            </div>
                        </div>
                        <div class="p-3 bg-slate-50 rounded">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">Resource Prediction</span>
                                <span class="text-sm text-blue-600">Next 12 hours</span>
                            </div>
                            <div class="text-sm text-slate-600">
                                Ventilator demand expected to increase by 40%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Analytics Dashboard -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h3 class="text-lg font-semibold text-slate-900">Advanced Analytics Dashboard</h3>
            <p class="text-sm text-slate-500 mt-1">Multi-dimensional performance analysis</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-3">Efficiency Metrics</h4>
                    <canvas id="efficiencyChart" width="300" height="200"></canvas>
                </div>
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-3">Quality Trends</h4>
                    <canvas id="qualityTrendsChart" width="300" height="200"></canvas>
                </div>
                <div class="border border-slate-200 rounded-lg p-4">
                    <h4 class="font-medium text-slate-900 mb-3">Resource Allocation</h4>
                    <canvas id="resourceAllocationChart" width="300" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Bed Occupancy Trend -->
        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h3 class="text-lg font-semibold text-slate-900">Bed Occupancy Trend</h3>
                <p class="text-sm text-slate-500 mt-1">Daily occupancy rate for the past 30 days</p>
            </div>
            <div class="p-6">
                <canvas id="occupancyChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Patient Flow Analysis -->
        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h3 class="text-lg font-semibold text-slate-900">Patient Flow Analysis</h3>
                <p class="text-sm text-slate-500 mt-1">Admissions, discharges, and transfers</p>
            </div>
            <div class="p-6">
                <canvas id="patientFlowChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Staff Performance Metrics -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Staff Performance Metrics</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h4 class="font-medium text-slate-900 mb-4">Nurse-to-Patient Ratio</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Day Shift</span>
                            <span class="text-sm font-medium text-slate-900">1:3</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Night Shift</span>
                            <span class="text-sm font-medium text-slate-900">1:4</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Overall</span>
                            <span class="text-sm font-medium text-emerald-600">1:3.5</span>
                        </div>
                        <div class="mt-2 text-xs text-slate-500">
                            Target: 1:3 | Status: Within Target
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="font-medium text-slate-900 mb-4">Staff Overtime</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">This Week</span>
                            <span class="text-sm font-medium text-slate-900">24.5 hrs</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Last Week</span>
                            <span class="text-sm font-medium text-slate-900">32.8 hrs</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Monthly Avg</span>
                            <span class="text-sm font-medium text-slate-900">28.2 hrs</span>
                        </div>
                        <div class="mt-2 text-xs text-emerald-600">
                            -8.3 hrs vs last week
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="font-medium text-slate-900 mb-4">Response Times</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Code Blue</span>
                            <span class="text-sm font-medium text-slate-900">1.2 min</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Rapid Response</span>
                            <span class="text-sm font-medium text-slate-900">3.5 min</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Stat Orders</span>
                            <span class="text-sm font-medium text-slate-900">8.3 min</span>
                        </div>
                        <div class="mt-2 text-xs text-emerald-600">
                            All within target times
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quality Indicators -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Quality Indicators</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-slate-900 mb-4">Clinical Quality Metrics</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">CLABSI Rate</p>
                                <p class="text-xs text-slate-500">Central Line Associated Bloodstream Infections</p>
                            </div>
                            <div class="text-right ml-4">
                                <span class="text-lg font-bold text-emerald-600">0.8</span>
                                <p class="text-xs text-slate-500">per 1000 line days</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">VAP Rate</p>
                                <p class="text-xs text-slate-500">Ventilator Associated Pneumonia</p>
                            </div>
                            <div class="text-right ml-4">
                                <span class="text-lg font-bold text-amber-600">2.1</span>
                                <p class="text-xs text-slate-500">per 1000 ventilator days</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">CAUTI Rate</p>
                                <p class="text-xs text-slate-500">Catheter Associated UTIs</p>
                            </div>
                            <div class="text-right ml-4">
                                <span class="text-lg font-bold text-emerald-600">1.2</span>
                                <p class="text-xs text-slate-500">per 1000 catheter days</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">Pressure Injury Rate</p>
                                <p class="text-xs text-slate-500">Stage 2+ injuries</p>
                            </div>
                            <div class="text-right ml-4">
                                <span class="text-lg font-bold text-emerald-600">2.8%</span>
                                <p class="text-xs text-slate-500">of patients</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="font-medium text-slate-900 mb-4">Patient Satisfaction</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">Overall Satisfaction</p>
                                <p class="text-xs text-slate-500">Patient survey results</p>
                            </div>
                            <div class="text-right ml-4">
                                <span class="text-lg font-bold text-emerald-600">4.6</span>
                                <p class="text-xs text-slate-500">out of 5.0</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">Communication</p>
                                <p class="text-xs text-slate-500">Staff communication rating</p>
                            </div>
                            <div class="text-right ml-4">
                                <span class="text-lg font-bold text-emerald-600">4.8</span>
                                <p class="text-xs text-slate-500">out of 5.0</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">Pain Management</p>
                                <p class="text-xs text-slate-500">Pain control effectiveness</p>
                            </div>
                            <div class="text-right ml-4">
                                <span class="text-lg font-bold text-amber-600">4.2</span>
                                <p class="text-xs text-slate-500">out of 5.0</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">Family Satisfaction</p>
                                <p class="text-xs text-slate-500">Family survey results</p>
                            </div>
                            <div class="text-right ml-4">
                                <span class="text-lg font-bold text-emerald-600">4.7</span>
                                <p class="text-xs text-slate-500">out of 5.0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Operational Efficiency -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Operational Efficiency</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-slate-50 rounded-lg">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-slate-900">94%</p>
                    <p class="text-sm text-slate-600">Medication Admin Accuracy</p>
                    <p class="text-xs text-emerald-600 mt-1">+2% vs last month</p>
                </div>

                <div class="text-center p-4 bg-slate-50 rounded-lg">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-slate-900">18 min</p>
                    <p class="text-sm text-slate-600">Avg Turnaround Time</p>
                    <p class="text-xs text-emerald-600 mt-1">-5 min vs target</p>
                </div>

                <div class="text-center p-4 bg-slate-50 rounded-lg">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-slate-900">87%</p>
                    <p class="text-sm text-slate-600">Documentation Compliance</p>
                    <p class="text-xs text-amber-600 mt-1">-3% vs target</p>
                </div>

                <div class="text-center p-4 bg-slate-50 rounded-lg">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-slate-900">99.2%</p>
                    <p class="text-sm text-slate-600">Equipment Uptime</p>
                    <p class="text-xs text-emerald-600 mt-1">+0.5% vs last month</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Summary -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Performance Summary</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-slate-900 mb-4">Strengths</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm text-slate-900">Excellent Mortality Rate</p>
                                <p class="text-xs text-slate-600">3.2% vs target 4.0%</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm text-slate-900">Reduced Length of Stay</p>
                                <p class="text-xs text-slate-600">4.2 days vs target 5.0 days</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm text-slate-900">High Staff Satisfaction</p>
                                <p class="text-xs text-slate-600">4.5/5.0 in recent survey</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="font-medium text-slate-900 mb-4">Areas for Improvement</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-amber-500 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm text-slate-900">Readmission Rate</p>
                                <p class="text-xs text-slate-600">8.5% vs target 8.0%</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-amber-500 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm text-slate-900">Documentation Compliance</p>
                                <p class="text-xs text-slate-600">87% vs target 90%</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-amber-500 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm text-slate-900">VAP Prevention</p>
                                <p class="text-xs text-slate-600">2.1 vs target 1.5 per 1000 vent days</p>
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
// Bed Occupancy Trend Chart
const occupancyCtx = document.getElementById('occupancyChart').getContext('2d');
new Chart(occupancyCtx, {
    type: 'line',
    data: {
        labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
        datasets: [{
            label: 'Occupancy Rate',
            data: [85, 87, 86, 88, 87, 89, 87.5],
            borderColor: 'rgb(59, 130, 246)',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: false,
                max: 100,
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    }
                }
            }
        }
    }
});

// Patient Flow Analysis Chart
const patientFlowCtx = document.getElementById('patientFlowChart').getContext('2d');
new Chart(patientFlowCtx, {
    type: 'bar',
    data: {
        labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
        datasets: [
            {
                label: 'Admissions',
                data: [3, 2, 4, 3, 2, 3, 2],
                backgroundColor: 'rgba(16, 185, 129, 0.8)'
            },
            {
                label: 'Discharges',
                data: [2, 3, 2, 4, 3, 2, 3],
                backgroundColor: 'rgba(59, 130, 246, 0.8)'
            },
            {
                label: 'Transfers',
                data: [1, 0, 1, 0, 1, 1, 0],
                backgroundColor: 'rgba(245, 158, 11, 0.8)'
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                stacked: true
            },
            y: {
                stacked: true,
                beginAtZero: true
            }
        }
    }
});
</script>
@endpush
