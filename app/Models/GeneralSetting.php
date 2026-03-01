<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_name',
        'timezone',
        'locale',
        'maintenance_mode',
        'data_retention_policy',
        'alerts_enabled',
        'default_severity',
        'metadata',
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
        'alerts_enabled' => 'boolean',
        'metadata' => 'array',
    ];
}
