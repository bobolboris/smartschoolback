<?php

namespace App\CabinetParentsComponent\Http\Controllers;

use App\MainComponent\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class NotificationsController extends BaseController
{
    protected $settings;

    public function __construct()
    {
        parent::__construct();
        $this->settings = [
            'notification_of_access' => ['0', '1'],
            'notification_of_access_telegram' => ['0', '1'],
        ];
    }

    public function indexAction()
    {
        $data = $this->baseLoad();
        $user = $data['parent']->user;

        $settings = [];
        foreach ($user->settings as $setting) {
            $settings[$setting['key']] = $setting['value'];
        }

        $data['settings'] = $settings;

        return response()->json(['ok' => true, 'data' => $data]);
    }

    public function saveAction(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!isset($user)) {
            return response()->json(['ok' => false, 'errors' => ['user not found']]);
        }

        foreach ($this->settings as $key => $value) {
            $setting = Setting::where('key', $key)->where('user_id', Auth::user()->id)->first();
            
            if ($setting == null) {
                $setting = new Setting();
                $setting->key = $key;
                $setting->user_id = Auth::user()->id;
            }

            if ($request->has($key)) {
                if ($value != null && !in_array($request->get($key), $value)) {
                    return response()->json(['ok' => false, 'errors' => ["Invalid setting value $key"]]);
                }

                $setting->value = $request->get($key);
            }else {
                $setting->value = '0';
            }
            
            $setting->save();
        }

        return response()->json(['ok' => true]);
    }

}
