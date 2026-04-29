<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

/**
 * Renders the legally required pages from the `policies` table.
 *
 * Bilingual logic:
 *   if (locale === 'en' AND description_en non-empty)
 *       → serve description_en + page_title_en
 *   else
 *       → serve description + page_title  (German, legally authoritative)
 *
 * Single source of truth: PolicySeeder writes the rows; this controller
 * reads them. To update legal wording:
 *
 *   php artisan db:seed --class=Database\\Seeders\\PolicySeeder --force
 */
class PolicyController extends Controller
{
    public function impressum()
    {
        return $this->render('Impressum');
    }

    public function datenschutz()
    {
        return $this->render('Datenschutzerklärung');
    }

    public function agb()
    {
        return $this->render('Allgemeine Geschäftsbedingungen');
    }

    public function widerruf()
    {
        return $this->render('Widerrufsbelehrung');
    }

    public function cookies()
    {
        return $this->render('Cookie-Richtlinie');
    }

    private function render(string $title)
    {
        $policy = DB::table('policies')
            ->where('title', $title)
            ->where('status', 'active')
            ->first();

        if (!$policy) {
            abort(404);
        }

        $locale = App::getLocale();

        if ($locale === 'en' && filled($policy->description_en ?? null)) {
            return view('front.pages.policy', [
                'page_title'  => $policy->page_title_en ?: $policy->title,
                'description' => $policy->description_en,
            ]);
        }

        return view('front.pages.policy', [
            'page_title'  => $policy->page_title ?: $policy->title,
            'description' => $policy->description,
        ]);
    }
}
