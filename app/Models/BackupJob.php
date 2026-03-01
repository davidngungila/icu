<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'scope',
        'status',
        'requested_at',
        'started_at',
        'completed_at',
        'size_mb',
        'storage',
        'artifact_path',
        'notes',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];
}
