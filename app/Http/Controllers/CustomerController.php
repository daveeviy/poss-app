<?php

namespace App\Http\Controllers;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = [
            ['id' => 1, 'name' => 'Juan Dela Cruz', 'email' => 'juan@example.com', 'contact' => '09171234567'],
            ['id' => 2, 'name' => 'Maria Santos', 'email' => 'maria@example.com', 'contact' => '09182345678'],
            ['id' => 3, 'name' => 'Pedro Penduko', 'email' => 'pedro@example.com', 'contact' => '09193456789'],
            ['id' => 4, 'name' => 'Ana Reyes', 'email' => 'ana@example.com', 'contact' => '09204567890'],
            ['id' => 5, 'name' => 'Mark Dizon', 'email' => 'mark@example.com', 'contact' => '09215678901'],
        ];

        return view('customers', compact('customers'));
    }
}