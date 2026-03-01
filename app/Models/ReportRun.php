<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportRun extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_template_id',
        'status',
        'requested_at',
        'started_at',
        'completed_at',
        'rows',
        'output_format',
        'filters',
        'notes',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'filters' => 'array',
    ];

    /** @return BelongsTo<ReportTemplate, ReportRun> */
    public function template(): BelongsTo
    {
        return $this->belongsTo(ReportTemplate::class, 'report_template_id');
    }
}
