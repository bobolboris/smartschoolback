<?php

namespace App\CabinetParentsComponent;

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

    public function parent()
    {
        return $this->hasOne(ParentModel::class, 'user_id', 'id');
    }

    public function child()
    {
        return $this->hasOne(Child::class, 'user_id', 'id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id', 'id');
    }

    public function settings()
    {
        return $this->hasMany(Setting::class, 'user_id', 'id');
    }
}
