<?php

namespace App\AuthComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
}
