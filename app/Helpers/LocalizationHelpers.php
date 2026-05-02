<?php

/*
 |---------------------------------------------------------------------------
 | step-now.de — Localization helpers
 |---------------------------------------------------------------------------
 | The CMS stores bilingual content as TWO COLUMNS per field:
 |     title          (German — legally authoritative)
 |     title_en       (English — courtesy translation)
 |
 |     description    (German)
 |     description_en (English)
 |
 | Reading rule:
 |     if (locale === 'en' && filled($model->{$field.'_en'}))
 |         → return the English value
 |     else
 |         → return the German value
 |
 | This file replaces the older JSON-array based helper and removes all the
 | per-section localizeXxx() functions that were never actually wired up.
 |
 | Public API:
 |     tr($model, 'title')                  → string
 |     tr_html($model, 'description')       → HtmlString (safe)
 |     trv($germanValue, $englishValue)     → pick either, raw
 |     locale_is('de'|'en')                 → bool
 */

if (!function_exists('tr')) {
    /**
     * Translate a model attribute by convention: <field>_en for English.
     *
     * Falls back to the German column if:
     *   - the active locale is 'de' (or anything that is not 'en')
     *   - the *_en column is missing, null, or an empty string
     *
     * @param  object|array|null $model    Eloquent model, stdClass, or array
     * @param  string            $field    Base field name (German column)
     * @param  string|null       $default  Optional fallback if both are empty
     */
    function tr($model, string $field, ?string $default = ''): string
    {
        if (!$model) {
            return (string) $default;
        }

        $locale = app()->getLocale();
        $de = data_get($model, $field, '');
        $en = data_get($model, $field . '_en', null);

        if ($locale === 'en' && filled($en)) {
            return (string) $en;
        }

        return (string) ($de !== '' ? $de : $default);
    }
}

if (!function_exists('tr_html')) {
    /**
     * Same as tr() but returns an HtmlString, so {!! tr_html($x,'description') !!}
     * stays HTML-safe and Blade does not double-escape.
     */
    function tr_html($model, string $field, ?string $default = ''): \Illuminate\Support\HtmlString
    {
        return new \Illuminate\Support\HtmlString(tr($model, $field, $default));
    }
}

if (!function_exists('trv')) {
    /**
     * Pick between two raw values based on the active locale.
     *
     *     trv('Buchen', 'Book now')
     */
    function trv(?string $german, ?string $english = null): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && filled($english)) {
            return $english;
        }
        return (string) ($german ?? '');
    }
}

if (!function_exists('locale_is')) {
    function locale_is(string $code): bool
    {
        return app()->getLocale() === $code;
    }
}

/*
 |---------------------------------------------------------------------------
 | German-aware money + date formatting
 |---------------------------------------------------------------------------
 */

if (!function_exists('money')) {
    /**
     * German formatting on de_DE: 19,99 € · 1.234,56 €
     * British formatting on en_GB: €19.99
     *
     * Always uses NumberFormatter so the decimal separator, thousands
     * separator, currency symbol and symbol position are correct per locale.
     */
    function money(float|int|string|null $amount, string $currency = 'EUR'): string
    {
        if ($amount === null || $amount === '') {
            return '';
        }
        $amount = (float) $amount;
        $bcp47  = app()->getLocale() === 'en' ? 'en_GB' : 'de_DE';

        if (class_exists(\NumberFormatter::class)) {
            $fmt = new \NumberFormatter($bcp47, \NumberFormatter::CURRENCY);
            return $fmt->formatCurrency($amount, $currency);
        }

        // Defensive fallback (intl extension absent — should never happen on prod)
        return number_format($amount, 2, ',', '.') . "\u{00A0}€";
    }
}

if (!function_exists('formatted_date')) {
    /**
     * 30.04.2026 in DE, 30 April 2026 in EN.
     */
    function formatted_date($value, ?string $format = null): string
    {
        if (!$value) return '';
        $dt = $value instanceof \DateTimeInterface
            ? $value
            : new \DateTimeImmutable((string) $value);

        if ($format) return $dt->format($format);

        return locale_is('en')
            ? $dt->format('j F Y')
            : $dt->format('d.m.Y');
    }
}

if (!function_exists('tel_link')) {
    /**
     * Returns an E.164 phone string suitable for href="tel:..." links.
     * Strips spaces, dashes and parens; converts leading 0 to +49.
     */
    function tel_link(?string $raw): string
    {
        if (!$raw) return '';
        $clean = preg_replace('/[^0-9+]/', '', $raw);
        if (str_starts_with($clean, '00')) $clean = '+' . substr($clean, 2);
        if (str_starts_with($clean, '0'))  $clean = '+49' . substr($clean, 1);
        return $clean;
    }
}
