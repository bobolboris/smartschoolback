<?php

namespace App\CabinetParentsComponent;

use App\MainComponent\ChildKey as Base;

class ChildKey extends Base
{
    public function child()
    {
        return $this->hasOne(Child::class, 'id', 'child_id');
    }
}
