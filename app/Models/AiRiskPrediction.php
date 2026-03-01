<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiRiskPrediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_id',
        'predicted_at',
        'model',
        'risk_score',
        'risk_level',
        'top_factors',
        'recommendation',
    ];

    protected $casts = [
        'predicted_at' => 'datetime',
        'top_factors' => 'array',
    ];

    /** @return BelongsTo<Patient, AiRiskPrediction> */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
