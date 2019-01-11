<?php

namespace App\AuthComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    protected function validateLoginParameters(array $request)
    {
        $validator = Validator::make($request, [
            $this->username() => 'required|exists:users',
            'password' => 'required',
            'sms_token' => 'required'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    protected function username()
    {
        return 'phone';
    }
}
