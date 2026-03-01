@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold tracking-tight">Security</h1>
            <div class="text-sm text-slate-500">Manage your password and security settings</div>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200/70 text-emerald-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            <!-- Change Password -->
            <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">Change Password</h2>
                    <form method="POST" action="{{ route('settings.security.password') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium mb-2">Current Password</label>
                            <input type="password" name="current_password" required
                                class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">New Password</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                        </div>

                        <button type="submit" class="px-4 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-sm font-medium">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Two-Factor Authentication -->
            <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">Two-Factor Authentication</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 border border-slate-200/80 rounded-xl">
                            <div>
                                <div class="font-medium">Authenticator App</div>
                                <div class="text-sm text-slate-500">Use an authenticator app to generate one-time codes</div>
                            </div>
                            @if ($user->two_factor_enabled)
                                <form method="POST" action="{{ route('settings.security.totp.disable') }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 rounded-xl border border-slate-200/80 hover:bg-slate-50 text-sm font-medium">
                                        Disable
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('settings.security.totp.start') }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 rounded-xl border border-slate-200/80 hover:bg-slate-50 text-sm font-medium">
                                        Start setup
                                    </button>
                                </form>
                            @endif
                        </div>

                        @if ($user->two_factor_enabled)
                            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200/70 text-emerald-700 text-sm">
                                Authenticator App is enabled for your account.
                            </div>
                        @elseif (!empty($totpSetup))
                            <div class="p-4 border border-slate-200/80 rounded-xl bg-slate-50">
                                <div class="text-sm font-semibold">Setup instructions</div>
                                <div class="mt-2 text-sm text-slate-500">
                                    Add a new account in Google Authenticator / Microsoft Authenticator / Authy.
                                </div>

                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3 items-start">
                                    <div class="p-3 rounded-xl bg-white border border-slate-200/80">
                                        <div class="text-xs text-slate-500">Scan QR code</div>
                                        <div class="mt-2 flex items-center justify-center">
                                            <img
                                                class="w-44 h-44 rounded-xl border border-slate-200/80 bg-white"
                                                alt="TOTP QR code"
                                                src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data={{ urlencode($totpSetup['otpauth']) }}"
                                            />
                                        </div>
                                        <div class="mt-2 text-xs text-slate-500">If your app cannot scan, use the manual key.</div>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="p-3 rounded-xl bg-white border border-slate-200/80">
                                            <div class="text-xs text-slate-500">Manual setup key</div>
                                            <div class="mt-1 font-mono text-sm break-all">{{ $totpSetup['secret'] }}</div>
                                        </div>
                                        <div class="p-3 rounded-xl bg-white border border-slate-200/80">
                                            <div class="text-xs text-slate-500">otpauth URI</div>
                                            <div class="mt-1 font-mono text-xs break-all">{{ $totpSetup['otpauth'] }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="text-sm font-semibold">Confirm code</div>
                                    <div class="mt-1 text-sm text-slate-500">Enter the 6-digit code from your authenticator app to enable 2FA.</div>

                                    <form method="POST" action="{{ route('settings.security.totp.confirm') }}" class="mt-3 flex flex-col sm:flex-row gap-3 sm:items-end">
                                        @csrf
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium mb-2">6-digit code</label>
                                            <input type="text" inputmode="numeric" pattern="\d{6}" maxlength="6" name="code" value="{{ old('code') }}"
                                                class="w-full px-4 py-2 border border-slate-200/80 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400">
                                            @error('code')
                                                <div class="mt-1 text-sm text-rose-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="h-10 px-4 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-sm font-medium">
                                            Enable 2FA
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        <div class="flex items-center justify-between p-4 border border-slate-200/80 rounded-xl">
                            <div>
                                <div class="font-medium">SMS Authentication</div>
                                <div class="text-sm text-slate-500">Receive verification codes via SMS</div>
                            </div>
                            <button class="px-4 py-2 rounded-xl border border-slate-200/80 hover:bg-slate-50 text-sm font-medium">
                                Enable
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Sessions -->
            <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">Active Sessions</h2>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 border border-slate-200/80 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                                    💻
                                </div>
                                <div>
                                    <div class="font-medium">Current Session</div>
                                    <div class="text-sm text-slate-500">{{ request()->ip() }} • {{ request()->userAgent() }}</div>
                                </div>
                            </div>
                            <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Active now</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
