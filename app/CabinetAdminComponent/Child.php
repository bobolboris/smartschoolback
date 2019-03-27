<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\Child as Base;

class Child extends Base
{
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}
