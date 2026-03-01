<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlarmSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'night_mode_enabled',
        'night_mode_start',
        'night_mode_end',
        'audible_policy',
        'volume_level',
        'snooze_enabled',
        'snooze_minutes',
        'threshold_overrides',
    ];

    protected $casts = [
        'night_mode_enabled' => 'boolean',
        'snooze_enabled' => 'boolean',
        'threshold_overrides' => 'array',
    ];
}
