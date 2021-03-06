<?php

namespace App\CabinetParentsComponent\Http\Controllers;

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
        $user->parent->children;
        $user->parent->is_senior = $user->hasRole('СтаршийРодитель');
        return ['parent' => $user->parent];
    }

    protected function baseAction()
    {
        return response()->json(['ok' => true, 'data' => $this->baseLoad()]);
    }
}
