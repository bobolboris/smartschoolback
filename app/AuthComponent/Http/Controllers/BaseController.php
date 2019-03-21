<?php

namespace App\AuthComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Facades\Agent;

class BaseController extends Controller
{
    protected function username()
    {
        return 'phone';
    }

    protected function generateCode()
    {
        return rand(10000, 99999);
    }

    protected function validateLoginFirstStage(array $request)
    {
        $validator = Validator::make($request, [
            $this->username() => ['required', 'max:255', 'exists:users'],
            'password' => ['required', 'max:255']
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    protected function validateLoginSecondStage(array $request)
    {
        $validator = Validator::make($request, [
            'sms_code' => ['required', 'max:255'],
            'identifier' => ['required', 'max:255']
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    protected function validateRefreshSmsCode(array $request)
    {
        $validator = Validator::make($request, [
            'identifier' => ['required', 'max:255']
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    protected function getCustomerInfo(Request $request)
    {
        Agent::setUserAgent($request->header('Customer-User-Agent', ' '));
        $browser = Agent::browser();
        $browser .= " " . Agent::version($browser);
        return [
            'browser' => $browser,
            'os' => Agent::platform(),
            'ip' => $request->header('Customer-IP', ' ')
        ];
    }

}
