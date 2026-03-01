<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'mrn',
        'full_name',
        'sex',
        'dob',
        'phone',
        'national_id',
        'status',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    /** @return HasMany<PatientAdmission> */
    public function admissions(): HasMany
    {
        return $this->hasMany(PatientAdmission::class);
    }

    /** @return HasMany<PatientVital> */
    public function vitals(): HasMany
    {
        return $this->hasMany(PatientVital::class);
    }

    /** @return HasMany<LabResult> */
    public function labResults(): HasMany
    {
        return $this->hasMany(LabResult::class);
    }

    /** @return HasMany<MedicationOrder> */
    public function medicationOrders(): HasMany
    {
        return $this->hasMany(MedicationOrder::class);
    }

    /** @return HasMany<AiRiskPrediction> */
    public function riskPredictions(): HasMany
    {
        return $this->hasMany(AiRiskPrediction::class);
    }

    /** @return HasMany<TeleIcuSession> */
    public function teleIcuSessions(): HasMany
    {
        return $this->hasMany(TeleIcuSession::class);
    }
}
