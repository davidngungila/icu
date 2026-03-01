<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'latency_ms',
        'packet_loss_pct',
        'switch_status',
        'vlan_integrity',
        'firewall_status',
        'measured_at',
    ];

    protected $casts = [
        'measured_at' => 'datetime',
    ];
}
