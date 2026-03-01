<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'status',
        'description',
        'definition',
    ];

    protected $casts = [
        'definition' => 'array',
    ];

    /** @return HasMany<ReportRun> */
    public function runs(): HasMany
    {
        return $this->hasMany(ReportRun::class);
    }
}
