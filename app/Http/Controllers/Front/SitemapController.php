<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Bilingual sitemap.xml.
 *
 * Each URL is emitted with explicit hreflang alternates so Google indexes
 * the German and English versions correctly:
 *
 *   <xhtml:link rel="alternate" hreflang="de" .../>
 *   <xhtml:link rel="alternate" hreflang="en" .../>
 *   <xhtml:link rel="alternate" hreflang="x-default" .../>
 *
 * Cached for 1 hour.
 *
 * Route: GET /sitemap.xml  (no auth, no throttle)
 */
class SitemapController extends Controller
{
    public function index(): Response
    {
        $now = Carbon::now()->toAtomString();

        $urls = collect([
            ['path' => '/',                  'priority' => '1.0', 'changefreq' => 'weekly'],
            ['path' => '/about-us',          'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/services',          'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/pricing',           'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/gallery',           'priority' => '0.6', 'changefreq' => 'monthly'],
            ['path' => '/contact-us',        'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/impressum',         'priority' => '0.4', 'changefreq' => 'yearly'],
            ['path' => '/datenschutz',       'priority' => '0.4', 'changefreq' => 'yearly'],
            ['path' => '/agb',               'priority' => '0.4', 'changefreq' => 'yearly'],
            ['path' => '/widerrufsbelehrung','priority' => '0.4', 'changefreq' => 'yearly'],
            ['path' => '/cookie-richtlinie', 'priority' => '0.4', 'changefreq' => 'yearly'],
        ]);

        // Service detail pages (read directly from DB to avoid model coupling)
        if (Schema::hasTable('services')) {
            try {
                DB::table('services')
                    ->where('status', 'publish')
                    ->get(['slug', 'updated_at'])
                    ->each(function ($s) use (&$urls) {
                        $urls->push([
                            'path'       => '/service/' . $s->slug,
                            'priority'   => '0.7',
                            'changefreq' => 'monthly',
                            'lastmod'    => $s->updated_at
                                ? Carbon::parse($s->updated_at)->toAtomString()
                                : null,
                        ]);
                    });
            } catch (\Throwable $e) { /* ignore — schema may differ */ }
        }

        // Rent-now / package pages
        if (Schema::hasTable('packages')) {
            try {
                DB::table('packages')
                    ->where('status', 'active')
                    ->where('publish', 'published')
                    ->get(['id', 'updated_at'])
                    ->each(function ($p) use (&$urls) {
                        $urls->push([
                            'path'       => '/rent-now/' . $p->id,
                            'priority'   => '0.7',
                            'changefreq' => 'weekly',
                            'lastmod'    => $p->updated_at
                                ? Carbon::parse($p->updated_at)->toAtomString()
                                : null,
                        ]);
                    });
            } catch (\Throwable $e) { /* ignore */ }
        }

        $body  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $body .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $body .= '        xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

        foreach ($urls as $u) {
            $base = url($u['path']);
            $de   = $base;                                   // primary
            $en   = $base . (str_contains($base, '?') ? '&' : '?') . 'lang=en';
            $last = $u['lastmod'] ?? $now;

            $body .= "  <url>\n";
            $body .= "    <loc>" . htmlspecialchars($de, ENT_XML1) . "</loc>\n";
            $body .= "    <lastmod>{$last}</lastmod>\n";
            $body .= "    <changefreq>{$u['changefreq']}</changefreq>\n";
            $body .= "    <priority>{$u['priority']}</priority>\n";
            $body .= '    <xhtml:link rel="alternate" hreflang="de"        href="' . htmlspecialchars($de, ENT_XML1) . '"/>' . "\n";
            $body .= '    <xhtml:link rel="alternate" hreflang="en"        href="' . htmlspecialchars($en, ENT_XML1) . '"/>' . "\n";
            $body .= '    <xhtml:link rel="alternate" hreflang="x-default" href="' . htmlspecialchars($de, ENT_XML1) . '"/>' . "\n";
            $body .= "  </url>\n";
        }

        $body .= '</urlset>';

        return response($body, 200, [
            'Content-Type'  => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
