<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegrationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'enabled',
        'status',
        'endpoint_url',
        'credentials',
        'config',
        'last_sync_at',
        'notes',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'credentials' => 'array',
        'config' => 'array',
        'last_sync_at' => 'datetime',
    ];
}
