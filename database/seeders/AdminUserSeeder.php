<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Main Admin',
                'password' => Hash::make('12345678'), // change after first login
                'role' => User::ROLE_ADMIN ?? 'admin',
            ]
        );
    }
}
