<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'dataset',
        'format',
        'status',
        'requested_at',
        'completed_at',
        'rows',
        'artifact_path',
        'notes',
        'filters',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'completed_at' => 'datetime',
        'filters' => 'array',
    ];
}
