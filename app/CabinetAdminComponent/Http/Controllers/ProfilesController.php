<?php


namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Profile;
use Illuminate\Http\Request;

class ProfilesController extends BaseController
{
    public function profilesAction()
    {
        $profiles = Profile::all();
        return view('cabinet_admin.index.profiles', compact('profiles'));
    }

    public function showEditFormAction(Request $request)
    {
        $id = $request->get('id');
        $profile = Profile::find($id);
        $action = route('admin.profile.save');
        return view('cabinet_admin.edit.profiles', compact('profile', 'action'));
    }

    public function showAddFormAction()
    {
        $profile = new Profile();
        $action = route('admin.profile.add');
        return view('cabinet_admin.edit.profiles', compact('profile', 'action'));
    }

    public function showRemoveFormAction(Request $request)
    {
        $id = $request->get('id');
        $backurl = $request->server('HTTP_REFERER', '/');
        $action = route('admin.profile.remove');
        return view('cabinet_admin.remove.remove', compact('action', 'backurl', 'id'));
    }

    public function profileAddAction(Request $request)
    {
        $this->validate($request, [
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
        ]);

        Profile::create($request->all());

        return redirect(route('admin.profiles'));
    }

    public function profileSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => 'exists:profiles',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
        ]);

        $profile = Profile::find($request->get('id'));
        $profile = $profile->fill($request->all());
        $profile->save();

        return redirect(route('admin.profiles'));
    }

    public function profileRemoveAction(Request $request)
    {
        $id = $request->get('id');
        Profile::destroy($id);
        return redirect(route('admin.profiles'));
    }
}
