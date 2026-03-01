<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplianceControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'framework',
        'control_code',
        'title',
        'description',
        'status',
        'enabled',
        'last_checked_at',
        'owner',
        'evidence_link',
        'metadata',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'last_checked_at' => 'datetime',
        'metadata' => 'array',
    ];
}
