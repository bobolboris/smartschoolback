<?php

namespace App\MainComponent\Http\Middleware;

use Closure;

class CheckCustomerIP
{
    public function handle($request, Closure $next)
    {
        if (!$request->hasHeader('Customer-IP')) {
            return response()->json(['ok' => false, 'errors' => ['Отсутствует IP клиента']]);
        }
        return $next($request);
    }
}
