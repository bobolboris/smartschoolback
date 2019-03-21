<?php

namespace App\MainComponent;

use App\MainComponent\Traits\RolesTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserJWT extends Authenticatable implements JWTSubject
{
    use Notifiable, RolesTrait;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
