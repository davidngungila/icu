<!-- HMS Navigation Component -->
<nav class="bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center font-semibold mr-3">AS</div>
                    <h1 class="text-xl font-bold text-slate-900">AfyaSmart HMS</h1>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('hms.dashboard.index') }}" class="border-emerald-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('hms.patient-registration.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Patients
                    </a>
                    <a href="{{ route('hms.appointments.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Appointments
                    </a>
                    <a href="{{ route('hms.triage.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Triage
                    </a>
                    <a href="{{ route('icu.page', ['page' => 'admin/command-center']) }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                        </svg>
                        ICU System
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <button type="button" class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Quick Actions
                    </button>
                </div>
                <div class="ml-3 relative">
                    <div class="flex items-center">
                        <button class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500" id="user-menu-button">
                            <span class="sr-only">Open user menu</span>
                            <div class="w-8 h-8 rounded-full bg-slate-300 flex items-center justify-center">
                                <span class="text-sm font-medium">{{ auth()->user()->name[0] ?? 'U' }}</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile menu -->
<div class="sm:hidden" id="mobile-menu">
    <div class="pt-2 pb-3 space-y-1">
        <a href="{{ route('hms.dashboard.index') }}" class="bg-emerald-50 border-emerald-500 text-emerald-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            Dashboard
        </a>
        <a href="{{ route('hms.patient-registration.index') }}" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            Patients
        </a>
        <a href="{{ route('hms.appointments.index') }}" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            Appointments
        </a>
        <a href="{{ route('hms.triage.index') }}" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            Triage
        </a>
        <a href="{{ route('icu.page', ['page' => 'admin/command-center']) }}" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
            </svg>
            ICU System
        </a>
    </div>
</div>
