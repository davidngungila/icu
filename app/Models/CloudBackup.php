<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloudBackup extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider',
        'last_backup_at',
        'sync_status',
        'encryption_status',
        'backup_size_mb',
        'last_recovery_test_at',
        'recovery_test_status',
        'notes',
    ];

    protected $casts = [
        'last_backup_at' => 'datetime',
        'last_recovery_test_at' => 'datetime',
    ];
}
