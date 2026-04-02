@extends('hms.layouts.app')

@section('title', 'Patient Registration')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Patient Registration</h1>
                <p class="mt-2 text-slate-600">Register new patients and manage existing records</p>
            </div>
            <div class="flex gap-3">
                <button onclick="showRegistrationForm()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Patient
                </button>
                <button onclick="refreshPatientList()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Total Patients</p>
                    <p class="text-2xl font-bold text-slate-900" id="total-patients">-</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Registered Today</p>
                    <p class="text-2xl font-bold text-emerald-600" id="registered-today">-</p>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Admitted Patients</p>
                    <p class="text-2xl font-bold text-amber-600" id="admitted-patients">-</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg border border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Discharged Today</p>
                    <p class="text-2xl font-bold text-purple-600" id="discharged-today">-</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-4 rounded-lg border border-slate-200 mb-6">
        <div class="flex gap-4">
            <div class="flex-1 relative">
                <input type="text" id="search-input" placeholder="Search by MRN, Name, Phone, or National ID..." 
                       class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <button onclick="searchPatients()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg">
                Search
            </button>
        </div>
    </div>

    <!-- Patient List -->
    <div class="bg-white rounded-lg border border-slate-200">
        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-gray-900">Patient Records</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">MRN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Registered</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-slate-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="patient-list" class="bg-white divide-y divide-slate-200">
                    <!-- Patient records will be loaded here -->
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-slate-600">
                    Showing <span id="showing-from">1</span> to <span id="showing-to">10</span> of <span id="total-records">0</span> results
                </div>
                <div class="flex gap-2" id="pagination">
                    <!-- Pagination will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registration Modal -->
<div id="registration-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-slate-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Register New Patient</h3>
                    <button onclick="closeRegistrationForm()" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <form id="registration-form" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h4 class="font-medium text-gray-900">Personal Information</h4>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="full_name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sex *</label>
                                <select name="sex" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                    <option value="">Select</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                                <input type="date" name="dob" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                            <input type="tel" name="phone" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">National ID</label>
                            <input type="text" name="national_id" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                            <textarea name="address" rows="2" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                        </div>
                    </div>
                    
                    <!-- Medical Information -->
                    <div class="space-y-4">
                        <h4 class="font-medium text-gray-900">Medical Information</h4>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Name *</label>
                            <input type="text" name="emergency_contact_name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Phone *</label>
                            <input type="tel" name="emergency_contact_phone" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Blood Type</label>
                            <select name="blood_type" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="">Select</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Allergies</label>
                            <textarea name="allergies" rows="3" placeholder="List any known allergies..." class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Chronic Conditions</label>
                            <textarea name="chronic_conditions" rows="3" placeholder="List any chronic medical conditions..." class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-slate-200">
                    <button type="button" onclick="closeRegistrationForm()" class="px-4 py-2 text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Register Patient
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- QR Code Modal -->
<div id="qr-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg max-w-md w-full">
            <div class="p-6 border-b border-slate-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Patient QR Code</h3>
                    <button onclick="closeQRModal()" class="text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-6 text-center">
                <div class="mb-4">
                    <img id="qr-code-image" src="" alt="Patient QR Code" class="mx-auto">
                </div>
                <div id="qr-patient-info" class="text-sm text-gray-600">
                    <!-- Patient info will be shown here -->
                </div>
                <div class="mt-4 text-xs text-gray-500">
                    This QR code can be used for quick patient identification and registration.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Load initial data
document.addEventListener('DOMContentLoaded', function() {
    loadPatientStats();
    loadPatientList();
});

function loadPatientStats() {
    fetch('/hms/patient-registration/stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-patients').textContent = data.total_patients;
            document.getElementById('registered-today').textContent = data.registered_today;
            document.getElementById('admitted-patients').textContent = data.admitted_patients;
            document.getElementById('discharged-today').textContent = data.discharged_today;
        });
}

function loadPatientList(page = 1) {
    fetch(`/hms/patient-registration?page=${page}`)
        .then(response => response.text())
        .then(html => {
            // This would normally update the patient list
            // For now, we'll just show a loading state
            console.log('Patient list loaded');
        });
}

function showRegistrationForm() {
    document.getElementById('registration-modal').classList.remove('hidden');
}

function closeRegistrationForm() {
    document.getElementById('registration-modal').classList.add('hidden');
    document.getElementById('registration-form').reset();
}

function showQRModal(patientData, qrCode) {
    document.getElementById('qr-code-image').src = 'data:image/png;base64,' + qrCode;
    document.getElementById('qr-patient-info').innerHTML = `
        <strong>${patientData.full_name}</strong><br>
        MRN: ${patientData.mrn}<br>
        Phone: ${patientData.phone}
    `;
    document.getElementById('qr-modal').classList.remove('hidden');
}

function closeQRModal() {
    document.getElementById('qr-modal').classList.add('hidden');
}

function searchPatients() {
    const query = document.getElementById('search-input').value;
    if (query.length < 2) return;
    
    fetch(`/hms/patient-registration/search?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(patients => {
            // Update patient list with search results
            console.log('Search results:', patients);
        });
}

function refreshPatientList() {
    loadPatientStats();
    loadPatientList();
}

// Handle registration form submission
document.getElementById('registration-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    fetch('/hms/patient-registration', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            closeRegistrationForm();
            showQRModal(result.patient, result.qr_code);
            loadPatientStats();
            loadPatientList();
        } else {
            // Handle validation errors
            console.error('Registration failed:', result.errors);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Search on Enter key
document.getElementById('search-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchPatients();
    }
});
</script>
@endsection
