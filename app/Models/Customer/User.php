<?php

namespace App\Models\Customer;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

    class User extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'users';

        protected $fillable = [
            'name','user_name','email','is_active','password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }