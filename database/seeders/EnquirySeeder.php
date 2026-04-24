<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnquirySeeder extends Seeder
{
    public function run(): void
    {
        $enquiries = [
            [
                'id'              => 1,
                'name'            => 'Hafiz',
                'email'           => 'attamuhammad619@gmail.com',
                'phone_no'        => '0044 753 450 3523',
                'subject'         => 'Walk the Path of Faith — Join the Sacred Journey 2025 and Relive the Prophet’s ﷺ Hijrah',
                'enquiry_message' => 'af asf d sf',
                'course_name'     => null,
                'course_id'       => null,
                'status'          => 'pending',
                'type'            => 'general',
                'followup_date'   => null,
                'followup_type'   => null,
                'remarks'         => null,
                'created_at'      => '2025-11-14 07:25:22',
                'updated_at'      => '2025-11-14 07:25:22',
                'deleted_at'      => null,
            ],
            [
                'id'              => 2,
                'name'            => 'ahmad',
                'email'           => 'aneef123@gmail.com',
                'phone_no'        => '234567',
                'subject'         => '23456',
                'enquiry_message' => 'r43f43f4e',
                'course_name'     => null,
                'course_id'       => null,
                'status'          => 'pending',
                'type'            => 'general',
                'followup_date'   => null,
                'followup_type'   => null,
                'remarks'         => null,
                'created_at'      => '2025-11-14 12:00:28',
                'updated_at'      => '2025-11-14 12:00:28',
                'deleted_at'      => null,
            ],
            [
                'id'              => 3,
                'name'            => 'ali',
                'email'           => 'Ali@gmail.com',
                'phone_no'        => '+971 50 40 6786',
                'subject'         => 'want to enroll',
                'enquiry_message' => 'af asdfasd f',
                'course_name'     => null,
                'course_id'       => null,
                'status'          => 'pending',
                'type'            => 'general',
                'followup_date'   => '2025-11-14',
                'followup_type'   => 'call',
                'remarks'         => null,
                'created_at'      => '2025-11-16 08:31:07',
                'updated_at'      => '2025-11-16 08:32:58',
                'deleted_at'      => null,
            ],
        ];

        foreach ($enquiries as $row) {
            DB::table('enquiries')->updateOrInsert(['id' => $row['id']], $row);
        }

        $comments = [
            [
                'id'          => 1,
                'enquiry_id'  => 3,
                'user_id'     => 1,
                'comment'     => 'call him after 2 days',
                'created_at'  => '2025-11-16 08:31:48',
                'updated_at'  => null,
            ],
            [
                'id'          => 2,
                'enquiry_id'  => 3,
                'user_id'     => 1,
                'comment'     => 'need some resources about web',
                'created_at'  => '2025-11-16 08:32:06',
                'updated_at'  => null,
            ],
        ];

        foreach ($comments as $row) {
            DB::table('enquiry_comments')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
