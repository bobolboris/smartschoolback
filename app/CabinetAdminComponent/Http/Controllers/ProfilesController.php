<?php


namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Profile;
use Illuminate\Http\Request;

class ProfilesController extends BaseController
{
    public function indexAction()
    {
        $profiles = Profile::paginate(10);
        return view('cabinet_admin.index.profiles', compact('profiles'));
    }

    public function showEditFormAction(Request $request)
    {
        $data = [
            'profile' => Profile::findOrFail($request->get('id')),
            'action' => route('admin.profile.save')
        ];
        return view('cabinet_admin.edit.profiles', $data);
    }

    public function showAddFormAction()
    {
        $data = [
            'profile' => new Profile(),
            'action' => route('admin.profile.add')
        ];
        return view('cabinet_admin.edit.profiles', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'id' => $request->get('id'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'action' => route('admin.profile.remove')
        ];
        return view('cabinet_admin.remove.remove', $data);
    }

    public function profileAddAction(Request $request)
    {
        $this->validate($request, [
            'surname' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'patronymic' => ['required', 'max:255'],
        ]);

        Profile::create($request->all());

        return redirect(route('admin.profiles'));
    }

    public function profileSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'exists:profiles'],
            'surname' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'patronymic' => ['required', 'max:255'],
        ]);

        Profile::findOrFail($request->get('id'))->fill($request->all())->save();

        return redirect(route('admin.profiles'));
    }

    public function profileRemoveAction(Request $request)
    {
        Profile::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.profiles'));
    }
}
