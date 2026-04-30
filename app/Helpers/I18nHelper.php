<?php

/**
 * StepNow Rides — bilingual helper.
 *
 * Single helper used in every Blade view to pick the right language column.
 * German is the legal source of truth; English is a courtesy fallback.
 *
 * Usage in Blade:
 *     {{ tr($slider, 'title') }}
 *     {!! tr($about, 'description') !!}
 *
 * Logic:
 *   - locale === 'en' AND ${field}_en is non-empty  →  return ${field}_en
 *   - otherwise                                      →  return $field
 *
 * Works with Eloquent models, stdClass (DB::table results), and arrays.
 */
if (!function_exists('tr')) {
    function tr($model, string $field): ?string
    {
        if (!$model) {
            return null;
        }

        $locale  = app()->getLocale();
        $enField = $field . '_en';

        // Resolve German default
        $de = is_array($model)
            ? ($model[$field] ?? null)
            : ($model->{$field} ?? null);

        if ($locale !== 'en') {
            return $de;
        }

        // English requested — try to read EN column
        $en = is_array($model)
            ? ($model[$enField] ?? null)
            : ($model->{$enField} ?? null);

        return filled($en) ? $en : $de;
    }
}
