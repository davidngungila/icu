<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PatientAdmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'ward_id',
        'bed_id',
        'admitted_at',
        'discharged_at',
        'primary_diagnosis',
        'attending_physician',
        'status',
        'metadata',
    ];

    protected $casts = [
        'admitted_at' => 'datetime',
        'discharged_at' => 'datetime',
        'metadata' => 'array',
    ];

    /** @return BelongsTo<Patient, PatientAdmission> */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /** @return BelongsTo<Ward, PatientAdmission> */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    /** @return BelongsTo<Bed, PatientAdmission> */
    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }

    /** @return HasMany<PatientVital> */
    public function vitals(): HasMany
    {
        return $this->hasMany(PatientVital::class, 'admission_id');
    }
}
