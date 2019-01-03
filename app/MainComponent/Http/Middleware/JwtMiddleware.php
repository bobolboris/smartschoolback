<?php

namespace App\MainComponent\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return response()->json(['ok' => false, 'errors' => ['Token is Invalid']]);
        } catch (TokenExpiredException $e) {
            return response()->json(['ok' => false, 'errors' => ['Token is Expired']]);
        } catch (Exception $e) {
            return response()->json(['ok' => false, 'errors' => ['Authorization Token not found']]);
        }
        return $next($request);
    }
}
