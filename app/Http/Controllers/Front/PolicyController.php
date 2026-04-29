<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * Renders the legally required pages from the `policies` table.
 *
 * Single source of truth: rows are written by Database\Seeders\PolicySeeder.
 * To update wording in production, edit PolicySeeder and re-seed:
 *
 *   php artisan db:seed --class=Database\\Seeders\\PolicySeeder --force
 *
 * The controller looks rows up by `title` (not by `id`) so the DB rows
 * can be re-ordered without breaking the front routes.
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

    /**
     * Fetch the active policy row by title and render it through
     * resources/views/front/pages/policy.blade.php.
     */
    private function render(string $title)
    {
        $policy = DB::table('policies')
            ->where('title', $title)
            ->where('status', 'active')
            ->first();

        if (!$policy) {
            abort(404);
        }

        return view('front.pages.policy', [
            'page_title'  => $policy->page_title ?: $policy->title,
            'description' => $policy->description,
        ]);
    }
}
