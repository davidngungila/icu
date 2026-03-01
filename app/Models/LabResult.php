<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LabResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'admission_id',
        'resulted_at',
        'panel',
        'test_code',
        'test_name',
        'value',
        'unit',
        'flag',
        'reference_range',
    ];

    protected $casts = [
        'resulted_at' => 'datetime',
    ];

    /** @return BelongsTo<Patient, LabResult> */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
