<?php

namespace App\CabinetAdminComponent;

use App\MainComponent\Photo as Base;

class Photo extends Base
{
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
