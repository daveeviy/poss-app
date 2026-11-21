<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'full_name' => 'Juan Dela Cruz',
                'email' => 'juan.delacruz@example.com',
                'phone' => '09171234567',
            ],
            [
                'full_name' => 'Maria Santos',
                'email' => 'maria.santos@example.com',
                'phone' => '09189876543',
            ],
            [
                'full_name' => 'Jose Rizal',
                'email' => 'jose.rizal@example.com',
                'phone' => '09201112233',
            ],
            [
                'full_name' => 'Clara Reyes',
                'email' => 'clara.reyes@example.com',
                'phone' => '09214445566',
            ],
            [
                'full_name' => 'Andres Bonifacio',
                'email' => 'andres.bonifacio@example.com',
                'phone' => '09227778899',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(
                ['email' => $customer['email']],
                [
                    'full_name' => $customer['full_name'],
                    'phone' => $customer['phone'],
                ]
            );
        }
    }
}