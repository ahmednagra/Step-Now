<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Newsletter subscriber row.
 *
 * Lifecycle:
 *   - Created via Front\NewsletterController@store with confirmation_token
 *     and confirmed_at = NULL  (PENDING)
 *   - confirmed_at is set once the user clicks the DOI confirmation link
 *     (ACTIVE)
 *   - Soft-deleted via Front\NewsletterController@unsubscribe
 *     (UNSUBSCRIBED — kept in DB so we can prove past consent)
 *
 * Use the `active` scope when picking subscribers to send to, so PENDING
 * rows are never mailed (this is the whole point of Double-Opt-In).
 */
class Newsletter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'confirmation_token',
        'confirmed_at',
        'ip_address',
        'user_agent',
        'status',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    /**
     * Only confirmed (DOI-completed) subscribers may receive newsletters.
     */
    public function scopeActive($query)
    {
        return $query->whereNotNull('confirmed_at')->where('status', 1);
    }
}
