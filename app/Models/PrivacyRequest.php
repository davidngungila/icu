<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrivacyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_type',
        'subject_identifier',
        'status',
        'notes',
        'requested_at',
        'completed_at',
        'handled_by_user_id',
        'metadata',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'completed_at' => 'datetime',
        'metadata' => 'array',
    ];

    /** @return BelongsTo<User, PrivacyRequest> */
    public function handledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by_user_id');
    }
}
