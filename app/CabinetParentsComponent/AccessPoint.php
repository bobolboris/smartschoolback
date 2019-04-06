<?php

namespace App\CabinetParentsComponent;

use App\MainComponent\AccessPoint as Base;

class AccessPoint extends Base
{
    protected $with = ['school'];

    public function school()
    {
        return $this->hasOne(School::class, 'id', 'school_id');
    }

    public function access()
    {
        return $this->hasMany(Access::class,  'access_point_id', 'id');
    }
}
