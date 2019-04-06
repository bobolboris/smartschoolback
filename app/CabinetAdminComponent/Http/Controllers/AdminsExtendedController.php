<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Admin;
use App\CabinetAdminComponent\Locality;
use App\CabinetAdminComponent\Profile;
use App\CabinetAdminComponent\School;
use App\CabinetAdminComponent\User;
use Illuminate\Http\Request;

class AdminsExtendedController extends BaseController
{
    public function adminExtendedAction(Request $request)
    {
        if ($request->exists('search')) {
            $admins = Admin::where('name', 'LIKE', "%" . $request->get('search') . "%")->get();
        } else {
            $admins = Admin::all();
        }

        $data = [
            'admins' => $admins,
            'showNULL' => $this->showNULL
        ];
        return view('cabinet_admin.index.admins_extended', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $id = $request->get('id');

        $admin = Admin::find($id);

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all())->all();
        $profiles = collect([new Profile(['name' => 'NULL'])])->concat(Profile::all())->all();
        $users = collect([new User(['email' => 'NULL'])])->concat(User::all())->all();
        $localities = collect([new Locality(['name' => 'NULL'])])->concat(Locality::all())->all();

        $data = [
            'admin' => $admin->toArray(),
            'schools' => $schools,
            'profiles' => $profiles,
            'users' => $users,
            'localities' => $localities,
            'action' => route('admin.admins_extended.save')
        ];

        return view('cabinet_admin.edit.admins_extended', $data);
    }

    public function showAddFormAction()
    {
        $admin = new Admin();

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all())->all();
        $profiles = collect([new Profile(['name' => 'NULL'])])->concat(Profile::all())->all();
        $users = collect([new User(['email' => 'NULL'])])->concat(User::all())->all();
        $localities = collect([new Locality(['name' => 'NULL'])])->concat(Locality::all())->all();

        $data = [
            'admin' => $admin->toArray(),
            'schools' => $schools,
            'profiles' => $profiles,
            'users' => $users,
            'localities' => $localities,
            'action' => route('admin.admins_extended.add')
        ];

        return view('cabinet_admin.edit.admins_extended', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.admins_extended.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function adminExtendedAddAction(Request $request)
    {
        $this->validate($request, [
            'profile_id' => ['nullable', 'exists:profiles,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'school_id' => ['nullable', 'exists:schools,id'],
            'locality_id' => ['nullable', 'exists:localities,id'],
        ]);

        Admin::create($request->all());

        return redirect(route('admin.admins_extended'));
    }

    public function adminExtendedSaveAction(Request $request)
    {
        $this->validate($request, [
            'profile_id' => ['nullable', 'exists:profiles,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'school_id' => ['nullable', 'exists:schools,id'],
            'locality_id' => ['nullable', 'exists:localities,id'],
        ]);

        Admin::findOrFail($request->get('id'))->fill($request->all())->save();
        return redirect(route('admin.admins_extended'));
    }

    public function adminExtendedRemoveAction(Request $request)
    {
        Admin::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.admins_extended'));
    }
}
