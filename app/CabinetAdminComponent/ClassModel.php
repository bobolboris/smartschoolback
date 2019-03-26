<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\ClassModel as Base;

class ClassModel extends Base
{
    protected $with = ['school', 'admin'];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id','admin_id');
    }
}
