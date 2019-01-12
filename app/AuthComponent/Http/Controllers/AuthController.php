<?php

namespace App\AuthComponent\Http\Controllers;

use App\AuthComponent\Http\Controllers\BaseController as Controller;
use App\MainComponent\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                return response()->json(['ok' => false, 'errors' => ['Неверный код из смс']]);
            }
        } catch (JWTException $e) {
            return response()->json(['ok' => false, 'errors' => ['Не удалось создать токен']]);
        }

        $user = Auth::user();
        $code = $this->generateCode();

        $info = $this->getCustomerInfo($request);

        $session = $this->getSessionByInfo($info);
        if ($session == null) {
            $session = new Session();
        }

        $session->sms_code = $code;
        $session->token = $token;
        $session->expire_sms_code = time() + env('SMS_CODE_VALID_TIME', 120) * 60;
        $session->user_id = $user->id;

        $session->os = $info['os'];
        $session->browser = $info['browser'];
        $session->ip = $info['ip'];
        $session->save();

        if (env('SMS_AUTH_ENABLE', false)) {
            SmsSender::createMailing(new MailingRequest('', "Код для входа: $code", [$request->get('phone')]));
        }

//        return response()->json(['ok' => true, 'identifier' => $session->id]);
        return response()->json(['ok' => true, 'data' => ['sms_code' => $code, 'identifier' => $session->id]]);
    }

    public function loginSecondStageAction(Request $request)
    {
        $result = $this->validateLoginSecondStage($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }

        $smsCode = $request->get('sms_code');
        $session_id = $request->get('identifier');

        $session = Session::find($session_id);
        if ($session == null) {
            return response()->json(['ok' => false, 'errors' => ['Неверный идентификатор сессии']]);
        }

        if ($session->sms_code != $smsCode) {
            return response()->json(['ok' => false, 'errors' => ['Неверный код из смс']]);
        }

        if ($session->expire_sms_code <= time()) {
            return response()->json(['ok' => false, 'errors' => ['Срок действия смс кода истек']]);
        }

        $token = $session->token;
        JWTAuth::setToken($token);
        $data = ['token' => $token, 'expire' => JWTAuth::getPayload()->get('exp')];
        return response()->json(['ok' => true, 'data' => $data]);
    }

    public function refreshTokenAction(Request $request)
    {
        $auth = JWTAuth::parseToken();
        $token = $auth->getToken();
        $session = Session::where('token', $token)->first();
        if ($session == null) {
            return response()->json(['ok' => false, 'errors' => ['Неизвестный token']]);
        }
        $token = $auth->refresh();

        $info = $this->getCustomerInfo($request);

        $session->token = $token;
        $session->os = $info['os'];
        $session->browser = $info['browser'];
        $session->ip = $info['ip'];
        $session->save();

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
        $session_id = $request->get('identifier');

        $session = Session::find($session_id);
        if ($session == null) {
            return response()->json(['ok' => false, 'errors' => ['Неверный идентификатор сессии']]);
        }

        $code = $this->generateCode();
        while ($code == $session->sms_code) {
            $code = $this->generateCode();
        }

        $session->sms_code = $code;
        $session->expire_sms_code = time() + env('SMS_CODE_VALID_TIME', 120) * 60;
        $session->save();

        if (env('SMS_AUTH_ENABLE', false)) {
            SmsSender::createMailing(new MailingRequest('', "Код для входа: $code", [$session->user->phone]));
        }

//        return response()->json(['ok' => true]);
        return response()->json(['ok' => true, 'sms_code' => $code]);
    }

    public function logoutAction()
    {
        $token = JWTAuth::parseToken();

        $session = Session::where('token', $token)->first();
        if ($session == null) {
            return response()->json(['ok' => false, 'errors' => ['Неизвестный token']]);
        }

        $session->delete();

        return response()->json(['ok' => true]);
    }
}
