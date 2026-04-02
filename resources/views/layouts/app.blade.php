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
        <script src="{{ asset('build/assets/app-DYJnTmM6.js') }}" defer></script>
        <script src="{{ asset('build/assets/icu-menu-D6cUZvEj.js') }}" defer></script>
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-900">
        <aside id="icuSidebar" class="bg-white border-r border-slate-200/80 transition-[width] duration-200 ease-out">
            <x-icu.sidebar :menus="$menus" :page="$page" :role-label="$roleLabel" />
        </aside>

        <header class="icu-topbar">
            <x-icu.topbar :title="$title" :roles="$roles" :role="$role" />
        </header>

        <div class="icu-main">
            <main class="icu-content">
                @yield('content')

                <footer class="icu-footer">
                    <div class="space-y-1 text-center">
                        <div class="text-sm font-medium">© 2026 AfyaSmart HMS. All Rights Reserved.</div>
                        <div class="text-xs text-slate-500">Compliant with PDPA (Tanzania), TMDA &amp; International Medical Device Standards.</div>
                        <div class="text-xs text-slate-500">Secure • Encrypted • Reliable • Life-Critical Infrastructure</div>
                    </div>
                </footer>
            </main>
        </div>
    </body>
</html>
