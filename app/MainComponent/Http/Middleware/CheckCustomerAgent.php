<?php

namespace App\MainComponent\Http\Middleware;

use Closure;

class CheckCustomerAgent
{
    public function handle($request, Closure $next)
    {
        if (!$request->hasHeader('Customer-User-Agent')) {
            return response()->json(['ok' => false, 'errors' => ['Отсутствует User-Agent клиента']]);
        }
        return $next($request);
    }
}
