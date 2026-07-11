<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@studio.com',
                'password' => 'admin123',
                'role' => 'admin',
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@studio.com',
                'password' => 'kasir123',
                'role' => 'kasir',
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@studio.com',
                'password' => 'owner123',
                'role' => 'owner',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                ]
            );
        }
    }
}
