@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Device Status</h1>
            <p class="text-slate-500 mt-1">Monitor and manage medical equipment status</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors font-medium">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Device Settings
            </button>
        </div>
    </div>

    <!-- Device Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Devices</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">48</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-600 font-medium">All systems operational</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Online</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">42</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-emerald-600 font-medium">87.5% uptime</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Warning</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">4</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-amber-600 font-medium">Requires attention</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 border border-slate-200/80">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Offline</p>
                    <p class="text-2xl font-bold text-red-600 mt-1">2</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-red-600 font-medium">Immediate action needed</span>
            </div>
        </div>
    </div>

    <!-- Device Categories -->
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-6">
        @php
            $deviceCategories = [
                [
                    'name' => 'Cardiac Monitors',
                    'count' => 12,
                    'online' => 11,
                    'warning' => 1,
                    'offline' => 0,
                    'icon' => 'heart-pulse',
                    'color' => 'red'
                ],
                [
                    'name' => 'Ventilators',
                    'count' => 8,
                    'online' => 7,
                    'warning' => 1,
                    'offline' => 0,
                    'icon' => 'lungs',
                    'color' => 'blue'
                ],
                [
                    'name' => 'Infusion Pumps',
                    'count' => 16,
                    'online' => 14,
                    'warning' => 1,
                    'offline' => 1,
                    'icon' => 'droplet',
                    'color' => 'emerald'
                ],
                [
                    'name' => 'Vital Signs Monitors',
                    'count' => 12,
                    'online' => 10,
                    'warning' => 1,
                    'offline' => 1,
                    'icon' => 'activity',
                    'color' => 'amber'
                ]
            ];
        @endphp

        @foreach($deviceCategories as $category)
            <div class="bg-white rounded-xl border border-slate-200/80 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-{{ $category['color'] }}-100 rounded-lg flex items-center justify-center">
                            @if($category['icon'] == 'heart-pulse')
                                <svg class="w-5 h-5 text-{{ $category['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            @elseif($category['icon'] == 'lungs')
                                <svg class="w-5 h-5 text-{{ $category['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            @elseif($category['icon'] == 'droplet')
                                <svg class="w-5 h-5 text-{{ $category['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-{{ $category['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">{{ $category['name'] }}</p>
                            <p class="text-sm text-slate-500">{{ $category['count'] }} devices</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600">Online</span>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 bg-slate-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ ($category['online'] / $category['count']) * 100 }}%"></div>
                            </div>
                            <span class="text-sm font-medium text-emerald-600">{{ $category['online'] }}</span>
                        </div>
                    </div>
                    @if($category['warning'] > 0)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Warning</span>
                            <div class="flex items-center space-x-2">
                                <div class="w-24 bg-slate-200 rounded-full h-2">
                                    <div class="bg-amber-500 h-2 rounded-full" style="width: {{ ($category['warning'] / $category['count']) * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-amber-600">{{ $category['warning'] }}</span>
                            </div>
                        </div>
                    @endif
                    @if($category['offline'] > 0)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-600">Offline</span>
                            <div class="flex items-center space-x-2">
                                <div class="w-24 bg-slate-200 rounded-full h-2">
                                    <div class="bg-red-500 h-2 rounded-full" style="width: {{ ($category['offline'] / $category['count']) * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-red-600">{{ $category['offline'] }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <button class="w-full mt-4 px-4 py-2 bg-{{ $category['color'] }}-600 text-white rounded-lg hover:bg-{{ $category['color'] }}-700 transition-colors text-sm font-medium">
                    View Devices
                </button>
            </div>
        @endforeach
    </div>

    <!-- Device List -->
    <div class="bg-white rounded-xl border border-slate-200/80">
        <div class="p-6 border-b border-slate-200/80">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">All Devices</h2>
                <div class="flex items-center space-x-3">
                    <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>All Types</option>
                        <option>Cardiac Monitors</option>
                        <option>Ventilators</option>
                        <option>Infusion Pumps</option>
                        <option>Vital Signs Monitors</option>
                    </select>
                    <select class="px-3 py-1 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option>All Status</option>
                        <option>Online</option>
                        <option>Warning</option>
                        <option>Offline</option>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Device</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Last Update</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Battery</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @php
                        $devices = [
                            [
                                'id' => 'CM-001',
                                'name' => 'Cardiac Monitor 001',
                                'type' => 'Cardiac Monitor',
                                'location' => 'ICU-001',
                                'patient' => 'John Smith',
                                'patientId' => 'P001',
                                'status' => 'online',
                                'lastUpdate' => '1 min ago',
                                'battery' => 85,
                                'issue' => null
                            ],
                            [
                                'id' => 'CM-002',
                                'name' => 'Cardiac Monitor 002',
                                'type' => 'Cardiac Monitor',
                                'location' => 'ICU-002',
                                'patient' => 'Maria Garcia',
                                'patientId' => 'P002',
                                'status' => 'warning',
                                'lastUpdate' => '5 mins ago',
                                'battery' => 25,
                                'issue' => 'Low battery'
                            ],
                            [
                                'id' => 'VENT-001',
                                'name' => 'Ventilator 001',
                                'type' => 'Ventilator',
                                'location' => 'ICU-002',
                                'patient' => 'Maria Garcia',
                                'patientId' => 'P002',
                                'status' => 'online',
                                'lastUpdate' => '2 mins ago',
                                'battery' => 100,
                                'issue' => null
                            ],
                            [
                                'id' => 'PUMP-004',
                                'name' => 'Infusion Pump 004',
                                'type' => 'Infusion Pump',
                                'location' => 'ICU-004',
                                'patient' => 'Susan Chen',
                                'patientId' => 'P004',
                                'status' => 'offline',
                                'lastUpdate' => '15 mins ago',
                                'battery' => 0,
                                'issue' => 'Connection lost'
                            ],
                            [
                                'id' => 'VSM-003',
                                'name' => 'Vital Signs Monitor 003',
                                'type' => 'Vital Signs Monitor',
                                'location' => 'ICU-003',
                                'patient' => 'Robert Johnson',
                                'patientId' => 'P003',
                                'status' => 'online',
                                'lastUpdate' => '30 secs ago',
                                'battery' => 92,
                                'issue' => null
                            ]
                        ];
                    @endphp

                    @foreach($devices as $device)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 rounded-full mr-3
                                        @if($device['status'] == 'online') bg-emerald-500
                                        @elseif($device['status'] == 'warning') bg-amber-500
                                        @else bg-red-500 @endif"></div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-900">{{ $device['name'] }}</div>
                                        <div class="text-sm text-slate-500">{{ $device['id'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $device['type'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                {{ $device['location'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($device['patient'])
                                    <div>
                                        <div class="text-sm font-medium text-slate-900">{{ $device['patient'] }}</div>
                                        <div class="text-sm text-slate-500">{{ $device['patientId'] }}</div>
                                    </div>
                                @else
                                    <span class="text-sm text-slate-400">Not assigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($device['status'] == 'online') bg-green-100 text-green-800
                                    @elseif($device['status'] == 'warning') bg-amber-100 text-amber-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($device['status']) }}
                                </span>
                                @if($device['issue'])
                                    <div class="text-xs text-red-600 mt-1">{{ $device['issue'] }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                {{ $device['lastUpdate'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-16 bg-slate-200 rounded-full h-2 mr-2">
                                        <div class="h-2 rounded-full
                                            @if($device['battery'] > 50) bg-emerald-500
                                            @elseif($device['battery'] > 20) bg-amber-500
                                            @else bg-red-500 @endif"
                                            style="width: {{ $device['battery'] }}%"></div>
                                    </div>
                                    <span class="text-sm text-slate-900">{{ $device['battery'] }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-emerald-600 hover:text-emerald-900 mr-3">Details</button>
                                <button class="text-blue-600 hover:text-blue-900">Configure</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Maintenance Schedule -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Upcoming Maintenance -->
        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h2 class="text-lg font-semibold text-slate-900">Upcoming Maintenance</h2>
            </div>
            <div class="p-6 space-y-4">
                @php
                    $maintenance = [
                        [
                            'device' => 'Ventilator 001',
                            'type' => 'Calibration',
                            'scheduled' => 'Tomorrow, 09:00',
                            'duration' => '2 hours',
                            'technician' => 'John Smith',
                            'priority' => 'high'
                        ],
                        [
                            'device' => 'Infusion Pump 003',
                            'type' => 'Preventive Maintenance',
                            'scheduled' => 'Dec 8, 14:00',
                            'duration' => '1 hour',
                            'technician' => 'Sarah Johnson',
                            'priority' => 'medium'
                        ],
                        [
                            'device' => 'Cardiac Monitor 004',
                            'type' => 'Battery Replacement',
                            'scheduled' => 'Dec 10, 10:00',
                            'duration' => '30 mins',
                            'technician' => 'Mike Wilson',
                            'priority' => 'low'
                        ]
                    ];
                @endphp

                @foreach($maintenance as $item)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">{{ $item['device'] }}</p>
                                <p class="text-sm text-slate-600">{{ $item['type'] }}</p>
                                <div class="flex items-center space-x-4 mt-1 text-xs text-slate-500">
                                    <span>{{ $item['scheduled'] }}</span>
                                    <span>{{ $item['duration'] }}</span>
                                    <span>Tech: {{ $item['technician'] }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($item['priority'] == 'high') bg-red-100 text-red-800
                            @elseif($item['priority'] == 'medium') bg-amber-100 text-amber-800
                            @else bg-blue-100 text-blue-800 @endif">
                            {{ ucfirst($item['priority']) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Device Alerts -->
        <div class="bg-white rounded-xl border border-slate-200/80">
            <div class="p-6 border-b border-slate-200/80">
                <h2 class="text-lg font-semibold text-slate-900">Device Alerts</h2>
            </div>
            <div class="p-6 space-y-4">
                @php
                    $deviceAlerts = [
                        [
                            'device' => 'Infusion Pump 004',
                            'alert' => 'Connection lost',
                            'time' => '15 mins ago',
                            'severity' => 'critical'
                        ],
                        [
                            'device' => 'Cardiac Monitor 002',
                            'alert' => 'Low battery (25%)',
                            'time' => '25 mins ago',
                            'severity' => 'warning'
                        ],
                        [
                            'device' => 'Ventilator 002',
                            'alert' => 'Filter replacement due',
                            'time' => '1 hour ago',
                            'severity' => 'info'
                        ]
                    ];
                @endphp

                @foreach($deviceAlerts as $alert)
                    <div class="flex items-start space-x-3 p-3 rounded-lg
                        @if($alert['severity'] == 'critical') bg-red-50
                        @elseif($alert['severity'] == 'warning') bg-amber-50
                        @else bg-blue-50 @endif">
                        <div class="w-2 h-2 rounded-full mt-2
                            @if($alert['severity'] == 'critical') bg-red-500
                            @elseif($alert['severity'] == 'warning') bg-amber-500
                            @else bg-blue-500 @endif"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-900">{{ $alert['device'] }}</p>
                            <p class="text-sm text-slate-600 mt-1">{{ $alert['alert'] }}</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $alert['time'] }}</p>
                        </div>
                        <button class="px-3 py-1 text-sm bg-white border border-slate-300 rounded-lg hover:bg-slate-50">
                            View
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
