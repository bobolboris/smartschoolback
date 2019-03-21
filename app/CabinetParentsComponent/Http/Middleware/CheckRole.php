<?php

namespace App\CabinetParentsComponent\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next, $roles)
    {
        if(!$request->user()->hasOneRoles($roles)){
            return response()->json(['ok' => false, 'status' => 403, 'errors' => ['У вас нет прав чтобы просматривать данную страницу']]);
        }
        return $next($request);
    }
}
