<?php

namespace App\AuthComponent;

use App\MainComponent\User as Base;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserJWT extends Base implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
