<?php

namespace App\CabinetParentsComponent;

use App\MainComponent\AccessDenial as Base;

class AccessDenial extends Base
{
    public function key()
    {
        return $this->hasOne(ChildKey::class, 'id', 'key_id');
    }

    public function accessPoint()
    {
        return $this->hasOne(AccessPoint::class, 'id', 'access_point_id');
    }
}
