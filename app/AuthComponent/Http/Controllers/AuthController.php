<?php

namespace App\AuthComponent\Http\Controllers;

use App\AuthComponent\Http\Controllers\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use PhoenixSmsSender\Facade\SmsSender;
use PhoenixSmsSender\MailingRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function loginFirstStageAction(Request $request)
    {
        $result = $this->validateLoginFirstStage($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }

        try {
            $credentials = $request->only($this->username(), 'password');
            $token = JWTAuth::attempt($credentials);
            if ($token == false) {
                return response()->json(['ok' => false, 'errors' => ['error' => 'Неверный номер/пароль']]);
            }
        } catch (JWTException $e) {
            return response()->json(['ok' => false, 'errors' => ['error' => 'Не удалось создать токен']]);
        }

        $sms_code = $this->generateCode();

        $identifier = $this->generateRandomWord(16);
        Redis::setex($identifier, 3600 * 2, json_encode(['sms_code' => $sms_code, 'token' => $token]));

        if (env('SMS_AUTH_ENABLE', false)) {
            $text = "Код для входа: $sms_code";
            SmsSender::createMailing(new MailingRequest('', $text, [$request->get('phone')]));
        }

//        return response()->json(['ok' => true, 'identifier' => $identifier]);
        return response()->json(['ok' => true, 'data' => ['sms_code' => $sms_code, 'identifier' => $identifier]]);
    }

    public function loginSecondStageAction(Request $request)
    {
        $result = $this->validateLoginSecondStage($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }

        $smsCode = $request->get('sms_code');
        $identifier = $request->get('identifier');

        $value = Redis::get($identifier);

        if ($value == null) {
            return response()->json(['ok' => false, 'errors' => ['Неверный идентификатор сессии']]);
        }

        $array = json_decode(Redis::get($identifier), true);

        if ($array['sms_code'] != $smsCode) {
            return response()->json(['ok' => false, 'errors' => ['sms_code' => 'Неверный код из смс']]);
        }

        $token = $array['token'];
        JWTAuth::setToken($token);
        $data = ['token' => $token, 'expire' => JWTAuth::getPayload()->get('exp')];
        return response()->json(['ok' => true, 'data' => $data]);
    }

    public function refreshTokenAction(Request $request)
    {
        $auth = JWTAuth::parseToken();
        $token = JWTAuth::refresh($auth->getToken());
        JWTAuth::setToken($token);
        $data = ['token' => $token, 'expire' => JWTAuth::getPayload()->get('exp')];
        return response()->json(['ok' => true, 'data' => $data]);
    }


    public function refreshSmsCodeAction(Request $request)
    {
        $result = $this->validateRefreshSmsCode($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }
        $identifier = $request->get('identifier');

        $value = Redis::get($identifier);

        if ($value == null) {
            return response()->json(['ok' => false, 'errors' => ['Неверный идентификатор сессии']]);
        }

        $array = json_decode(Redis::get($identifier), true);

        do {
            $sms_code = $this->generateCode();
        } while ($sms_code == $array['sms_code']);
        $array['sms_code'] = $sms_code;

        Redis::setex($identifier, 3600 * 2, json_encode($array));

        if (env('SMS_AUTH_ENABLE', false)) {
            $user = JWTAuth::toUser($array['token']);
            $text = "Код для входа: $sms_code";
            SmsSender::createMailing(new MailingRequest('', $text, [$user->phone]));
        }

//        return response()->json(['ok' => true]);
        return response()->json(['ok' => true, 'sms_code' => $sms_code]);
    }

    public function logoutAction()
    {
        return response()->json(['ok' => true]);
    }
}
