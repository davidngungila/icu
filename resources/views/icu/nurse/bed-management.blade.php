@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Bed Management</h1>
            <p class="text-slate-500 mt-1">Manage ICU bed occupancy and patient assignments</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Assign Patient
            </button>
        </div>
    </div>

    <!-- Bed Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Beds</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">16</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Occupied</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">12</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-600 font-medium">75% occupied</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Available</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">4</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Bed Grid View -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Bed Status Overview</h2>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 text-sm bg-emerald-600 text-white rounded-lg">Grid View</button>
                    <button class="px-3 py-1 text-sm border border-slate-300 rounded-lg hover:bg-slate-50">List View</button>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                @php
                    $beds = [
                        ['id' => 'ICU-001', 'status' => 'occupied', 'patient' => 'John Smith', 'patientId' => 'P001', 'acuity' => 'high', 'gender' => 'male', 'age' => 45],
                        ['id' => 'ICU-002', 'status' => 'occupied', 'patient' => 'Maria Garcia', 'patientId' => 'P002', 'acuity' => 'critical', 'gender' => 'female', 'age' => 62],
                        ['id' => 'ICU-003', 'status' => 'occupied', 'patient' => 'Robert Johnson', 'patientId' => 'P003', 'acuity' => 'medium', 'gender' => 'male', 'age' => 58],
                        ['id' => 'ICU-004', 'status' => 'occupied', 'patient' => 'Susan Chen', 'patientId' => 'P004', 'acuity' => 'high', 'gender' => 'female', 'age' => 71],
                        ['id' => 'ICU-005', 'status' => 'occupied', 'patient' => 'James Wilson', 'patientId' => 'P005', 'acuity' => 'medium', 'gender' => 'male', 'age' => 54],
                        ['id' => 'ICU-006', 'status' => 'occupied', 'patient' => 'Elena Rodriguez', 'patientId' => 'P006', 'acuity' => 'critical', 'gender' => 'female', 'age' => 68],
                        ['id' => 'ICU-007', 'status' => 'occupied', 'patient' => 'David Brown', 'patientId' => 'P007', 'acuity' => 'low', 'gender' => 'male', 'age' => 39],
                        ['id' => 'ICU-008', 'status' => 'available', 'patient' => null, 'patientId' => null, 'acuity' => null, 'gender' => null, 'age' => null],
                        ['id' => 'ICU-009', 'status' => 'occupied', 'patient' => 'Lisa Anderson', 'patientId' => 'P008', 'acuity' => 'medium', 'gender' => 'female', 'age' => 52],
                        ['id' => 'ICU-010', 'status' => 'occupied', 'patient' => 'Michael Davis', 'patientId' => 'P009', 'acuity' => 'high', 'gender' => 'male', 'age' => 61],
                        ['id' => 'ICU-011', 'status' => 'occupied', 'patient' => 'Patricia Miller', 'patientId' => 'P010', 'acuity' => 'critical', 'gender' => 'female', 'age' => 73],
                        ['id' => 'ICU-012', 'status' => 'occupied', 'patient' => 'Thomas Taylor', 'patientId' => 'P011', 'acuity' => 'medium', 'gender' => 'male', 'age' => 48],
                        ['id' => 'ICU-013', 'status' => 'available', 'patient' => null, 'patientId' => null, 'acuity' => null, 'gender' => null, 'age' => null],
                        ['id' => 'ICU-014', 'status' => 'occupied', 'patient' => 'Jennifer White', 'patientId' => 'P012', 'acuity' => 'high', 'gender' => 'female', 'age' => 55],
                        ['id' => 'ICU-015', 'status' => 'available', 'patient' => null, 'patientId' => null, 'acuity' => null, 'gender' => null, 'age' => null],
                        ['id' => 'ICU-016', 'status' => 'available', 'patient' => null, 'patientId' => null, 'acuity' => null, 'gender' => null, 'age' => null],
                    ];
                @endphp

                @foreach($beds as $bed)
                    <div class="relative">
                        <div class="p-4 rounded-lg border-2 cursor-pointer transition-all hover:shadow-lg
                            @if($bed['status'] == 'occupied')
                                @if($bed['acuity'] == 'critical') border-red-200 bg-red-50
                                @elseif($bed['acuity'] == 'high') border-amber-200 bg-amber-50
                                @elseif($bed['acuity'] == 'medium') border-blue-200 bg-blue-50
                                @else border-emerald-200 bg-emerald-50
                                @endif
                            @else border-slate-200 bg-slate-50 @endif">
                            <div class="text-center">
                                <div class="text-xs font-medium text-slate-600">{{ $bed['id'] }}</div>
                                
                                @if($bed['status'] == 'occupied')
                                    <div class="mt-2">
                                        <div class="w-8 h-8 mx-auto mb-1 rounded-full bg-slate-300 flex items-center justify-center">
                                            @if($bed['gender'] == 'male')
                                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="text-xs font-medium text-slate-900 truncate">{{ $bed['patient'] }}</div>
                                        <div class="text-xs text-slate-500">{{ $bed['age'] }}y</div>
                                        <div class="mt-1">
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium
                                                @if($bed['acuity'] == 'critical') bg-red-100 text-red-800
                                                @elseif($bed['acuity'] == 'high') bg-amber-100 text-amber-800
                                                @elseif($bed['acuity'] == 'medium') bg-blue-100 text-blue-800
                                                @else bg-emerald-100 text-emerald-800
                                                @endif">
                                                {{ ucfirst($bed['acuity']) }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-4">
                                        <div class="w-8 h-8 mx-auto mb-1 rounded-full border-2 border-dashed border-slate-400 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </div>
                                        <div class="text-xs text-slate-500">Available</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        @if($bed['status'] == 'occupied' && $bed['acuity'] == 'critical')
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                        @endif
                    </div>
                @endforeach
            </div>
            
            <!-- Legend -->
            <div class="mt-6 flex flex-wrap items-center justify-center gap-4 text-sm">
                <div class="flex items-center">
                    <div class="w-4 h-4 border-2 border-red-200 bg-red-50 rounded mr-2"></div>
                    <span>Critical</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 border-2 border-amber-200 bg-amber-50 rounded mr-2"></div>
                    <span>High Acuity</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 border-2 border-blue-200 bg-blue-50 rounded mr-2"></div>
                    <span>Medium Acuity</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 border-2 border-emerald-200 bg-emerald-50 rounded mr-2"></div>
                    <span>Low Acuity</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 border-2 border-slate-200 bg-slate-50 rounded mr-2"></div>
                    <span>Available</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Assignment Form -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Assign Patient to Bed</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Select Patient</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Choose patient...</option>
                        <option>William Martinez - Admitting (ER)</option>
                        <option>Nancy Thompson - Transfer (Med-Surg)</option>
                        <option>Richard Lee - Post-op (OR)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Select Bed</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Choose bed...</option>
                        <option>ICU-008 - Available</option>
                        <option>ICU-013 - Available</option>
                        <option>ICU-015 - Available</option>
                        <option>ICU-016 - Available</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Acuity Level</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                        <option>Critical</option>
                    </select>
                </div>
            </div>
            
            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Special Requirements</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Isolation precautions</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Ventilator support</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="ml-2 text-sm text-slate-700">Continuous monitoring</span>
                    </label>
                </div>
            </div>
            
            <div class="mt-6 flex items-center justify-end space-x-3">
                <button class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Cancel
                </button>
                <button class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                    Assign Patient
                </button>
            </div>
        </div>
    </div>

    <!-- Recent Transfers -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <h2 class="text-lg font-semibold text-slate-900">Recent Bed Transfers</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">From</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">To</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Reason</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Staff</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $transfers = [
                            [
                                'time' => '6:30 AM',
                                'patient' => 'Maria Garcia (P002)',
                                'from' => 'ICU-003',
                                'to' => 'ICU-002',
                                'reason' => 'Closer to nursing station',
                                'staff' => 'Sarah Johnson'
                            ],
                            [
                                'time' => '5:45 AM',
                                'patient' => 'John Smith (P001)',
                                'from' => 'ICU-002',
                                'to' => 'ICU-001',
                                'reason' => 'Equipment access',
                                'staff' => 'Mike Wilson'
                            ],
                            [
                                'time' => '4:15 AM',
                                'patient' => 'Robert Johnson (P003)',
                                'from' => 'ICU-005',
                                'to' => 'ICU-003',
                                'reason' => 'Isolation room needed',
                                'staff' => 'Emily Davis'
                            ]
                        ];
                    @endphp

                    @foreach($transfers as $transfer)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $transfer['time'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $transfer['patient'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $transfer['from'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $transfer['to'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $transfer['reason'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $transfer['staff'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
