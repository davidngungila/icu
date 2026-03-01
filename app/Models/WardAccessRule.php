<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WardAccessRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_id',
        'user_id',
        'role_id',
        'allowed_beds',
        'shift_start',
        'shift_end',
        'reason',
    ];

    /**
     * @return BelongsTo<Ward, WardAccessRule>
     */
    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    /**
     * @return BelongsTo<User, WardAccessRule>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Role, WardAccessRule>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
