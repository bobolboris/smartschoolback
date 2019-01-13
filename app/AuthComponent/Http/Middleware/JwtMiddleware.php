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
            return response()->json(['ok' => false, 'errors' => ['Неверный токен']])->header('Error-Status', 300);
        } catch (TokenExpiredException $e) {
            return response()->json(['ok' => false, 'errors' => ['Срок действия токена истек']])->header('Error-Status', 301);
        } catch (Exception $e) {
            return response()->json(['ok' => false, 'errors' => ['Токен не найден']])->header('Error-Status', 304);
        }

        $session = Session::where('token', $auth->getToken())->first();
        if ($session == null) {
            return response()->json(['ok' => false, 'errors' => ['Неизвестный токен']])->header('Error-Status', 302);
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
