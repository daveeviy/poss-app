<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin_pos',
                'full_name' => 'Admin User',
                'email' => 'admin.pos@example.com',
                'password' => Hash::make('Password123!'),
            ],
            [
                'username' => 'cashier_01',
                'full_name' => 'Cashier One',
                'email' => 'cashier01@example.com',
                'password' => Hash::make('Password123!'),
            ],
            [
                'username' => 'cashier_02',
                'full_name' => 'Cashier Two',
                'email' => 'cashier02@example.com',
                'password' => Hash::make('Password123!'),
            ],
            [
                'username' => 'staff_inv',
                'full_name' => 'Inventory Staff',
                'email' => 'staff.inv@example.com',
                'password' => Hash::make('Password123!'),
            ],
            [
                'username' => 'supervisor_01',
                'full_name' => 'Shift Supervisor',
                'email' => 'supervisor01@example.com',
                'password' => Hash::make('Password123!'),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['username' => $user['username']],
                [
                    'full_name' => $user['full_name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                ]
            );
        }
    }
}