<?php

namespace App\CabinetComponent\Http\Controllers\Children;

use App\MainComponent\ChildParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kozz\Laravel\Facades\Guzzle;
use Tymon\JWTAuth\Facades\JWTAuth;

class KeysController extends BaseChildrenController
{
    public function blockKeyAction(Request $request)
    {
        $result = $this->validate($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }

        $childId = $request->get('child_id');

        $user = JWTAuth::parseToken()->authenticate();

        if (ChildParent::findByParentAndChildId($childId, $user->entity->id) == null) {
            $result['ok'] = false;
            $result['errors'] = ['Это не ваш ребенок'];
            return response()->json($result);
        }

        $response = Guzzle::post(env('WINDOWS_SERVER') . '/api/personal-keys/lock', [
            'form_params' => [
                'ID' => $childId
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            $result['ok'] = false;
            $result['errors'] = ['Ошибка запроса'];
            return response()->json($result);
        }

        $state = json_decode(strval($response->getBody()));
        if (!isset($state['ok']) || !$state['ok']) {
            $result['ok'] = false;
            $result['errors'] = $state['errors'];
            return response()->json($result);
        }

        return response()->json($result);
    }

    public function unblockKeyAction(Request $request)
    {
        $result = $this->validate($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }

        $childId = $request->get('child_id');

        $user = JWTAuth::parseToken()->authenticate();

        if (ChildParent::findByParentAndChildId($childId, $user->entity->id) == null) {
            $result['ok'] = false;
            $result['errors'] = ['Это не ваш ребенок'];
            return response()->json($result);
        }

        $response = Guzzle::post(env('WINDOWS_SERVER') . '/api/personal-keys/unlock', [
            'form_params' => [
                'ID' => $childId
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            $result['ok'] = false;
            $result['errors'] = ['Ошибка запроса'];
            return response()->json($result);
        }

        $state = json_decode(strval($response->getBody()));
        if (!isset($state['ok']) || !$state['ok']) {
            $result['ok'] = false;
            $result['errors'] = $state['errors'];
            return response()->json($result);
        }

        return response()->json($result);
    }

    protected function validate(array $request)
    {
        $validator = Validator::make($request, [
            'child_id' => 'required|exists:children,id'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

}
