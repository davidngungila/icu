<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    private function layoutData(Request $request, string $page, string $title): array
    {
        $role = $request->session()->get('icu_role', 'admin');

        $roles = config('icu.roles', []);
        if (! array_key_exists($role, $roles)) {
            $role = 'admin';
            $request->session()->put('icu_role', $role);
        }

        $menus = config("icu.menus.$role", []);

        return [
            'role' => $role,
            'roleLabel' => $roles[$role] ?? $role,
            'roles' => $roles,
            'menus' => $menus,
            'page' => $page,
            'title' => $title,
        ];
    }

    public function show(Request $request)
    {
        return view('profile.show', array_merge(
            $this->layoutData($request, 'profile', 'Profile'),
            ['user' => $request->user()]
        ));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'department' => ['nullable', 'string', 'max:100'],
            'title' => ['nullable', 'string', 'max:100'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('profile_photo')) {
            $user = $request->user();

            if ($user->profile_photo_path) {
                try {
                    Storage::disk('public')->delete($user->profile_photo_path);
                } catch (\Throwable $e) {
                    // ignore
                }
            }

            $path = $request->file('profile_photo')->store('avatars', 'public');
            $validated['profile_photo_path'] = $path;
        }

        $request->user()->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function account(Request $request)
    {
        return view('profile.account', array_merge(
            $this->layoutData($request, 'settings/account', 'Account Settings'),
            ['user' => $request->user()]
        ));
    }

    public function updateAccount(Request $request)
    {
        $validated = $request->validate([
            'language' => ['nullable', 'string', 'in:en,sw'],
            'timezone' => ['nullable', 'string', 'max:50'],
            'date_format' => ['nullable', 'string', 'in:Y-m-d,m/d/Y,d/m/Y'],
            'time_format' => ['nullable', 'string', 'in:24h,12h'],
            'theme' => ['nullable', 'string', 'in:light,dark,auto'],
            'notifications_email' => ['boolean'],
            'notifications_push' => ['boolean'],
            'notifications_sms' => ['boolean'],
        ]);

        $request->user()->update($validated);

        return back()->with('success', 'Account settings updated successfully.');
    }

    public function security(Request $request)
    {
        $user = $request->user();

        $setup = null;
        if (! $user->two_factor_enabled && $user->two_factor_secret) {
            $issuer = config('app.name', 'ICU');
            $label = $user->email;
            $secret = $user->two_factor_secret;
            $otpAuth = $this->totpUri($issuer, $label, $secret);

            $setup = [
                'issuer' => $issuer,
                'label' => $label,
                'secret' => $secret,
                'otpauth' => $otpAuth,
            ];
        }

        return view('profile.security', array_merge(
            $this->layoutData($request, 'settings/security', 'Security'),
            [
                'user' => $user,
                'totpSetup' => $setup,
            ]
        ));
    }

    public function startTotp(Request $request)
    {
        $user = $request->user();

        if ($user->two_factor_enabled) {
            return back()->with('success', 'Authenticator App is already enabled.');
        }

        $secret = $this->generateBase32Secret(20);

        $user->forceFill([
            'two_factor_secret' => $secret,
            'two_factor_enabled' => false,
        ])->save();

        return redirect()->route('settings.security')->with('success', 'Scan the setup key in your authenticator app, then confirm the 6-digit code.');
    }

    public function confirmTotp(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'regex:/^\d{6}$/'],
        ]);

        $user = $request->user();
        if (! $user->two_factor_secret) {
            return back()->withErrors(['code' => 'Start setup first.']);
        }

        if (! $this->verifyTotp($user->two_factor_secret, $validated['code'], 1)) {
            return back()->withErrors(['code' => 'Invalid code. Please try again.']);
        }

        $user->forceFill([
            'two_factor_enabled' => true,
        ])->save();

        return redirect()->route('settings.security')->with('success', 'Authenticator App enabled successfully.');
    }

    public function disableTotp(Request $request)
    {
        $user = $request->user();

        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_enabled' => false,
        ])->save();

        return redirect()->route('settings.security')->with('success', 'Authenticator App disabled.');
    }

    private function totpUri(string $issuer, string $label, string $secret): string
    {
        $issuerEnc = rawurlencode($issuer);
        $labelEnc = rawurlencode($label);

        return "otpauth://totp/{$issuerEnc}:{$labelEnc}?secret=" . rawurlencode($secret) . "&issuer={$issuerEnc}&algorithm=SHA1&digits=6&period=30";
    }

    private function generateBase32Secret(int $length = 20): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = '';
        for ($i = 0; $i < $length; $i++) {
            $secret .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }
        return $secret;
    }

    private function base32Decode(string $b32): string
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $b32 = strtoupper(preg_replace('/[^A-Z2-7]/', '', $b32) ?? '');

        $bits = '';
        $out = '';

        for ($i = 0; $i < strlen($b32); $i++) {
            $val = strpos($alphabet, $b32[$i]);
            if ($val === false) {
                continue;
            }
            $bits .= str_pad(decbin($val), 5, '0', STR_PAD_LEFT);
        }

        for ($i = 0; $i + 8 <= strlen($bits); $i += 8) {
            $out .= chr(bindec(substr($bits, $i, 8)));
        }

        return $out;
    }

    private function totp(string $secretBase32, int $timestamp, int $period = 30, int $digits = 6): string
    {
        $counter = intdiv($timestamp, $period);
        $key = $this->base32Decode($secretBase32);

        $binCounter = pack('N*', 0) . pack('N*', $counter);
        $hash = hash_hmac('sha1', $binCounter, $key, true);

        $offset = ord(substr($hash, -1)) & 0x0F;
        $part = substr($hash, $offset, 4);
        $value = unpack('N', $part)[1] & 0x7FFFFFFF;

        $mod = 10 ** $digits;
        $code = str_pad((string) ($value % $mod), $digits, '0', STR_PAD_LEFT);
        return $code;
    }

    private function verifyTotp(string $secretBase32, string $code, int $window = 1): bool
    {
        $now = time();
        for ($w = -$window; $w <= $window; $w++) {
            $ts = $now + ($w * 30);
            if (hash_equals($this->totp($secretBase32, $ts), $code)) {
                return true;
            }
        }

        return false;
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
