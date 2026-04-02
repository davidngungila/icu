@extends('hms.layouts.app')

@section('title', 'HMS Dashboard')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Hospital Management Dashboard</h1>
        <p class="mt-2 text-slate-600">Complete overview of hospital operations and patient care</p>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Patients -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-600 truncate">Total Patients</dt>
                            <dd class="text-lg font-medium text-slate-900" id="total-patients">-</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('hms.patient-registration.index') }}" class="font-medium text-blue-700 hover:text-blue-600">View all patients</a>
                </div>
            </div>
        </div>

        <!-- Today's Appointments -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-600 truncate">Today's Appointments</dt>
                            <dd class="text-lg font-medium text-slate-900" id="today-appointments">-</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('hms.appointments.index') }}" class="font-medium text-emerald-700 hover:text-emerald-600">View appointments</a>
                </div>
            </div>
        </div>

        <!-- Critical Patients -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-600 truncate">Critical Patients</dt>
                            <dd class="text-lg font-medium text-slate-900" id="critical-patients">-</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('hms.triage.index') }}" class="font-medium text-red-700 hover:text-red-600">View triage</a>
                </div>
            </div>
        </div>

        <!-- Available Beds -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-600 truncate">Available Beds</dt>
                            <dd class="text-lg font-medium text-slate-900" id="available-beds">-</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('hms.triage.index') }}" class="font-medium text-amber-700 hover:text-amber-600">View bed management</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Patients -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-slate-900 mb-4">Recent Patient Registrations</h3>
                    <div class="flow-root">
                        <ul class="-my-5 divide-y divide-slate-200" id="recent-patients">
                            <!-- Patients will be loaded here -->
                        </ul>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('hms.patient-registration.index') }}" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            View All Patients
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-slate-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('hms.patient-registration.create') }}" class="w-full flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Register New Patient
                        </a>
                        <a href="{{ route('hms.appointments.create') }}" class="w-full flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Schedule Appointment
                        </a>
                        <button onclick="openTriageModal()" class="w-full flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Start Triage
                        </button>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-white shadow rounded-lg mt-6">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-slate-900 mb-4">System Status</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Database</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Healthy</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">API Services</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Operational</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Backup Status</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Recent</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Triage Modal -->
<div id="triage-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Start Patient Triage</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Enter patient MRN or search by name to begin triage process.</p>
            </div>
            <div class="mt-4 px-7 py-3">
                <input type="text" id="triage-search" placeholder="Patient MRN or Name" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>
            <div class="items-center px-4 py-3">
                <button onclick="closeTriageModal()" class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 mr-2">
                    Cancel
                </button>
                <button onclick="searchForTriage()" class="px-4 py-2 bg-emerald-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-emerald-700">
                    Search Patient
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadDashboardData();
});

function loadDashboardData() {
    // Load patient stats
    fetch('/hms/patient-registration/stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-patients').textContent = data.total_patients;
        });

    // Load appointment stats
    fetch('/hms/appointments/stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('today-appointments').textContent = data.today_appointments;
        });

    // Load triage stats
    fetch('/hms/triage/stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('critical-patients').textContent = data.critical_patients;
            document.getElementById('available-beds').textContent = data.available_beds;
        });

    // Load recent patients
    fetch('/hms/patient-registration/search?limit=5')
        .then(response => response.json())
        .then(patients => {
            const recentPatientsList = document.getElementById('recent-patients');
            recentPatientsList.innerHTML = patients.map(patient => `
                <li class="py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-sm font-medium">${patient.full_name[0] || 'P'}</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">${patient.full_name}</p>
                            <p class="text-sm text-gray-500">${patient.mrn} • ${patient.phone}</p>
                        </div>
                        <div>
                            <a href="/hms/patient-registration/${patient.id}" class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">
                                View
                            </a>
                        </div>
                    </div>
                </li>
            `).join('');
        });
}

function openTriageModal() {
    document.getElementById('triage-modal').classList.remove('hidden');
}

function closeTriageModal() {
    document.getElementById('triage-modal').classList.add('hidden');
    document.getElementById('triage-search').value = '';
}

function searchForTriage() {
    const query = document.getElementById('triage-search').value;
    if (query.length < 2) return;
    
    fetch(`/hms/triage/search?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(patients => {
            if (patients.length > 0) {
                window.location.href = `/hms/triage/create/${patients[0].id}`;
            } else {
                alert('Patient not found. Please register the patient first.');
            }
        });
}
</script>
@endsection
