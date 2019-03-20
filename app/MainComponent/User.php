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
 * @property mixed parent
 * @property mixed child
 * @property mixed admin
 * @property mixed settings
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
