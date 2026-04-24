<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * UserSeeder — admin + demo user.
 *
 * NOTE: For this seeder to work, the User model's $fillable must include
 * user_type, status, phone_no, whatsapp_no, address, and icon. Otherwise
 * updateOrCreate silently drops those fields.
 *
 * app/Models/User.php should have:
 *
 *   protected $fillable = [
 *       'name', 'email', 'password',
 *       'user_type', 'icon', 'phone_no', 'whatsapp_no', 'address', 'status',
 *   ];
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name'        => 'Naeem Ahmad',
                'password'    => bcrypt('password'),
                'user_type'   => 'admin',
                'icon'        => null,
                'phone_no'    => '+49 159 01228856',
                'whatsapp_no' => '+49 159 01228856',
                'address'     => 'Blumenstraße 8, 73779 Deizisau',
                'status'      => 'approved',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@user.com'],
            [
                'name'        => 'Demo User',
                'password'    => bcrypt('password'),
                'user_type'   => 'user',
                'icon'        => null,
                'phone_no'    => null,
                'whatsapp_no' => null,
                'address'     => null,
                'status'      => 'approved',
            ]
        );
    }
}
