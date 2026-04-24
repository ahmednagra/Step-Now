<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebinarSeeder extends Seeder
{
    /**
     * NOTE: The production dump contained 4 identical webinar rows (ids 1–4)
     * — appears to be an accidental duplicate-insert from the admin UI.
     * This seeder inserts the unique record once. Remove the loop if you
     * want to preserve the original duplicates.
     */
    public function run(): void
    {
        DB::table('webinars')->updateOrInsert(
            ['id' => 1],
            [
                'hostName'     => 'Prof. Sudhakar',
                'topic'        => 'Entrepreneurship Development',
                'meeting_date' => '2025-11-14',
                'start_time'   => '21:00',
                'end_time'     => '23:00',
                'meetingLink'  => 'https://best.mhow.org',
                'banner'       => '1762968878_t6_08bc546fed.jpg',
                'detail'       => 'Entrepreneurship Development',
                'status'       => 1,
                'order_no'     => 1,
                'created_at'   => '2025-11-12 17:34:38',
                'updated_at'   => '2025-11-12 17:34:38',
            ]
        );
    }
}
