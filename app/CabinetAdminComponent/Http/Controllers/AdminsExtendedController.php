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
    public function indexAction(Request $request)
    {
        if ($request->exists('search')) {
            $admins = Admin::where('id', $request->get('search'))->paginate(10);
        } else {
            $admins = Admin::paginate(10);
        }

        $data = [
            'admins' => $admins
        ];

        return view('cabinet_admin.index.admins_extended', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $admin = Admin::findOrFail($request->get('id'));

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());
        $profiles = collect([new Profile(['name' => 'NULL'])])->concat(Profile::all());
        $users = collect([new User(['email' => 'NULL'])])->concat(User::all());
        $localities = collect([new Locality(['name' => 'NULL'])])->concat(Locality::all());

        $data = [
            'admin' => $admin,
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

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());
        $profiles = collect([new Profile(['name' => 'NULL'])])->concat(Profile::all());
        $users = collect([new User(['email' => 'NULL'])])->concat(User::all());
        $localities = collect([new Locality(['name' => 'NULL'])])->concat(Locality::all());

        $data = [
            'admin' => $admin,
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

    public function addAction(Request $request)
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

    public function saveAction(Request $request)
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

    public function removeAction(Request $request)
    {
        Admin::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.admins_extended'));
    }
}
