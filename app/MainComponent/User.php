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
        'roles', 'email', 'phone', 'password', 'enabled', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function entity()
    {
        return $this->hasOne(ParentModel::class, 'user_id', 'id');
    }

    public function setting()
    {
        return $this->hasOne(Setting::class, 'user_id', 'id');
    }
}
