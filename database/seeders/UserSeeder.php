<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
    ['email' => 'admin@admin.com'], // search by unique field
    [
        'name' => 'Admin',
        'password' => bcrypt('password'),
        'user_type' => 'admin',
        'icon' => 'icon',
        'phone_no' => '+923758365729',
        'status' => 'approved',
        'whatsapp_no' => '+923758365729',
        'address' => 'Gujranwala',
    ]
);
//         User::updateOrCreate(
//     ['email' => 'zameerhassanshah69@gmail.com'], // search by unique field
//     [
//         'name' => 'Admin',
//         'password' => bcrypt('password'),
//         'user_type' => 'admin',
//         'icon' => 'icon',
//         'phone_no' => '+923758365729',
//         'status' => 'approved',
//         'whatsapp_no' => '+923758365729',
//         'address' => 'Gujranwala',
//     ]
// );


User::updateOrCreate(
    ['email' => 'user@user.com'], // search by unique field
    [
        'name' => 'User',
        'password' => bcrypt('password'),
        'user_type' => 'user',
        'icon' => 'icon',
        'phone_no' => '+923758365729',
        'status' => 'approved',
        'whatsapp_no' => '+923758365729',
        'address' => 'Gujranwala',
    ]
);
    }
}