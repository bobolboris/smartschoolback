<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed surname
 * @property mixed name
 * @property mixed patronymic
 */
class Profile extends Model
{
    public $timestamps = false;
    protected $table = 'profiles';
    protected $fillable = ['surname', 'name', 'patronymic'];
    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return "$this->surname $this->name $this->patronymic";
    }

    public function child()
    {
        return $this->hasOne(Child::class, 'profile_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Profile::class, 'profile_id', 'id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'profile_id', 'id');
    }
}
