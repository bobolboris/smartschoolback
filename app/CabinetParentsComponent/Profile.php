<?php

namespace App\CabinetParentsComponent;

use App\MainComponent\Profile as Base;

class Profile extends Base
{
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
