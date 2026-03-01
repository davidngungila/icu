<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeviceMaintenanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'kind',
        'scheduled_for',
        'completed_on',
        'status',
        'notes',
    ];

    protected $casts = [
        'scheduled_for' => 'date',
        'completed_on' => 'date',
    ];

    /**
     * @return BelongsTo<Device, DeviceMaintenanceLog>
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
