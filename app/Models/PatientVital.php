<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientVital extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_id',
        'measured_at',
        'hr',
        'spo2',
        'rr',
        'temp_c',
        'sbp',
        'dbp',
    ];

    protected $casts = [
        'measured_at' => 'datetime',
    ];

    /** @return BelongsTo<Patient, PatientVital> */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /** @return BelongsTo<PatientAdmission, PatientVital> */
    public function admission(): BelongsTo
    {
        return $this->belongsTo(PatientAdmission::class, 'admission_id');
    }
}
