<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            ['name' => 'willy', 'email' => 'willoid.webdev+blogproject@gmail.com'],
            ['name' => 'teacher', 'email' => 'willoid.webdev+teacher@gmail.com'],
            ['name' => 'tester', 'email' => 'willoid.webdev+tester@gmail.com'],
        ];

        foreach ($admins as $admin) {
            User::create([
                'name' => $admin['name'],
                'email' => $admin['email'],
                'password' => Hash::make('12345678'),
                'is_admin' => true,
            ]);
        }
    }
}

