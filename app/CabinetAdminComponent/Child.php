<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\Child as Base;

class Child extends Base
{
    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }

    public function parents()
    {
        return $this->belongsToMany(ParentModel::class, 'children_parents', 'child_id', 'parent_id');
    }

    public function class()
    {
        return $this->hasOne(ClassModel::class, 'id', 'class_id');
    }

    public function key()
    {
        return $this->hasOne(ChildKey::class, 'child_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function photo()
    {
        return $this->hasOne(Photo::class, 'id', 'photo_id');
    }
}
