<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecuritySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'mfa_required_for_admin',
        'ip_allowlist_enabled',
        'ip_allowlist',
        'session_timeout_minutes',
        'max_failed_logins_per_hour',
        'encryption_at_rest',
        'encryption_in_transit',
        'audit_logging_enabled',
        'audit_retention_days',
        'password_policy',
    ];

    protected $casts = [
        'mfa_required_for_admin' => 'boolean',
        'ip_allowlist_enabled' => 'boolean',
        'encryption_at_rest' => 'boolean',
        'encryption_in_transit' => 'boolean',
        'audit_logging_enabled' => 'boolean',
    ];
}
