<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Replaces the legacy UAE-services-oriented PagesTableSeeder with the current
 * page_categories / pages data as it exists in the StepNow Rides production DB.
 */
class PagesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('page_categories')->updateOrInsert(
            ['id' => 1],
            [
                'title'            => 'website-pages',
                'description'      => 'website-pages',
                'hero_title'       => null,
                'hero_sub_title'   => null,
                'hero_description' => null,
                'slug'             => 'website-pages',
                'image'            => null,
                'icon'             => null,
                'hero_image'       => 'assets/admin/img/page_category/hero_image/1762969476772796727.jpg',
                'status'           => 'draft',
                'order_no'         => 1,
                'meta_title'       => null,
                'meta_description' => null,
                'meta_keywords'    => null,
                'created_at'       => '2025-11-12 17:44:36',
                'updated_at'       => '2025-11-12 17:44:36',
                'deleted_at'       => null,
            ]
        );

        DB::table('pages')->updateOrInsert(
            ['id' => 1],
            [
                'page_category_id' => 1,
                'title'            => 'home',
                'description'      => 'website-pages',
                'hero_title'       => null,
                'hero_sub_title'   => null,
                'hero_description' => null,
                'slug'             => 'home',
                'image'            => null,
                'icon'             => null,
                'hero_image'       => 'assets/admin/img/page/hero_image/17629695111589691538.jpg',
                'status'           => 'draft',
                'type'             => 'website',
                'route_name'       => null,
                'page_link_for'    => 'header',
                'order_no'         => 1,
                'meta_title'       => null,
                'meta_description' => null,
                'meta_keywords'    => null,
                'created_at'       => '2025-11-12 17:45:11',
                'updated_at'       => '2025-11-12 17:45:11',
                'deleted_at'       => null,
            ]
        );
    }
}
