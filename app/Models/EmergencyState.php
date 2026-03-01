<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyState extends Model
{
    use HasFactory;

    protected $fillable = [
        'override_enabled',
        'override_reason',
        'override_enabled_at',
        'surge_mode_enabled',
        'surge_level',
        'extra_capacity_beds',
        'surge_enabled_at',
        'lockdown_enabled',
        'lockdown_scope',
        'lockdown_enabled_at',
        'lockdown_reason',
    ];

    protected $casts = [
        'override_enabled' => 'boolean',
        'override_enabled_at' => 'datetime',
        'surge_mode_enabled' => 'boolean',
        'surge_enabled_at' => 'datetime',
        'lockdown_enabled' => 'boolean',
        'lockdown_enabled_at' => 'datetime',
    ];
}
