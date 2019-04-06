<?php

namespace App\CabinetParentsComponent;

use App\MainComponent\ClassModel as Base;

class ClassModel extends Base
{
    protected $with = ['school', 'admin'];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id','admin_id');
    }

    public function school()
    {
        return $this->hasOne(School::class, 'id','school_id');
    }

    public function children()
    {
        return $this->hasMany(Child::class,  'class_id', 'id');
    }
}
