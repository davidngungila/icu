<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'AfyaSmart HMS') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700" rel="stylesheet" />
    <link href="{{ asset('build/assets/app-1M3QmWyX.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/icu-menu-KNd2QRD8.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <!-- HMS Navigation -->
    <x-hms.navigation />

    <!-- HMS Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <!-- HMS Footer -->
    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="text-sm text-slate-600">
                    © {{ date('Y') }} AfyaSmart HMS. All rights reserved.
                </div>
                <div class="text-sm text-slate-600">
                    Version 1.0.0 | Built with Laravel
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('build/assets/app-DYJnTmM6.js') }}" defer></script>
    <script src="{{ asset('build/assets/icu-menu-D6cUZvEj.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
