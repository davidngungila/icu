<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeviceCommand extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'command',
        'status',
        'payload',
        'requested_at',
        'processed_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<Device, DeviceCommand>
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
