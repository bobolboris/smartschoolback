<?php

namespace App\CabinetParentsComponent;

use App\MainComponent\Setting as Base;

class Setting extends Base
{
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
