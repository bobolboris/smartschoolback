<?php

namespace App\AuthComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhoenixSmsSender\MailingRequest;
use PhoenixSmsSender\PhoenixSmsSender;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
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
        $smsSender = new PhoenixSmsSender(env('SMS_SERVER'), env('SMS_TOKEN'));
        $smsSender->createMailing(new MailingRequest('', $text, [$request->get('phone')]));
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
                return response()->json(['ok' => false, 'errors' => ['Неверный логин/пароль']]);
            }
        } catch (JWTException $e) {
            return response()->json(['ok' => false, 'errors' => ['Не удалось создать токен']]);
        }
        return response()->json(['ok' => true, 'data' => ['token' => $token]]);
    }

    private function validateLoginParameters(array $request)
    {
        $validator = Validator::make($request, [
            $this->username() => 'required|exists:users',
            'password' => 'required',
            'sms_token' => 'required'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    private function username()
    {
        return 'phone';
    }


    public function testAction()
    {
        return response()->json(['ok' => true, 'date' => ['alright']]);
    }
}
