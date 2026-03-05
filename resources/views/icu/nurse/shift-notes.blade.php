@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Shift Notes</h1>
            <p class="text-slate-500 mt-1">Document shift handovers and patient care updates</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Shift Note
            </button>
        </div>
    </div>

    <!-- Current Shift Info -->
    <div class="bg-white rounded-xl border border-slate-200/80 p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-slate-900">Current Shift</h2>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-medium">Active</span>
                <span class="text-sm text-slate-600">Started: 7:00 AM</span>
                <span class="text-sm text-slate-600">Ends: 7:00 PM</span>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-slate-500">Shift Type</p>
                <p class="font-medium text-slate-900">Day Shift</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Charge Nurse</p>
                <p class="font-medium text-slate-900">Sarah Johnson</p>
            </div>
            <div>
                <p class="text-sm text-slate-500">Team Members</p>
                <p class="font-medium text-slate-900">4 Nurses, 2 CNAs</p>
            </div>
        </div>
    </div>

    <!-- Shift Handover Form -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Create Shift Note</h2>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Note Type</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Handover Note</option>
                        <option>Patient Update</option>
                        <option>Incident Report</option>
                        <option>Medication Error</option>
                        <option>Equipment Issue</option>
                        <option>Family Communication</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Priority</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                        <option>Critical</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Patient(s) Involved</label>
                <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option>All Patients</option>
                    <option>John Smith (P001)</option>
                    <option>Maria Garcia (P002)</option>
                    <option>Robert Johnson (P003)</option>
                    <option>Susan Chen (P004)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Subject</label>
                <input type="text" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Brief summary of the note">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Detailed Note</label>
                <textarea rows="6" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Provide detailed information about the patient condition, interventions, and any concerns..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Follow-up Required</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Physician notification needed</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Family notification needed</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Additional monitoring required</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Save as Draft
                </button>
                <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                    Submit Note
                </button>
            </div>
        </div>
    </div>

    <!-- Recent Shift Notes -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Recent Shift Notes</h2>
                <div class="flex items-center space-x-2">
                    <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>All Types</option>
                        <option>Handover Notes</option>
                        <option>Patient Updates</option>
                        <option>Incident Reports</option>
                    </select>
                    <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Last 24 Hours</option>
                        <option>Last 48 Hours</option>
                        <option>Last Week</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="divide-y divide-slate-200">
            @php
                $shiftNotes = [
                    [
                        'id' => 'SN001',
                        'type' => 'Handover Note',
                        'priority' => 'high',
                        'subject' => 'Maria Garcia - Respiratory Status Deterioration',
                        'author' => 'Sarah Johnson',
                        'time' => '6:45 AM',
                        'patients' => ['Maria Garcia (P002)'],
                        'content' => 'Patient SpO2 dropped to 82% at 6:30 AM. Increased oxygen from 2L to 4L nasal cannula. ABG drawn, results pending. Dr. Chen notified. Continue close monitoring.',
                        'followUp' => ['Physician notification needed', 'Additional monitoring required']
                    ],
                    [
                        'id' => 'SN002',
                        'type' => 'Patient Update',
                        'priority' => 'medium',
                        'subject' => 'John Smith - Post-operative Progress',
                        'author' => 'Mike Wilson',
                        'time' => '5:30 AM',
                        'patients' => ['John Smith (P001)'],
                        'content' => 'Patient ambulated to bathroom twice during shift. Pain well controlled with PRN medication. Wound dressing intact, no signs of infection. Bowel sounds present.',
                        'followUp' => []
                    ],
                    [
                        'id' => 'SN003',
                        'type' => 'Incident Report',
                        'priority' => 'high',
                        'subject' => 'IV Pump Malfunction - Bed 003',
                        'author' => 'Emily Davis',
                        'time' => '4:15 AM',
                        'patients' => ['Robert Johnson (P003)'],
                        'content' => 'IV pump for maintenance fluids stopped alarming "occlusion". Line found to be kinked under patient. Issue resolved, but pump malfunction reported to biomedical engineering.',
                        'followUp' => ['Equipment issue']
                    ],
                    [
                        'id' => 'SN004',
                        'type' => 'Family Communication',
                        'priority' => 'low',
                        'subject' => 'Susan Chen - Family Update Provided',
                        'author' => 'Sarah Johnson',
                        'time' => '3:00 AM',
                        'patients' => ['Susan Chen (P004)'],
                        'content' => 'Spoke with daughter regarding patient condition. Explained current treatment plan and answered questions. Family satisfied with communication.',
                        'followUp' => []
                    ]
                ];
            @endphp

            @foreach($shiftNotes as $note)
                <div class="p-6 hover:bg-slate-50 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="mt-1">
                                <div class="w-2 h-2 rounded-full
                                    @if($note['priority'] == 'critical') bg-red-500
                                    @elseif($note['priority'] == 'high') bg-amber-500
                                    @elseif($note['priority'] == 'medium') bg-blue-500
                                    @else bg-slate-500 @endif"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="text-sm font-medium text-slate-900">{{ $note['id'] }}</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($note['type'] == 'Handover Note') bg-emerald-100 text-emerald-800
                                        @elseif($note['type'] == 'Patient Update') bg-blue-100 text-blue-800
                                        @elseif($note['type'] == 'Incident Report') bg-red-100 text-red-800
                                        @elseif($note['type'] == 'Family Communication') bg-purple-100 text-purple-800
                                        @else bg-slate-100 text-slate-800 @endif">
                                        {{ $note['type'] }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($note['priority'] == 'critical') bg-red-100 text-red-800
                                        @elseif($note['priority'] == 'high') bg-amber-100 text-amber-800
                                        @elseif($note['priority'] == 'medium') bg-blue-100 text-blue-800
                                        @else bg-slate-100 text-slate-800 @endif">
                                        {{ ucfirst($note['priority']) }}
                                    </span>
                                </div>
                                
                                <h3 class="font-medium text-slate-900 mb-2">{{ $note['subject'] }}</h3>
                                <p class="text-sm text-slate-600 mb-3">{{ $note['content'] }}</p>
                                
                                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500">
                                    <span>By: {{ $note['author'] }}</span>
                                    <span>{{ $note['time'] }}</span>
                                    <span>Patients: {{ implode(', ', $note['patients']) }}</span>
                                </div>
                                
                                @if(!empty($note['followUp']))
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @foreach($note['followUp'] as $action)
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-amber-50 text-amber-700">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $action }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2 ml-4">
                            <button class="px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50">
                                View
                            </button>
                            <button class="px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Handover Checklist -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">End-of-Shift Handover Checklist</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-medium text-slate-900 mb-4">Patient Care</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">All patient assessments completed</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Medications administered and documented</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Vital signs recorded and trended</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">IV lines and pumps checked</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Wound care documented</span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-medium text-slate-900 mb-4">Safety & Equipment</h3>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Bed alarms checked and functional</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Emergency equipment checked</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Medication cart restocked</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Supply inventory completed</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="ml-2 text-sm text-slate-700">Critical items reported to next shift</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-slate-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-600">
                        <span id="checklist-progress">8 of 10 items completed</span>
                    </div>
                    <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm font-medium">
                        Complete Handover
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
