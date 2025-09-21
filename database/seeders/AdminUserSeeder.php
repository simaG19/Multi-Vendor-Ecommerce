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
            ['email' => 'admin@example.com'],
            [
                'name' => 'Main Admin',
                'password' => Hash::make('password'), // change after first login
                'role' => User::ROLE_ADMIN ?? 'admin',
            ]
        );
    }
}
