<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'pos_users';

    protected $fillable = [
        'username',
        'full_name',
        'email',
        'password',
        'avatar',
    ];
}