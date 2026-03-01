<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login · {{ config('app.name', 'ICU') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-900 flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-semibold">ICU</div>
                    <div>
                        <div class="text-lg font-semibold">ICU System</div>
                        <div class="text-sm text-slate-500">Sign in to continue</div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mt-4 rounded-2xl border border-rose-200/70 bg-rose-50 px-4 py-3 text-rose-800">
                        <div class="font-semibold text-sm">Login failed</div>
                        <div class="mt-1 text-sm">{{ $errors->first() }}</div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="mt-6 space-y-4">
                    @csrf
                    <div>
                        <div class="text-xs text-slate-500">Email</div>
                        <input name="email" value="{{ old('email', 'admin@icu.local') }}" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" autocomplete="username" />
                    </div>

                    <div>
                        <div class="text-xs text-slate-500">Password</div>
                        <input name="password" type="password" class="mt-2 w-full h-11 rounded-xl border border-slate-200/80 bg-white px-3 text-sm" autocomplete="current-password" />
                        <div class="mt-2 text-xs text-slate-500">Seeded admin password is <span class="font-semibold">password</span>.</div>
                    </div>

                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="rounded border-slate-300" />
                        Remember me
                    </label>

                    <button type="submit" class="w-full h-11 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium">Sign in</button>
                </form>
            </div>
        </div>
    </body>
</html>
