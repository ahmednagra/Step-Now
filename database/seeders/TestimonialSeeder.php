<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'id'          => 1,
                'page_id'     => 1,
                'name'        => 'Ayesha Khan,',
                'feedback'    => 'As a full-time employee, I always thought earning a degree would be impossible. Thanks to their online classes and flexible schedule, I completed my MBA in just one year. The support team was always available whenever I needed help.',
                'designation' => 'MBA Graduate',
                'order_no'    => 1,
                'status'      => 'active',
                'image'       => 'assets/admin/uploads/testimonial/1762969783376865060.webp',
                'created_at'  => '2025-11-12 17:47:32',
                'updated_at'  => '2025-11-12 17:49:43',
            ],
            [
                'id'          => 2,
                'page_id'     => 1,
                'name'        => 'Imran Sheikh',
                'feedback'    => 'The study materials were simple, clear, and easy to follow. I could study after work at my own pace. The degree I received is recognized and helped me get a promotion in my company.',
                'designation' => 'BBA (Regular Program)',
                'order_no'    => 1,
                'status'      => 'active',
                'image'       => 'assets/admin/uploads/testimonial/1763123449481529330.jpg',
                'created_at'  => '2025-11-12 17:50:45',
                'updated_at'  => '2025-11-14 12:30:49',
            ],
            [
                'id'          => 3,
                'page_id'     => 1,
                'name'        => 'Ramesh Patel',
                'feedback'    => 'Completing my graduation online through this platform was one of the best decisions I made. The classes were flexible, the mentors were experienced, and I saved a lot of time.',
                'designation' => 'BA Graduate (Online Learning Program)',
                'order_no'    => 3,
                'status'      => 'active',
                'image'       => 'assets/admin/uploads/testimonial/17631236041224442529.png',
                'created_at'  => '2025-11-12 17:51:44',
                'updated_at'  => '2025-11-14 12:33:24',
            ],
            [
                'id'          => 4,
                'page_id'     => 1,
                'name'        => 'Sana Rahman',
                'feedback'    => 'Being in a full-time job, I needed a fast-track option to complete my degree. This platform made it possible with complete guidance and official university certification.',
                'designation' => 'B.Sc (Fast Track Degree Program)',
                'order_no'    => 4,
                'status'      => 'active',
                'image'       => 'assets/admin/uploads/testimonial/1762969978.webp',
                'created_at'  => '2025-11-12 17:52:58',
                'updated_at'  => '2025-11-12 17:52:58',
            ],
            [
                'id'          => 5,
                'page_id'     => 1,
                'name'        => 'Adnan Hussain',
                'feedback'    => 'I highly recommend their programs to anyone who couldn’t complete their studies earlier. The process was smooth, professional, and completely online.',
                'designation' => 'Diploma in Business Management',
                'order_no'    => 5,
                'status'      => 'active',
                'image'       => 'assets/admin/uploads/testimonial/1763123666977559802.jpg',
                'created_at'  => '2025-11-12 17:53:42',
                'updated_at'  => '2025-11-14 12:34:26',
            ],
        ];

        foreach ($testimonials as $row) {
            DB::table('testimonials')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
