<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_id',
        'bed_id',
        'name',
        'type',
        'firmware_version',
        'last_calibration_date',
        'status',
        'last_seen_at',
        'settings',
    ];

    protected $casts = [
        'last_calibration_date' => 'date',
        'last_seen_at' => 'datetime',
        'settings' => 'array',
    ];

    /**
     * @return BelongsTo<Ward, Device>
     */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    /**
     * @return BelongsTo<Bed, Device>
     */
    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }

    /**
     * @return HasMany<DeviceMaintenanceLog>
     */
    public function maintenanceLogs(): HasMany
    {
        return $this->hasMany(DeviceMaintenanceLog::class);
    }

    /**
     * @return HasMany<DeviceCommand>
     */
    public function commands(): HasMany
    {
        return $this->hasMany(DeviceCommand::class);
    }
}
