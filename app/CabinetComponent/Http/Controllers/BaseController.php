<?php

namespace App\CabinetComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    protected function baseLoad()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->entity->children;
        return ['parent' => $user->entity];
    }
}
