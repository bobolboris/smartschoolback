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
            $this->username() => 'required|exists:users',
            'password' => 'required'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    protected function validateLoginSecondStage(array $request)
    {
        $validator = Validator::make($request, [
            'sms_code' => 'required',
            'identifier' => 'required'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    protected function validateRefreshSmsCode(array $request)
    {
        $validator = Validator::make($request, [
            'identifier' => 'required|integer'
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
