<?php

namespace App\AuthComponent\Http\Controllers;

use App\AuthComponent\Http\Controllers\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhoenixSmsSender\Facade\SmsSender;
use PhoenixSmsSender\MailingRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function loginAction(Request $request)
    {
        $result = $this->validateLoginParameters($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }

        if (!Auth::once($request->only($this->username(), 'password'))) {
            return response()->json(['ok' => false, 'errors' => ['Неверный логин/пароль']]);
        }

        $user = Auth::user();
        $user->sms_token = $request->get('sms_token');
        $user->save();

        $text = 'Код для входа: ' . $request->get('sms_token');
//        SmsSender::createMailing(new MailingRequest('', $text, [$request->get('phone')]));
        return response()->json(['ok' => true]);
    }

    public function codeAction(Request $request)
    {
        $result = $this->validateLoginParameters($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }
        $credentials = $request->only($this->username(), 'password', 'sms_token');

        try {
            $token = JWTAuth::attempt($credentials);
            if ($token == false) {
                return response()->json(['ok' => false, 'errors' => ['Неверный код из смс']]);
            }
        } catch (JWTException $e) {
            return response()->json(['ok' => false, 'errors' => ['Не удалось создать токен']]);
        }
        return response()->json(['ok' => true, 'data' => ['token' => $token, 'expire' => JWTAuth::getPayload($token)->get('exp')]]);
    }

    public function refreshAction()
    {
        $token = JWTAuth::parseToken()->refresh();
        return response()->json(['ok' => true, 'data' => ['token' => $token, 'expire' => JWTAuth::getPayload($token)->get('exp')]]);
    }

}
