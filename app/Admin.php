<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'middle_name', 'first_name',  'last_name', 'email', 'password',
    ];
}
