<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Blog Categories
        DB::table('bcategories')->updateOrInsert(
            ['id' => 1],
            [
                'name'          => 'Online Education',
                'description'   => null,
                'slug'          => 'Online-Education',
                'status'        => 1,
                'serial_number' => 1,
                'created_at'    => '2025-11-12 17:28:30',
                'updated_at'    => '2025-11-12 18:18:37',
            ]
        );

        // Blogs
        $blogs = [
            [
                'id'              => 1,
                'bcategory_id'    => 1,
                'title'           => 'Why Online Education is the Future for Working Professionals',
                'content'         => <<<'EOT'
<p data-start="369" data-end="541">Balancing work and study used to be difficult, but now online education makes it possible. You can study anytime, anywhere — without leaving your job.</p>
<p data-start="543" data-end="561"><strong data-start="543" data-end="559">Main Points:</strong></p>
<ul data-start="562" data-end="774"><li data-start="562" data-end="609">
<p data-start="564" data-end="609">Flexible schedule that fits your lifestyle.</p>
</li><li data-start="610" data-end="669">
<p data-start="612" data-end="669">Access to study materials and recorded classes anytime.</p>
</li><li data-start="670" data-end="720">
<p data-start="672" data-end="720">Recognized degrees from approved universities.</p>
</li><li data-start="721" data-end="774">
<p data-start="723" data-end="774">Upgrade your qualifications and grow your career.</p>
</li></ul>
<p data-start="776" data-end="890"><strong data-start="776" data-end="791">Conclusion:</strong><br data-start="791" data-end="794">
Online education is not just convenient — it’s the smarter way to move forward in your career.</p><p><br></p>
EOT,
                'slug'            => 'why-online-education-is-the-future-for-working-professionals',
                'image'           => '17629714841964604665.webp',
                'status'          => 1,
                'meta_keywords'   => '[{"value":"one line"}]',
                'meta_description'=> 'Labore ex vel ea dol',
                'serial_number'   => 0,
                'created_at'      => '2025-11-12 17:27:43',
                'updated_at'      => '2025-11-12 18:18:04',
            ],
            [
                'id'              => 2,
                'bcategory_id'    => 1,
                'title'           => 'Fast-Track Degree – A Smart Choice for Busy Professionals',
                'content'         => <<<'EOT'
<p data-start="974" data-end="1100"><br data-start="991" data-end="994">
If you missed completing your degree or want to finish faster, Fast-Track programs are designed for you.</p>
<p data-start="1102" data-end="1120"><strong data-start="1102" data-end="1118">Main Points:</strong></p>
<ul data-start="1121" data-end="1319"><li data-start="1121" data-end="1176">
<p data-start="1123" data-end="1176">Complete your graduation in minimum possible time.</p>
</li><li data-start="1177" data-end="1235">
<p data-start="1179" data-end="1235">100% online learning — no need to attend regular classes.</p>
</li><li data-start="1236" data-end="1281">
<p data-start="1238" data-end="1281">Recognized and government-approved degrees.</p>
</li><li data-start="1282" data-end="1319">
<p data-start="1284" data-end="1319">Best suited for busy professionals.</p>
</li></ul>
<p data-start="1321" data-end="1432"><strong data-start="1321" data-end="1336">Conclusion:</strong><br data-start="1336" data-end="1339">
A Fast-Track degree allows you to save time, upgrade your qualifications, and achieve your career goals faster.</p><p><br></p>
EOT,
                'slug'            => 'fast-track-degree-a-smart-choice-for-busy-professionals',
                'image'           => '17629713091706619895.webp',
                'status'          => 1,
                'meta_keywords'   => null,
                'meta_description'=> null,
                'serial_number'   => 0,
                'created_at'      => '2025-11-12 18:15:09',
                'updated_at'      => '2025-11-12 18:15:09',
            ],
            [
                'id'              => 3,
                'bcategory_id'    => 1,
                'title'           => 'How to Choose the Right Course for Your Career',
                'content'         => <<<'EOT'
<p data-start="2050" data-end="2173">Choosing the right course can change your life. It’s important to pick a program that matches your goals and interests.</p>
<p data-start="2175" data-end="2193"><strong data-start="2175" data-end="2191">Main Points:</strong></p>
<ul data-start="2194" data-end="2323"><li data-start="2194" data-end="2229">
<p data-start="2196" data-end="2229">Understand your career path.</p>
</li><li data-start="2230" data-end="2269">
<p data-start="2232" data-end="2269">Choose a recognized institution.</p>
</li><li data-start="2270" data-end="2323">
<p data-start="2271" data-end="2323">Prefer online classes that fit your work schedule.</p>
</li></ul>
<p data-start="2325" data-end="2432"><strong data-start="2325" data-end="2340">Conclusion:</strong><br data-start="2340" data-end="2343">
A well-chosen program helps you gain skills, recognition, and better job opportunities.</p><p><br></p>
EOT,
                'slug'            => 'how-to-choose-the-right-course-for-your-career',
                'image'           => '17629713561370664969.webp',
                'status'          => 0,
                'meta_keywords'   => null,
                'meta_description'=> null,
                'serial_number'   => 0,
                'created_at'      => '2025-11-12 18:15:56',
                'updated_at'      => '2025-11-12 18:15:56',
            ],
        ];

        foreach ($blogs as $row) {
            DB::table('blogs')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
