<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Site-wide banners (top-of-page ribbon).
 *
 * Used for the soft-launch / PBefG safety notice and any future business
 * announcements. Editable by admins from the dashboard so that legal copy
 * can be toggled without a code change.
 *
 * Scopes:
 *   SiteBanner::enabled()          — currently active banners
 *   SiteBanner::byKey('soft_launch')
 *
 * Accessors (locale-aware):
 *   $banner->message    — auto-picks message_en or message_de
 *   $banner->cta_label  — auto-picks cta_label_en or cta_label_de
 */
class SiteBanner extends Model
{
    protected $table = 'site_banners';

    protected $fillable = [
        'key_name', 'enabled', 'severity',
        'message_de', 'message_en',
        'cta_label_de', 'cta_label_en', 'cta_url',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function scopeEnabled($q)
    {
        return $q->where('enabled', 1);
    }

    public function scopeByKey($q, string $key)
    {
        return $q->where('key_name', $key);
    }

    /* ---- Locale-aware accessors ----------------------------------------- */

    public function getMessageAttribute(): string
    {
        return app()->getLocale() === 'en' && filled($this->message_en)
            ? (string) $this->message_en
            : (string) $this->message_de;
    }

    public function getCtaLabelAttribute(): ?string
    {
        return app()->getLocale() === 'en' && filled($this->cta_label_en)
            ? $this->cta_label_en
            : $this->cta_label_de;
    }
}
