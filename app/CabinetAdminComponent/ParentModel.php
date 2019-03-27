<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\ParentModel as Base;

class ParentModel extends Base
{
    public function children()
    {
        return $this->belongsToMany(Child::class, 'children_parents', 'parent_id', 'child_id');
    }
}
