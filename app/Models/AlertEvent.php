<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlertEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'alert_id',
        'occurred_at',
        'type',
        'actor_type',
        'actor_id',
        'notes',
        'metadata',
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
        'metadata' => 'array',
    ];

    /** @return BelongsTo<Alert, AlertEvent> */
    public function alert(): BelongsTo
    {
        return $this->belongsTo(Alert::class);
    }
}
