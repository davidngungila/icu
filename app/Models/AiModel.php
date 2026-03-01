<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'provider',
        'model_key',
        'status',
        'risk_level',
        'requires_human_review',
        'temperature',
        'max_tokens',
        'guardrails',
        'metadata',
    ];

    protected $casts = [
        'requires_human_review' => 'boolean',
        'guardrails' => 'array',
        'metadata' => 'array',
    ];
}
