<?php

namespace App\Models\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

    class Admin extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'admins';

        protected $fillable = [
            'name','email','is_super','password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
}
