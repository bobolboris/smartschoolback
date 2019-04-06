<?php

namespace App\ReceiverComponent;

use App\MainComponent\User as Base;

/**
 * @property mixed id
 * @property mixed roles
 * @property mixed email
 * @property mixed phone
 * @property mixed password
 * @property mixed enabled
 * @property mixed type
 * @property mixed roles_array
 * @property mixed settings
 */
class User extends Base
{
    public function settings()
    {
        return $this->hasMany(Setting::class, 'user_id', 'id');
    }
}
