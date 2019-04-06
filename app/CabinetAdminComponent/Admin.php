<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\Admin as Base;

class Admin extends Base
{
    protected $with = ['user'];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function school()
    {
        return $this->hasOne(School::class, 'id','school_id');
    }

    public function locality()
    {
        return $this->hasOne(Locality::class,  'id', 'locality_id');
    }

    public function class()
    {
        return $this->hasOne(ClassModel::class, 'admin_id', 'id');
    }
}
