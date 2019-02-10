<?php

namespace App\CabinetParentsComponent\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SettingsController extends BaseController
{
    public function indexAction()
    {
        $data = $this->baseLoad();
        $user = $data['parent']->user;
        $data['setting'] = $user->setting;
        return response()->json(['ok' => true, 'data' => $data]);
    }

    public function saveAction(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!isset($user)) {
            return response()->json(['ok' => true, 'errors' => ['user not found']]);
        }

        $req = $request->get('request');

        $user->setting->notification_of_access = isset($req['notification_of_access']) ? $req['notification_of_access'] : 0;
        $user->setting->notification_of_access_telegram = isset($req['notification_of_access_telegram']) ? $req['notification_of_access_telegram'] : 0;

        if (isset($req['telegram_chat_id'])) {
            $user->setting->telegram_chat_id = $req['telegram_chat_id'];
        }

        $user->setting->save();
        return response()->json(['ok' => true]);
    }

}
