<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(SettingsTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CookiesSeeder::class);
         $this->call(PrivacyPolicySeeder::class);
         $this->call(TermsAndConditionSeeder::class);
         $this->call(SeoGlobalSeeder::class);
         $this->call(CourseSeeder::class);

        // $this->call(PagesTableSeeder::class);
        
        
        // $this->call(TeamSeeder::class);
        // $this->call(CompanyJobSeeder::class);
        // $this->call(IndustryJobSeeder::class);
        //  $this->call(JobCountrySeeder::class);
        // $this->call(JobCitySeeder::class);
        // $this->call(JobTypeSeeder::class);
        // $this->call(JobExperienceSeeder::class);
        $this->call(FacilityManagmentSeeder::class);
        







    }
}
