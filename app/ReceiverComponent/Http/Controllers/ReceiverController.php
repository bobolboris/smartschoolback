<?php

namespace App\ReceiverComponent\Http\Controllers;

use App\MainComponent\Access;
use App\MainComponent\AccessDenials;
use App\MainComponent\AccessPoint;
use App\MainComponent\Child;
use App\MainComponent\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhoenixSmsSender\Facade\SmsSender;
use PhoenixSmsSender\MailingRequest;

class ReceiverController extends Controller
{
    public function passDenyAction(Request $request)
    {
        if (!$request->has('json')) {
            return response('error');
        }
        $data = json_decode($request->get('json'), true);

        $accessDenial = new AccessDenials();
        $accessDenial->time = $data['info']['time'];
        $accessDenial->date = $data['info']['date'];
        $accessDenial->direction = 0;
        $accessDenial->cause = 0;

        $accessPoint = AccessPoint::findBySystemId($data['info']['apid']);
        if (!isset($accessPoint)) {
            Log::error('Ошибка доступа. Неизвестный турникет');
            return response('error');
        }

        $accessDenial->access_point_id = $accessPoint->id;
        $accessDenial->system_id = $data['log']['ID'];
        $accessDenial->save();
        return response()->json(['ok' => true]);
    }

    //"713333316"
    public function passDetectedAction(Request $request)
    {
        if (!$request->has('json')) {
            return response('error');
        }
        $data = json_decode($request->get('json'), true);

        $access = new Access();
        $access->time = $data['info']['time'];
        $access->date = $data['info']['date'];
        $access->direction = $data['info']['direction'];
        $access->cause = 1;

        $child = Child::findBySystemId($data['info']['objid']);
        if (!isset($child)) {
            Log::error('Ошибка доступа. Неизвестный ребенок');
            return response('error');
        }

        $access->child_id = $child->id;

        $accessPoint = AccessPoint::findBySystemId($data['info']['apid']);
        if (!isset($accessPoint)) {
            Log::error('Ошибка доступа. Неизвестный турникет');
            return response('error');
        }

        $access->access_point_id = $accessPoint->id;
        if (isset($data['log']['ID'])) {
            $access->system_id = $data['log']['ID'];
        }
        $access->save();

        $fio = "$child->surname $child->name $child->patronymic";

        $phones = [];

        foreach ($child->parents as $parent) {
            $setting = $parent->user->setting;
            if ($setting != null && $setting->notification_of_access == 1) {
                $phones[] = $parent->user->phone;
            }
        }

        $text_sms = ($access->direction == 1) ? 'Вход в УЗ: ' : 'Выход из УЗ: ';

        SmsSender::createMailing(new MailingRequest('', $text_sms . $access->time . " " . $fio, $phones));
        return response()->json(['ok' => true]);
    }
}
