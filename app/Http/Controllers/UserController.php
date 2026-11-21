<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            ['id' => 1, 'username' => 'admin_juan', 'role' => 'Administrator', 'status' => 'Active'],
            ['id' => 2, 'username' => 'cashier_maria', 'role' => 'Cashier', 'status' => 'Active'],
            ['id' => 3, 'username' => 'cashier_pedro', 'role' => 'Cashier', 'status' => 'Inactive'],
            ['id' => 4, 'username' => 'manager_ana', 'role' => 'Manager', 'status' => 'Active'],
            ['id' => 5, 'username' => 'staff_mark', 'role' => 'Staff', 'status' => 'Active'],
        ];

        return view('users', compact('users'));
    }
}