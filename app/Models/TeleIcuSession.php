<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeleIcuSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_id',
        'started_at',
        'ended_at',
        'remote_site',
        'clinician',
        'status',
        'link',
        'notes',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /** @return BelongsTo<Patient, TeleIcuSession> */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
