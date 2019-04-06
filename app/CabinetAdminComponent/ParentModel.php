<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\ParentModel as Base;

class ParentModel extends Base
{
    public function profile()
    {
        return $this->hasOne(Profile::class, 'id','profile_id');
    }

    public function children()
    {
        return $this->belongsToMany(Child::class, 'children_parents', 'parent_id', 'child_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,  'id', 'user_id');
    }

    public function additional_parents()
    {
        return $this->hasMany(ParentModel::class, 'parent_id', 'id');
    }
}
