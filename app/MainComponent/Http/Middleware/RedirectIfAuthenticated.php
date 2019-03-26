<?php

namespace App\MainComponent\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    use RedirectsUsers;

    protected function redirectTo()
    {
        return route('cabinet.admin.index');
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect($this->redirectPath());
        }


        return $next($request);
    }
}
