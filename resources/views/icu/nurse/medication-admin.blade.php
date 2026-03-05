@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Medication Administration</h1>
            <p class="text-slate-500 mt-1">Manage and track patient medications</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Medication Order
            </button>
        </div>
    </div>

    <!-- Due Medications Alert -->
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-amber-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1">
                <p class="text-sm font-medium text-amber-800">3 medications due within the next hour</p>
                <p class="text-sm text-amber-600 mt-1">Morphine for John Smith, Furosemide for Maria Garcia, Insulin for Robert Johnson</p>
            </div>
            <button class="px-3 py-1 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors text-sm font-medium">
                View Due Medications
            </button>
        </div>
    </div>

    <!-- Medication Schedule -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Upcoming Medications -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-900">Medication Schedule</h2>
                    <div class="flex items-center space-x-2">
                        <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option>All Patients</option>
                            <option>John Smith</option>
                            <option>Maria Garcia</option>
                            <option>Robert Johnson</option>
                            <option>Susan Chen</option>
                        </select>
                        <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <option>Next 24 Hours</option>
                            <option>Next 6 Hours</option>
                            <option>Next Hour</option>
                            <option>Overdue</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-4">
                @php
                    $medications = [
                        [
                            'time' => '08:00',
                            'status' => 'overdue',
                            'patient' => 'John Smith',
                            'patientId' => 'P001',
                            'bed' => 'ICU-001',
                            'medication' => 'Morphine Sulfate',
                            'dosage' => '2mg',
                            'route' => 'IV',
                            'frequency' => 'q4h PRN',
                            'prescriber' => 'Dr. James Chen',
                            'reason' => 'Pain management',
                            'priority' => 'high'
                        ],
                        [
                            'time' => '08:30',
                            'status' => 'due',
                            'patient' => 'Maria Garcia',
                            'patientId' => 'P002',
                            'bed' => 'ICU-002',
                            'medication' => 'Furosemide',
                            'dosage' => '40mg',
                            'route' => 'IV',
                            'frequency' => 'q12h',
                            'prescriber' => 'Dr. Sarah Williams',
                            'reason' => 'Diuresis',
                            'priority' => 'medium'
                        ],
                        [
                            'time' => '09:00',
                            'status' => 'scheduled',
                            'patient' => 'Robert Johnson',
                            'patientId' => 'P003',
                            'bed' => 'ICU-003',
                            'medication' => 'Insulin (Regular)',
                            'dosage' => '8 units',
                            'route' => 'SubQ',
                            'frequency' => 'qAC & HS',
                            'prescriber' => 'Dr. Michael Brown',
                            'reason' => 'Blood glucose control',
                            'priority' => 'medium'
                        ],
                        [
                            'time' => '09:15',
                            'status' => 'scheduled',
                            'patient' => 'Susan Chen',
                            'patientId' => 'P004',
                            'bed' => 'ICU-004',
                            'medication' => 'Vancomycin',
                            'dosage' => '1g',
                            'route' => 'IV',
                            'frequency' => 'q12h',
                            'prescriber' => 'Dr. Emily Davis',
                            'reason' => 'Antibiotic therapy',
                            'priority' => 'high'
                        ],
                        [
                            'time' => '10:00',
                            'status' => 'scheduled',
                            'patient' => 'John Smith',
                            'patientId' => 'P001',
                            'bed' => 'ICU-001',
                            'medication' => 'Lisinopril',
                            'dosage' => '10mg',
                            'route' => 'PO',
                            'frequency' => 'daily',
                            'prescriber' => 'Dr. James Chen',
                            'reason' => 'Blood pressure control',
                            'priority' => 'low'
                        ]
                    ];
                @endphp

                @foreach($medications as $med)
                    <div class="border border-slate-200 rounded-xl p-4
                        @if($med['status'] == 'overdue') border-red-200 bg-red-50
                        @elseif($med['status'] == 'due') border-amber-200 bg-amber-50
                        @else border-slate-200 bg-white @endif">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="text-center">
                                    <p class="text-lg font-semibold text-slate-900">{{ $med['time'] }}</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium mt-1
                                        @if($med['status'] == 'overdue') bg-red-100 text-red-800
                                        @elseif($med['status'] == 'due') bg-amber-100 text-amber-800
                                        @else bg-slate-100 text-slate-800 @endif">
                                        {{ ucfirst($med['status']) }}
                                    </span>
                                </div>
                                <div class="w-px h-12 bg-slate-200"></div>
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <p class="font-medium text-slate-900">{{ $med['patient'] }}</p>
                                        <span class="text-sm text-slate-500">({{ $med['patientId'] }})</span>
                                        <span class="text-sm text-slate-500">{{ $med['bed'] }}</span>
                                    </div>
                                    <div class="mt-1">
                                        <p class="font-medium text-slate-900">{{ $med['medication'] }}</p>
                                        <p class="text-sm text-slate-600">{{ $med['dosage'] }} {{ $med['route'] }} • {{ $med['frequency'] }}</p>
                                        <p class="text-sm text-slate-500">{{ $med['reason'] }} • Prescribed by {{ $med['prescriber'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($med['priority'] == 'high')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        High Priority
                                    </span>
                                @endif
                                @if($med['status'] == 'overdue' || $med['status'] == 'due')
                                    <button class="px-3 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm font-medium">
                                        Administer Now
                                    </button>
                                @else
                                    <button class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                        View Details
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Actions & Stats -->
        <div class="space-y-6">
            <!-- Medication Stats -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Today's Summary</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Total Scheduled</span>
                        <span class="font-semibold text-slate-900">24</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Administered</span>
                        <span class="font-semibold text-emerald-600">18</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Pending</span>
                        <span class="font-semibold text-amber-600">5</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Overdue</span>
                        <span class="font-semibold text-red-600">1</span>
                    </div>
                </div>
            </div>

            <!-- High Alert Medications -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">High Alert Medications</h3>
                <div class="space-y-3">
                    @php
                        $highAlertMeds = [
                            ['name' => 'Heparin', 'count' => 2, 'risk' => 'Bleeding'],
                            ['name' => 'Insulin', 'count' => 3, 'risk' => 'Hypoglycemia'],
                            ['name' => 'Morphine', 'count' => 1, 'risk' => 'Respiratory depression'],
                            ['name' => 'Vancomycin', 'count' => 1, 'risk' => 'Nephrotoxicity']
                        ];
                    @endphp

                    @foreach($highAlertMeds as $med)
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                            <div>
                                <p class="font-medium text-slate-900">{{ $med['name'] }}</p>
                                <p class="text-xs text-red-600">{{ $med['risk'] }}</p>
                            </div>
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                {{ $med['count'] }} active
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium text-sm">
                        Record Administration
                    </button>
                    <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium text-sm">
                        PRN Medication Given
                    </button>
                    <button class="w-full px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors font-medium text-sm">
                        Report Adverse Reaction
                    </button>
                    <button class="w-full px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors font-medium text-sm">
                        IV Pump Check
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Administration History -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Recent Administration History</h2>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Medication</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Dosage</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Route</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Administered By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $adminHistory = [
                            [
                                'time' => '07:45',
                                'patient' => 'John Smith',
                                'patientId' => 'P001',
                                'medication' => 'Morphine Sulfate',
                                'dosage' => '2mg',
                                'route' => 'IV',
                                'administeredBy' => 'Sarah Johnson',
                                'status' => 'completed'
                            ],
                            [
                                'time' => '07:30',
                                'patient' => 'Maria Garcia',
                                'patientId' => 'P002',
                                'medication' => 'Furosemide',
                                'dosage' => '40mg',
                                'route' => 'IV',
                                'administeredBy' => 'Mike Wilson',
                                'status' => 'completed'
                            ],
                            [
                                'time' => '07:15',
                                'patient' => 'Robert Johnson',
                                'patientId' => 'P003',
                                'medication' => 'Insulin (Regular)',
                                'dosage' => '8 units',
                                'route' => 'SubQ',
                                'administeredBy' => 'Emily Davis',
                                'status' => 'completed'
                            ],
                            [
                                'time' => '07:00',
                                'patient' => 'Susan Chen',
                                'patientId' => 'P004',
                                'medication' => 'Vancomycin',
                                'dosage' => '1g',
                                'route' => 'IV',
                                'administeredBy' => 'Sarah Johnson',
                                'status' => 'delayed'
                            ]
                        ];
                    @endphp

                    @foreach($adminHistory as $admin)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admin['time'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-slate-900">{{ $admin['patient'] }}</div>
                                    <div class="text-sm text-slate-500">{{ $admin['patientId'] }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admin['medication'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admin['dosage'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admin['route'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $admin['administeredBy'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($admin['status'] == 'completed') bg-green-100 text-green-800
                                    @elseif($admin['status'] == 'delayed') bg-amber-100 text-amber-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($admin['status']) }}
                                </span>
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
