<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'status',
        'cpu_usage',
        'ram_usage',
        'disk_usage',
        'temperature',
        'db_qps',
        'measured_at',
    ];

    protected $casts = [
        'measured_at' => 'datetime',
    ];
}
