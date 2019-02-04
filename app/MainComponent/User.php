<?php

namespace App\MainComponent;

/**
 * @property mixed id
 * @property mixed roles
 * @property mixed email
 * @property mixed phone
 * @property mixed password
 * @property mixed enabled
 * @property mixed type
 */
class User extends UserJWT
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
    protected $hidden = [

    ];

    public function entity()
    {
        return $this->hasOne('App\MainComponent\Parents', 'user_id', 'id');
    }

    public function setting()
    {
        return $this->hasOne('App\MainComponent\Setting', 'user_id', 'id');
    }

    public function smsCodes()
    {
        return $this->hasMany('App\MainComponent\Session', 'user_id', 'id');
    }
}
