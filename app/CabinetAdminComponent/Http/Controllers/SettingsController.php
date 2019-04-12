<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Setting;
use App\CabinetAdminComponent\User;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{
    public function indexAction(Request $request)
    {
        $user = User::findOrFail($request->get('id'));
        $settings = $user->settings()->paginate(10);

        $data = [
            'settings' => $settings,
            'email' => $user->email
        ];

        return view('cabinet_admin.index.user_setting', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.settings.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function addAction(Request $request)
    {
        $this->validate($request, [
            'key' => ['required', 'unique:settings,key,NULL,user_id' . $request->get('user_id')],
            'value' => ['required', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        Setting::create($request->all());

        return redirect(route('admin.settings', ['id' => $request->get('user_id')]));
    }

    public function saveAction(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'exists:settings,id'],
            'value' => ['required', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        Setting::findOrFail($request->get('id'))->fill($request->only('value'))->save();

        return redirect(route('admin.settings', ['id' => $request->get('user_id')]));
    }

    public function removeAction(Request $request)
    {
        Setting::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.settings', ['id' => $request->get('user_id')]));
    }
}
