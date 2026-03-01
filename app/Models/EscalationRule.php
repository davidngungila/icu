<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EscalationRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'enabled',
        'severity',
        'category',
        'ward_id',
        'ack_timeout_minutes',
        'resolve_timeout_minutes',
        'notify_channels',
        'notify_targets',
        'priority',
        'metadata',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'metadata' => 'array',
    ];

    /** @return BelongsTo<Ward, EscalationRule> */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }
}
