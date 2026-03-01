<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientWaveform extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_id',
        'captured_at',
        'type',
        'samples',
        'sample_rate_hz',
    ];

    protected $casts = [
        'captured_at' => 'datetime',
        'samples' => 'array',
    ];

    /** @return BelongsTo<Patient, PatientWaveform> */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
