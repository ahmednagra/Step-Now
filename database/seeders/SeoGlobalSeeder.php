<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoGlobal;

class SeoGlobalSeeder extends Seeder
{
        public function run(): void
    {
        SeoGlobal::firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'My Website',
                'default_meta_title' => 'Welcome to My Website',
                'default_meta_description' => 'This is the default meta description',
                'default_meta_keywords' => 'website, laravel, seo',
                'default_meta_image' => null,
                'global_canonical' => null,
                'robots_default' => 'index,follow',
                'robots_txt' => null,
                'google_site_verification' => null,
                'bing_site_verification' => null,
                'sitemap_enabled' => true,
                'sitemap_urls' => json_encode([]),
                'google_analytics_id' => null,
                'google_tag_manager_id' => null,
                'facebook_pixel_id' => null,
                'other_tracking_scripts' => null,
                'default_og_type' => 'website',
                'default_twitter_card' => 'summary_large_image',
                'structured_data_global' => null,
                'global_header_scripts' => null,
                'global_body_end_scripts' => null,
            ]
        );
    }
}
