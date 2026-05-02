<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Singleton row holding global site settings (logo, phone, email, socials).
 *
 * UPDATED 2026-05-02:
 *   - Added explicit $fillable so updates work properly (was missing,
 *     which made admin updates rely on model property assignment only).
 *   - Added phone_e164 / whatsapp_e164 — canonical E.164 phone numbers
 *     used for tel: links so iOS dialler always works regardless of
 *     how the editor formatted phone_no.
 */
class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'logo',
        'home_beadcrum_img',
        'footer_logo',
        'fav_icon',
        'phone_no',
        'phone_no_2',
        'phone_e164',
        'whatsapp_no',
        'whatsapp_e164',
        'email',
        'address',
        'setting_profile',
        'fb_link',
        'insta_link',
        'yt_link',
        'tiktok_link',
        'linkedin_link',
        'telegram_link',
        'whatsapp_link',
    ];
}
