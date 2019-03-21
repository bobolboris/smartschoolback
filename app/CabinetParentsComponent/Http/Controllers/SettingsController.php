<?php

namespace App\CabinetParentsComponent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingsController extends BaseController
{
    public function indexAction()
    {
        $data = $this->baseLoad();
        $data['aparent'] = $data['parent'];
        return response()->json(['ok' => true, 'data' => $data]);
    }

    public function saveAction(Request $request)
    {
        $result = $this->validationEdit($request->all());

        if (!$result['ok']) {
            return response()->json($result);
        }

        Auth::user()->phone = $request->get('phone');
        Auth::user()->email = $request->get('email');
        Auth::user()->save();

        return response()->json(['ok' => true]);
    }

    protected function validationEdit(array $request)
    {
        $id = Auth::user()->id;
        $validator = Validator::make($request, [
            'phone' => ['required', 'regex:/^38071[0-9]{7}$/i', Rule::unique('users', 'phone')->ignore($id, 'id')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id, 'id')]
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }
}
