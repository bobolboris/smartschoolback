<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\ChildParent as Base;

class ChildParent extends Base
{
    public function child()
    {
        return $this->hasOne(Child::class, 'id', 'child_id');
    }

    public function parent()
    {
        return $this->hasOne(ParentModel::class, 'id', 'parent_id');
    }
}
