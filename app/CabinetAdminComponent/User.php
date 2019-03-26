<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\User as Base;

class User extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roles', 'email', 'phone', 'password', 'enabled', 'type', 'password', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
