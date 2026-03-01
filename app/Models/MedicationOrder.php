<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicationOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_id',
        'ordered_at',
        'drug_name',
        'dose',
        'route',
        'frequency',
        'status',
        'ordered_by',
        'notes',
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
    ];

    /** @return BelongsTo<Patient, MedicationOrder> */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
