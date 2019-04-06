<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\Access as Base;

class Access extends Base
{
    public function child()
    {
        return $this->hasOne(Child::class, 'id', 'child_id');
    }

    public function accessPoint()
    {
        return $this->hasOne(AccessPoint::class, 'id', 'access_point_id');
    }
}
