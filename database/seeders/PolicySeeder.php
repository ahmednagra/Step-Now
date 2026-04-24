<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolicySeeder extends Seeder
{
    public function run(): void
    {
        $policies = [
            [
                'id' => 1,
                'title' => 'Privacy Policy',
                'page_title' => 'Privacy Policy',
                'description' => <<<'EOT'
<p data-start="140" data-end="158"><strong data-start="140" data-end="158">Privacy Policy</strong></p>
<ul data-start="160" data-end="1386"><li data-start="160" data-end="325">
<p data-start="162" data-end="325">We collect personal information such as your name, email address, phone number, course preferences, and any details you submit through enquiry forms or WhatsApp.</p>
</li><li data-start="326" data-end="493">
<p data-start="328" data-end="493">Information is used to process your enquiries, guide you with course options, complete your admission process, provide study materials, and offer customer support.</p>
</li><li data-start="494" data-end="638">
<p data-start="496" data-end="638">We may use your data to send important updates, reminders, study material links, and promotional offers related to our educational services.</p>
</li><li data-start="639" data-end="833">
<p data-start="641" data-end="833">Your personal information is <strong data-start="670" data-end="684">never sold</strong> to third parties. It is only shared with trusted service providers who help us deliver our classes, payment processing, or communication services.</p>
</li><li data-start="834" data-end="967">
<p data-start="836" data-end="967">We use cookies and analytics tools to understand website performance, improve user experience, and enhance our marketing efforts.</p>
</li><li data-start="968" data-end="1094">
<p data-start="970" data-end="1094">All data is stored securely, and we follow strict measures to protect your information from unauthorized access or misuse.</p>
</li><li data-start="1095" data-end="1203">
<p data-start="1097" data-end="1203">You may request access, correction, or deletion of your data at any time by contacting our support team.</p>
</li><li data-start="1204" data-end="1304">
<p data-start="1206" data-end="1304">Continued use of this website means you agree to the practices described in this Privacy Policy.</p>
</li><li data-start="1305" data-end="1386">
<p data-start="1307" data-end="1386">We may update this policy when needed; any changes will be posted on this page.</p></li></ul>
EOT,
                'order_no' => 1,
                'status' => 'active',
                'created_at' => '2025-11-14 14:45:08',
                'updated_at' => '2025-11-15 14:08:47',
            ],
            [
                'id' => 2,
                'title' => 'Terms & Conditions',
                'page_title' => 'Terms & Conditions',
                'description' => <<<'EOT'
<p data-start="101" data-end="123"><strong data-start="101" data-end="123">Terms &amp; Conditions</strong></p>
<ul data-start="125" data-end="1516"><li data-start="125" data-end="262">
<p data-start="127" data-end="262">By using this website and enrolling in any course, you agree to follow all rules, policies, and guidelines set by BestQualityEdu.com.</p>
</li><li data-start="263" data-end="380">
<p data-start="265" data-end="380">All course details, fees, and schedules are subject to change based on university guidelines or internal updates.</p>
</li><li data-start="381" data-end="489">
<p data-start="383" data-end="489">Enrollment is confirmed only after completing the required documentation and fee payments as instructed.</p>
</li><li data-start="490" data-end="628">
<p data-start="492" data-end="628">Students are responsible for providing accurate information during registration, including name, contact details, and selected course.</p>
</li><li data-start="629" data-end="771">
<p data-start="631" data-end="771">Study materials, online classes, and recorded lessons are provided solely for personal use and must not be shared, copied, or distributed.</p>
</li><li data-start="772" data-end="937">
<p data-start="774" data-end="937">Certificates and degrees are issued by the respective universities. BestQualityEdu.com acts only as a facilitator for guidance, support, and learning assistance.</p>
</li><li data-start="938" data-end="1049">
<p data-start="940" data-end="1049">Refunds, if applicable, follow specific university or institute rules and may vary depending on the course.</p>
</li><li data-start="1050" data-end="1157">
<p data-start="1052" data-end="1157">Monthly installment plans must be paid on time; delays may affect access to classes or study materials.</p>
</li><li data-start="1158" data-end="1281">
<p data-start="1160" data-end="1281">We are not responsible for delays caused by external authorities, universities, or technical issues beyond our control.</p>
</li><li data-start="1282" data-end="1398">
<p data-start="1284" data-end="1398">Misuse of the website, false information, or abusive behaviour may lead to permanent cancellation of enrollment.</p>
</li><li data-start="1399" data-end="1516">
<p data-start="1401" data-end="1516">By continuing to use this website, you accept these Terms &amp; Conditions and agree to any updates made in the future.</p></li></ul><p><br></p>
EOT,
                'order_no' => 2,
                'status' => 'active',
                'created_at' => '2025-11-15 14:09:33',
                'updated_at' => '2025-11-15 14:09:33',
            ],
            [
                'id' => 3,
                'title' => 'Cookie Policy',
                'page_title' => 'Cookie Policy',
                'description' => <<<'EOT'
<p data-start="113" data-end="130"><strong data-start="113" data-end="130">Cookie Policy</strong></p>
<ul data-start="132" data-end="999"><li data-start="132" data-end="244">
<p data-start="134" data-end="244"><strong data-start="134" data-end="155">What Are Cookies:</strong> Cookies are small files stored on your device to help improve your website experience.</p>
</li><li data-start="245" data-end="387">
<p data-start="247" data-end="387"><strong data-start="247" data-end="270">Purpose of Cookies:</strong> We use cookies to enhance site performance, remember user preferences, analyze traffic, and optimize our services.</p>
</li><li data-start="388" data-end="597">
<p data-start="390" data-end="418"><strong data-start="390" data-end="416">Types of Cookies Used:</strong></p>
<ul data-start="421" data-end="597"><li data-start="421" data-end="468">
<p data-start="423" data-end="468">Essential cookies for website functionality</p>
</li><li data-start="471" data-end="528">
<p data-start="473" data-end="528">Analytics cookies to track usage and improve services</p>
</li><li data-start="531" data-end="597">
<p data-start="533" data-end="597">Optional marketing cookies to show relevant content and offers</p>
</li></ul>
</li><li data-start="598" data-end="733">
<p data-start="600" data-end="733"><strong data-start="600" data-end="624">Third-Party Cookies:</strong> Some features may use trusted third-party services (like Google Analytics) that may set their own cookies.</p>
</li><li data-start="734" data-end="899">
<p data-start="736" data-end="899"><strong data-start="736" data-end="757">Managing Cookies:</strong> You can choose to disable cookies via your browser settings. Note that some website features may not work properly if cookies are disabled.</p>
</li><li data-start="900" data-end="999">
<p data-start="902" data-end="999"><strong data-start="902" data-end="914">Consent:</strong> By using our website, you agree to our use of cookies as described in this policy.</p></li></ul><p><br></p>
EOT,
                'order_no' => 3,
                'status' => 'active',
                'created_at' => '2025-11-15 14:10:24',
                'updated_at' => '2025-11-15 14:10:24',
            ],
            [
                'id' => 4,
                'title' => 'GDPR Notice',
                'page_title' => 'GDPR Notice',
                'description' => <<<'EOT'
<p data-start="106" data-end="123"><strong data-start="106" data-end="121">GDPR Notice</strong></p>
<ul data-start="125" data-end="1472"><li data-start="125" data-end="232">
<p data-start="127" data-end="232"><strong data-start="127" data-end="147">Data Controller:</strong> Best Quality Education (bestqualityedu.com) is responsible for your personal data.</p>
</li><li data-start="233" data-end="384">
<p data-start="235" data-end="384"><strong data-start="235" data-end="254">Data Collected:</strong> We may collect your name, email, phone number, course preferences, uploaded documents, and communication via WhatsApp or forms.</p>
</li><li data-start="385" data-end="571">
<p data-start="387" data-end="571"><strong data-start="387" data-end="413">Purpose of Processing:</strong> Your data is used to process enrollments, provide study materials, communicate updates, improve services, and for marketing purposes (if consent is given).</p>
</li><li data-start="572" data-end="700">
<p data-start="574" data-end="700"><strong data-start="574" data-end="590">Legal Basis:</strong> We process your data with your consent, for performance of a contract, or to comply with legal obligations.</p>
</li><li data-start="701" data-end="865">
<p data-start="703" data-end="865"><strong data-start="703" data-end="720">Data Sharing:</strong> Your personal information is only shared with trusted service providers (universities, payment processors, analytics tools) and is never sold.</p>
</li><li data-start="866" data-end="995">
<p data-start="868" data-end="995"><strong data-start="868" data-end="887">Data Retention:</strong> We store your personal data only as long as necessary to provide services and fulfill legal requirements.</p>
</li><li data-start="996" data-end="1202">
<p data-start="998" data-end="1027"><strong data-start="998" data-end="1025">Your Rights under GDPR:</strong></p>
<ul data-start="1030" data-end="1202"><li data-start="1030" data-end="1059">
<p data-start="1032" data-end="1059">Access your personal data</p>
</li><li data-start="1062" data-end="1109">
<p data-start="1064" data-end="1109">Request correction or deletion of your data</p>
</li><li data-start="1112" data-end="1144">
<p data-start="1114" data-end="1144">Withdraw consent at any time</p>
</li><li data-start="1147" data-end="1171">
<p data-start="1149" data-end="1171">Object to processing</p>
</li><li data-start="1174" data-end="1202">
<p data-start="1176" data-end="1202">Request data portability</p>
</li></ul>
</li><li data-start="1203" data-end="1334">
<p data-start="1205" data-end="1334"><strong data-start="1205" data-end="1227">How to Contact Us:</strong> For any GDPR-related requests, contact:<br data-start="1267" data-end="1270">
<strong data-start="1272" data-end="1282">Email:</strong> <a data-start="1283" data-end="1306" class="decorated-link cursor-pointer" rel="noopener">info@bestqualityedu.com<span aria-hidden="true" class="ms-0.5 inline-block align-middle leading-none"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-rtl-flip="" class="block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]"></svg></span></a></p></li></ul>
EOT,
                'order_no' => 4,
                'status' => 'active',
                'created_at' => '2025-11-15 14:11:33',
                'updated_at' => '2025-11-15 14:11:33',
            ],
            [
                'id' => 5,
                'title' => 'Anti-Money Laundering (AML) Policy',
                'page_title' => 'Anti-Money Laundering (AML) Policy',
                'description' => <<<'EOT'
<p data-start="173" data-end="213"><strong data-start="173" data-end="211">Anti-Money Laundering (AML) Policy</strong></p>
<ul data-start="215" data-end="1418"><li data-start="215" data-end="392">
<p data-start="217" data-end="392"><strong data-start="217" data-end="229">Purpose:</strong> Best Quality Education is committed to preventing any form of money laundering or terrorist financing in compliance with UAE laws and international regulations.</p>
</li><li data-start="393" data-end="527">
<p data-start="395" data-end="527"><strong data-start="395" data-end="405">Scope:</strong> This policy applies to all students, staff, and third-party partners who make or receive payments through our platform.</p>
</li><li data-start="528" data-end="714">
<p data-start="530" data-end="714"><strong data-start="530" data-end="556">Customer Verification:</strong> We may require verification of identity (KYC) for all students enrolling in courses, including government-issued ID, contact details, and proof of payment.</p>
</li><li data-start="715" data-end="871">
<p data-start="717" data-end="871"><strong data-start="717" data-end="740">Payment Monitoring:</strong> All transactions are monitored for suspicious activity, unusual payment patterns, or transactions involving high-risk countries.</p>
</li><li data-start="872" data-end="1012">
<p data-start="874" data-end="1012"><strong data-start="874" data-end="908">Reporting Suspicious Activity:</strong> Any suspicious activity will be reported to the relevant authorities in accordance with UAE AML laws.</p>
</li><li data-start="1013" data-end="1139">
<p data-start="1015" data-end="1139"><strong data-start="1015" data-end="1043">Prohibited Transactions:</strong> Cash or third-party payments intended to conceal the origin of funds are strictly prohibited.</p>
</li><li data-start="1140" data-end="1277">
<p data-start="1142" data-end="1277"><strong data-start="1142" data-end="1167">Staff Responsibility:</strong> All employees and agents must follow this AML Policy and report any concerns immediately to the management.</p>
</li><li data-start="1278" data-end="1418">
<p data-start="1280" data-end="1418"><strong data-start="1280" data-end="1304">Compliance &amp; Review:</strong> This policy is regularly reviewed and updated to ensure compliance with applicable AML laws and best practices.</p>
</li></ul>
<p data-start="1420" data-end="1513"><strong data-start="1420" data-end="1432">Contact:</strong><br data-start="1432" data-end="1435">
For any questions regarding this policy, contact <strong data-start="1484" data-end="1511"><a data-start="1486" data-end="1509" class="decorated-link cursor-pointer" rel="noopener">info@bestqualityedu.com<span aria-hidden="true" class="ms-0.5 inline-block align-middle leading-none"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-rtl-flip="" class="block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]"></svg></span></a></strong></p><p><br></p>
EOT,
                'order_no' => 5,
                'status' => 'active',
                'created_at' => '2025-11-15 14:13:02',
                'updated_at' => '2025-11-15 14:13:02',
            ],
            [
                'id' => 6,
                'title' => 'Legal Compliance Policy',
                'page_title' => 'Legal Compliance Policy',
                'description' => <<<'EOT'
<p data-start="124" data-end="153"><strong data-start="124" data-end="151">Legal Compliance Policy</strong></p>
<ul data-start="155" data-end="1311"><li data-start="155" data-end="318">
<p data-start="157" data-end="318"><strong data-start="157" data-end="169">Purpose:</strong> Best Quality Education is committed to adhering to all applicable laws, regulations, and industry standards to ensure ethical and legal operation.</p>
</li><li data-start="319" data-end="426">
<p data-start="321" data-end="426"><strong data-start="321" data-end="331">Scope:</strong> This policy applies to all employees, students, partners, and third-party service providers.</p>
</li><li data-start="427" data-end="582">
<p data-start="429" data-end="582"><strong data-start="429" data-end="459">Education &amp; Accreditation:</strong> We comply with all university and accreditation requirements, including UGC, AICTE, NAAC, DEB, AIU, and IAU regulations.</p>
</li><li data-start="583" data-end="758">
<p data-start="585" data-end="758"><strong data-start="585" data-end="615">Data Protection &amp; Privacy:</strong> We follow local and international data protection laws, including GDPR and UAE data privacy requirements, to safeguard personal information.</p>
</li><li data-start="759" data-end="888">
<p data-start="761" data-end="888"><strong data-start="761" data-end="786">Financial Compliance:</strong> All payments, transactions, and refunds follow applicable financial and anti-money laundering laws.</p>
</li><li data-start="889" data-end="1020">
<p data-start="891" data-end="1020"><strong data-start="891" data-end="917">Intellectual Property:</strong> All content, study materials, and digital resources respect copyright laws and licensing agreements.</p>
</li><li data-start="1021" data-end="1173">
<p data-start="1023" data-end="1173"><strong data-start="1023" data-end="1048">Reporting Violations:</strong> Any employee or stakeholder who becomes aware of a legal or regulatory violation must report it immediately to management.</p>
</li><li data-start="1174" data-end="1311">
<p data-start="1176" data-end="1311"><strong data-start="1176" data-end="1198">Continuous Review:</strong> This policy is reviewed regularly to ensure ongoing compliance with new laws, regulations, and best practices.</p>
</li></ul>
<p data-start="1313" data-end="1419"><strong data-start="1313" data-end="1325">Contact:</strong><br data-start="1325" data-end="1328">
For questions about this policy or compliance matters, email: <strong data-start="1390" data-end="1417"><a data-start="1392" data-end="1415" class="decorated-link cursor-pointer" rel="noopener">info@bestqualityedu.com<span aria-hidden="true" class="ms-0.5 inline-block align-middle leading-none"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-rtl-flip="" class="block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]"></svg></span></a></strong></p><p><br></p>
EOT,
                'order_no' => 6,
                'status' => 'active',
                'created_at' => '2025-11-15 14:14:01',
                'updated_at' => '2025-11-15 14:14:01',
            ],
            [
                'id' => 7,
                'title' => 'Corporate Social Responsibility (CSR) Policy',
                'page_title' => 'Corporate Social Responsibility (CSR) Policy',
                'description' => <<<'EOT'
<p data-start="157" data-end="207"><strong data-start="157" data-end="205">Corporate Social Responsibility (CSR) Policy</strong></p>
<ul data-start="209" data-end="1223"><li data-start="209" data-end="370">
<p data-start="211" data-end="370"><strong data-start="211" data-end="223">Purpose:</strong> Best Quality Education is committed to contributing positively to society by supporting education, skill development, and community empowerment.</p>
</li><li data-start="371" data-end="725">
<p data-start="373" data-end="391"><strong data-start="373" data-end="389">Focus Areas:</strong></p>
<ul data-start="394" data-end="725"><li data-start="394" data-end="499">
<p data-start="396" data-end="499"><strong data-start="396" data-end="417">Education Access:</strong> Promote online learning for working professionals and underprivileged learners.</p>
</li><li data-start="502" data-end="609">
<p data-start="504" data-end="609"><strong data-start="504" data-end="526">Skill Development:</strong> Provide resources and programs to enhance employability and professional growth.</p>
</li><li data-start="612" data-end="725">
<p data-start="614" data-end="725"><strong data-start="614" data-end="636">Community Support:</strong> Engage in initiatives that create social impact and awareness about lifelong learning.</p>
</li></ul>
</li><li data-start="726" data-end="880">
<p data-start="728" data-end="880"><strong data-start="728" data-end="754">Sustainable Practices:</strong> Operate in a responsible and ethical manner, ensuring environmental, social, and economic sustainability in all activities.</p>
</li><li data-start="881" data-end="993">
<p data-start="883" data-end="993"><strong data-start="883" data-end="901">Collaboration:</strong> Partner with universities, NGOs, and educational institutions to expand reach and impact.</p>
</li><li data-start="994" data-end="1115">
<p data-start="996" data-end="1115"><strong data-start="996" data-end="1023">Monitoring &amp; Reporting:</strong> Regularly assess the outcomes of CSR initiatives and report achievements to stakeholders.</p>
</li><li data-start="1116" data-end="1223">
<p data-start="1118" data-end="1223"><strong data-start="1118" data-end="1143">Employee Involvement:</strong> Encourage staff participation in social initiatives and educational programs.</p>
</li></ul>
<p data-start="1225" data-end="1320"><strong data-start="1225" data-end="1237">Contact:</strong><br data-start="1237" data-end="1240">
For CSR-related inquiries or collaboration, email: <strong data-start="1291" data-end="1318"><a data-start="1293" data-end="1316" class="decorated-link cursor-pointer" rel="noopener">info@bestqualityedu.com<span aria-hidden="true" class="ms-0.5 inline-block align-middle leading-none"><svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-rtl-flip="" class="block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]"></svg></span></a></strong></p><p><br></p>
EOT,
                'order_no' => 7,
                'status' => 'active',
                'created_at' => '2025-11-15 14:14:50',
                'updated_at' => '2025-11-15 14:14:50',
            ],
        ];

        foreach ($policies as $row) {
            DB::table('policies')->updateOrInsert(['id' => $row['id']], $row);
        }
    }
}
