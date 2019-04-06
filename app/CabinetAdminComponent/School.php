<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\School as Base;

class School extends Base
{
    protected $with = ['locality'];

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'school_id', 'id');
    }

    public function locality()
    {
        return $this->hasOne(Locality::class, 'id', 'locality_id');
    }
}
