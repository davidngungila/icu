@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Record Observations</h1>
            <p class="text-slate-500 mt-1">Document patient assessments and clinical observations</p>
        </div>
        <div class="flex items-center space-x-3">
            <select class="px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option>Select Patient</option>
                <option>John Smith (P001) - ICU-001</option>
                <option>Maria Garcia (P002) - ICU-002</option>
                <option>Robert Johnson (P003) - ICU-003</option>
                <option>Susan Chen (P004) - ICU-004</option>
            </select>
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Save Observation
            </button>
        </div>
    </div>

    <!-- Patient Selection Alert -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1">
                <p class="text-sm font-medium text-blue-800">Select a patient to record observations</p>
                <p class="text-sm text-blue-600 mt-1">Choose from the dropdown menu or search for a patient by name or ID</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Observation Form -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Patient Information -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Patient Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Patient Name</label>
                        <input type="text" value="John Smith" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Patient ID</label>
                        <input type="text" value="P001" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Bed</label>
                        <input type="text" value="ICU-001" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Date/Time</label>
                        <input type="datetime-local" value="{{ date('Y-m-d\TH:i') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                </div>
            </div>

            <!-- Neurological Assessment -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Neurological Assessment</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Glasgow Coma Scale (GCS)</label>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs text-slate-600 mb-1">Eye Opening (E)</label>
                                <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="4">4 - Spontaneous</option>
                                    <option value="3">3 - To Speech</option>
                                    <option value="2">2 - To Pain</option>
                                    <option value="1">1 - None</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-600 mb-1">Verbal Response (V)</label>
                                <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="5">5 - Oriented</option>
                                    <option value="4">4 - Confused</option>
                                    <option value="3">3 - Inappropriate Words</option>
                                    <option value="2">2 - Incomprehensible Sounds</option>
                                    <option value="1">1 - None</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-600 mb-1">Motor Response (M)</label>
                                <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="6">6 - Obeys Commands</option>
                                    <option value="5">5 - Localizes Pain</option>
                                    <option value="4">4 - Withdraws from Pain</option>
                                    <option value="3">3 - Abnormal Flexion</option>
                                    <option value="2">2 - Abnormal Extension</option>
                                    <option value="1">1 - None</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <span class="text-sm text-slate-600">Total GCS: </span>
                            <span class="font-semibold text-emerald-600">15/15</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Pupil Response</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-slate-600 mb-1">Right Pupil</label>
                                <div class="flex space-x-2">
                                    <select class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                        <option>3mm</option>
                                        <option>4mm</option>
                                        <option>5mm</option>
                                        <option>6mm</option>
                                        <option>7mm</option>
                                    </select>
                                    <select class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                        <option>Brisk</option>
                                        <option>Sluggish</option>
                                        <option>Fixed</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-600 mb-1">Left Pupil</label>
                                <div class="flex space-x-2">
                                    <select class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                        <option>3mm</option>
                                        <option>4mm</option>
                                        <option>5mm</option>
                                        <option>6mm</option>
                                        <option>7mm</option>
                                    </select>
                                    <select class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                        <option>Brisk</option>
                                        <option>Sluggish</option>
                                        <option>Fixed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Level of Consciousness</label>
                        <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option>Alert and Oriented</option>
                            <option>Alert but Confused</option>
                            <option>Lethargic</option>
                            <option>Stuporous</option>
                            <option>Comatose</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Cardiovascular Assessment -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Cardiovascular Assessment</h2>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Heart Rate</label>
                            <div class="flex space-x-2">
                                <input type="number" value="78" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <span class="flex items-center text-sm text-slate-600">bpm</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Blood Pressure</label>
                            <div class="flex space-x-2">
                                <input type="number" value="120" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <span class="flex items-center text-sm text-slate-600">/</span>
                                <input type="number" value="80" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <span class="flex items-center text-sm text-slate-600">mmHg</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Heart Sounds</label>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">S1 Present</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">S2 Present</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">S3 Present</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">S4 Present</span>
                                </label>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-600 mb-1">Murmurs</label>
                                <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option>None</option>
                                    <option>Grade 1/6</option>
                                    <option>Grade 2/6</option>
                                    <option>Grade 3/6</option>
                                    <option>Grade 4/6</option>
                                    <option>Grade 5/6</option>
                                    <option>Grade 6/6</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Peripheral Pulses</label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Radial +2</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Dorsalis Pedis +2</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Posterior Tibial +2</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">Carotid +2</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Capillary Refill</label>
                        <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option>&lt; 2 seconds</option>
                            <option>2-3 seconds</option>
                            <option>&gt; 3 seconds</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Respiratory Assessment -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Respiratory Assessment</h2>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Respiratory Rate</label>
                            <div class="flex space-x-2">
                                <input type="number" value="16" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <span class="flex items-center text-sm text-slate-600">breaths/min</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Oxygen Saturation</label>
                            <div class="flex space-x-2">
                                <input type="number" value="98" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <span class="flex items-center text-sm text-slate-600">%</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Breath Sounds</label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">RUL - Clear</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">RML - Clear</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">RLL - Clear</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">LUL - Clear</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">LML - Clear</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-slate-700">LLL - Clear</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Respiratory Pattern</label>
                        <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option>Regular</option>
                            <option>Irregular</option>
                            <option>Cheyne-Stokes</option>
                            <option>Kussmaul</option>
                            <option>Biot's</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Oxygen Therapy</label>
                        <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option>Room Air</option>
                            <option>Nasal Cannula 2L</option>
                            <option>Nasal Cannula 4L</option>
                            <option>Venturi Mask 24%</option>
                            <option>Venturi Mask 28%</option>
                            <option>Non-rebreather Mask</option>
                            <option>Mechanical Ventilation</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- General Assessment -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">General Assessment</h2>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Temperature</label>
                            <div class="flex space-x-2">
                                <input type="number" value="37.1" step="0.1" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <span class="flex items-center text-sm text-slate-600">°C</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Pain Score</label>
                            <div class="flex space-x-2">
                                <input type="number" value="2" min="0" max="10" class="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <span class="flex items-center text-sm text-slate-600">/10</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Skin Assessment</label>
                        <div class="space-y-2">
                            <div class="grid grid-cols-2 gap-2">
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">Warm</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">Dry</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">Cool</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">Clammy</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">Diaphoretic</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-slate-700">Cyanotic</span>
                                </label>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-600 mb-1">Pressure Injuries</label>
                                <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option>None</option>
                                    <option>Stage 1</option>
                                    <option>Stage 2</option>
                                    <option>Stage 3</option>
                                    <option>Stage 4</option>
                                    <option>Unstageable</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nutrition/Hydration</label>
                        <div class="space-y-2">
                            <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <option>NPO</option>
                                <option>Clear Liquids</option>
                                <option>Full Liquids</option>
                                <option>Soft Diet</option>
                                <option>Regular Diet</option>
                            </select>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs text-slate-600 mb-1">Last Oral Intake</label>
                                    <input type="datetime-local" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-600 mb-1">IV Fluid Rate</label>
                                    <input type="text" placeholder="e.g., 100 mL/hr" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clinical Notes -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Clinical Notes</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Subjective Assessment</label>
                        <textarea rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Patient reports, complaints, comfort level..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Objective Assessment</label>
                        <textarea rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Clinical findings, observations, measurements..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nursing Interventions</label>
                        <textarea rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Interventions performed, medications given, treatments..."></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Patient Response</label>
                        <textarea rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Patient's response to interventions, changes in condition..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Reference -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Quick Reference</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-slate-50 rounded-lg">
                        <p class="text-sm font-medium text-slate-900">GCS Score</p>
                        <p class="text-xs text-slate-600 mt-1">13-15 = Mild injury</p>
                        <p class="text-xs text-slate-600">9-12 = Moderate injury</p>
                        <p class="text-xs text-slate-600">3-8 = Severe injury</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-lg">
                        <p class="text-sm font-medium text-slate-900">Pain Scale</p>
                        <p class="text-xs text-slate-600 mt-1">0-1 = No pain</p>
                        <p class="text-xs text-slate-600">2-3 = Mild pain</p>
                        <p class="text-xs text-slate-600">4-6 = Moderate pain</p>
                        <p class="text-xs text-slate-600">7-10 = Severe pain</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-lg">
                        <p class="text-sm font-medium text-slate-900">Normal Vitals</p>
                        <p class="text-xs text-slate-600 mt-1">HR: 60-100 bpm</p>
                        <p class="text-xs text-slate-600">BP: 90-140/60-90</p>
                        <p class="text-xs text-slate-600">RR: 12-20 bpm</p>
                        <p class="text-xs text-slate-600">SpO2: 95-100%</p>
                        <p class="text-xs text-slate-600">Temp: 36.1-37.2°C</p>
                    </div>
                </div>
            </div>

            <!-- Recent Observations -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Recent Observations</h3>
                <div class="space-y-3">
                    @php
                        $recentObs = [
                            [
                                'time' => '06:00',
                                'nurse' => 'Sarah Johnson',
                                'summary' => 'Patient resting comfortably, vitals stable'
                            ],
                            [
                                'time' => '04:00',
                                'nurse' => 'Mike Wilson',
                                'summary' => 'Mild discomfort, pain medication administered'
                            ],
                            [
                                'time' => '02:00',
                                'nurse' => 'Emily Davis',
                                'summary' => 'Patient sleeping, all systems within normal limits'
                            ]
                        ];
                    @endphp

                    @foreach($recentObs as $obs)
                        <div class="border-l-4 border-emerald-500 pl-3">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-slate-900">{{ $obs['time'] }}</p>
                                <p class="text-xs text-slate-500">{{ $obs['nurse'] }}</p>
                            </div>
                            <p class="text-sm text-slate-600 mt-1">{{ $obs['summary'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Assessment Tools -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Assessment Tools</h3>
                <div class="space-y-3">
                    <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">
                        Braden Scale
                    </button>
                    <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">
                        Morse Fall Scale
                    </button>
                    <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">
                    Pain Assessment Tool
                    </button>
                    <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">
                        Delirium Assessment
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
