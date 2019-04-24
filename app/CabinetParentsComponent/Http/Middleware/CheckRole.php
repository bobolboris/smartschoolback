<?php

namespace App\CabinetParentsComponent\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckRole
{
    public function handle($request, Closure $next, $roles)
    {
        if ($request->user() == null){
            JWTAuth::parseToken()->authenticate();
        }
        if (!$request->user()->hasOneRoles($roles)) {
            return response()->json(['ok' => false, 'status' => 403, 'errors' => ['У вас нет прав чтобы просматривать данную страницу']]);
        }
        return $next($request);
    }
}
