<?php

namespace App\AuthComponent\Http\Middleware;

use App\MainComponent\Session;
use Closure;
use Exception;
use Jenssegers\Agent\Facades\Agent;
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
            $auth = JWTAuth::parseToken();
        } catch (TokenInvalidException $e) {
            return response()->json(['ok' => false, 'status' => 300, 'errors' => ['Неверный токен']]);
        } catch (TokenExpiredException $e) {
            return response()->json(['ok' => false, 'status' => 301, 'errors' => ['Срок действия токена истек']]);
        } catch (Exception $e) {
            return response()->json(['ok' => false, 'status' => 304, 'errors' => ['Токен не найден']]);
        }

        $session = Session::where('token', $auth->getToken())->first();
        if ($session == null) {
            return response()->json(['ok' => false, 'status' => 302, 'errors' => ['Неизвестный токен']]);
        }
        Agent::setUserAgent($request->header('Customer-User-Agent', ' '));

        $session->os = Agent::platform();
        $browser = Agent::browser();
        $browser .= " " . Agent::version($browser);
        $session->browser = $browser;

        $session->ip = $request->header('Customer-IP', ' ');

        $session->touch();
        $auth->authenticate();

        return $next($request);
    }
}
