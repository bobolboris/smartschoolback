<?php

namespace App\CabinetComponent\Http\Controllers\Children;

use App\MainComponent\Child;
use App\MainComponent\ChildParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kozz\Laravel\Facades\Guzzle;
use PhoenixSmsSender\Facade\SmsSender;
use PhoenixSmsSender\MailingRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class KeysController extends BaseChildrenController
{
    public function blockKeyAction(Request $request)
    {
        $result = $this->validateKey($request->all());
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

        $child = Child::find($childId);
        if ($child == null) {
            $result['ok'] = false;
            $result['errors'] = ['Такого ребенка не существует'];
            return response()->json($result);
        }

        $response = Guzzle::post(env('WINDOWS_SERVER') . '/api/personal-keys/lock', [
            'form_params' => [
                'ID' => $child->system_id
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            $result['ok'] = false;
            $result['errors'] = ['Ошибка запроса'];
            return response()->json($result);
        }

        $state = json_decode(strval($response->getBody()), true);
        if (!isset($state['ok']) || !$state['ok']) {
            $result['ok'] = false;
            $result['errors'] = $state['errors'];
            return response()->json($result);
        }

        $child = Child::find($childId);
        $child->key->expires = date('Y-m-d H:i:s', time() + 60);
        $child->key->save();

        $shortCodeKey = $child->key->short_codekey;

        $surname = $child['surname'];
        $name = $child['name'];
        $patronymic = $child['patronymic'];

        $fullName = mb_convert_case("$surname $name $patronymic", MB_CASE_UPPER, "UTF-8");
        $school = $child->school->name;
        $text = "Номер пропуска: $shortCodeKey, ЗАБЛОКИРОВАН. Учащийся: $fullName. УЗ: $school, класс 5-А";

        SmsSender::setToken(env('SMS_TOKEN'));
        SmsSender::setAddress(env('SMS_SERVER'));
        SmsSender::createMailing(new MailingRequest('', $text, [$user->phone]));

        return response()->json($result);
    }

    public function unblockKeyAction(Request $request)
    {
        $result = $this->validateKey($request->all());
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

        $child = Child::find($childId);
        if ($child == null) {
            $result['ok'] = false;
            $result['errors'] = ['Такого ребенка не существует'];
            return response()->json($result);
        }

        $response = Guzzle::post(env('WINDOWS_SERVER') . '/api/personal-keys/unlock', [
            'form_params' => [
                'ID' => $child->system_id
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            $result['ok'] = false;
            $result['errors'] = ['Ошибка запроса'];
            return response()->json($result);
        }

        $state = json_decode(strval($response->getBody()), true);
        if (!isset($state['ok']) || !$state['ok']) {
            $result['ok'] = false;
            $result['errors'] = $state['errors'];
            return response()->json($result);
        }

        $child = Child::find($childId);
        $child->key->expires = null;
        $child->key->save();

        $shortCodeKey = $child->key->short_codekey;

        $surname = $child['surname'];
        $name = $child['name'];
        $patronymic = $child['patronymic'];

        $fullName = mb_convert_case("$surname $name $patronymic", MB_CASE_UPPER, "UTF-8");
        $school = $child->school->name;
        $text = "Номер пропуска: $shortCodeKey, РАЗБЛОКИРОВАН. Учащийся: $fullName. УЗ: $school, класс 5-А";

        SmsSender::setToken(env('SMS_TOKEN'));
        SmsSender::setAddress(env('SMS_SERVER'));
        SmsSender::createMailing(new MailingRequest('', $text, [$user->phone]));

        return response()->json($result);
    }

    protected function validateKey(array $request)
    {
        $validator = Validator::make($request, [
            'child_id' => 'required|exists:children,id'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

}
