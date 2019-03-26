<?php

namespace App\CabinetAdminComponent\Http\Middleware;

use Closure;

class SetDefaultGuard
{
    public function handle($request, Closure $next, $guard)
    {
        config(['auth.defaults.guard' => $guard]);
        return $next($request);
    }
}
