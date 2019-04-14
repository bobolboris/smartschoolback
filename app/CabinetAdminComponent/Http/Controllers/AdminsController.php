<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Admin;
use App\CabinetAdminComponent\Locality;
use App\CabinetAdminComponent\Profile;
use App\CabinetAdminComponent\School;
use App\CabinetAdminComponent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = '%' . $request->get('search') . '%';
            $admins = Admin::join('profiles', 'admins.profile_id', '=', 'profiles.id')
                ->join('users', 'admins.user_id', '=', 'users.id')
                ->where('profiles.name', 'LIKE', $pattern)
                ->Orwhere('profiles.surname', 'LIKE', $pattern)
                ->Orwhere('profiles.patronymic', 'LIKE', $pattern)
                ->Orwhere('users.phone', 'LIKE', $pattern)
                ->Orwhere('users.email', 'LIKE', $pattern)
                ->Orwhere('admins.id', $request->get('search'))
                ->select('admins.*')
                ->paginate(10);
        } else {
            $admins = Admin::paginate(10);
        }

        $data = [
            'admins' => $admins
        ];

        return view('cabinet_admin.index.admins', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.admins.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function showAddFormAction()
    {
        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());
        $localities = collect([new Locality(['name' => 'NULL'])])->concat(Locality::all());

        $data = [
            'roles' => User::getAllRoles(),
            'schools' => $schools,
            'localities' => $localities,
            'action' => route('admin.admins.add')
        ];

        return view('cabinet_admin.edit.admins', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $admin = Admin::findOrFail($request->get('id'));

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());
        $localities = collect([new Locality(['name' => 'NULL'])])->concat(Locality::all());

        $data = [
            'admin' => $admin,
            'roles' => User::getAllRoles(),
            'schools' => $schools,
            'localities' => $localities,
            'action' => route('admin.admins.save')
        ];

        return view('cabinet_admin.edit.admins', $data);
    }

    public function saveAction(Request $request)
    {
        $rules = [
            'id' => ['required', 'exists:admins'],
            'roles' => ['nullable', 'array'],
            'email' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'surname' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'patronymic' => ['required', 'max:255'],
            'school_id' => ['nullable', 'exists:schools,id'],
            'locality_id' => ['nullable', 'exists:localities,id'],
        ];

        if ($request->has('password')) {
            $rules['password'] = ['required', 'min:6'];
        }

        $this->validate($request, $rules);

        $admin = Admin::findOrFail($request->get('id'));

        if ($admin->profile_id == null) {
            $profile = Profile::find($admin->profile_id);
            $profile->fill($request->only(['surname', 'name', 'patronymic']))->save();
        } else {
            $profile = Profile::create($request->only(['surname', 'name', 'patronymic']));
        }

        $usersFields = $request->only(['email', 'phone']);

        if ($request->has('password')) {
            $usersFields['password'] = Hash::make($request->get('password'));
        }

        if ($request->has('roles')) {
            $usersFields['roles'] = implode(',', $request->get('roles'));
        }

        if ($admin->user_id == null) {
            $user = User::find($admin->user_id);
            $user->fill($usersFields)->save();
        } else {
            $user = User::create($usersFields);
        }

        $values = [
            'profile_id' => $profile->id,
            'user_id' => $user->id,
            'school_id' => $request->get('school_id'),
            'locality_id' => $request->get('locality_id'),
        ];

        $admin->fill($values)->save();

        return redirect(route('admin.admins'));
    }

    public function addAction(Request $request)
    {
        $this->validate($request, [
            'roles' => ['nullable', 'array'],
            'email' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'password' => ['required', 'min:6'],
            'surname' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'patronymic' => ['required', 'max:255'],
            'school_id' => ['nullable', 'exists:schools,id'],
            'locality_id' => ['nullable', 'exists:localities,id'],
        ]);

        $profile = Profile::create($request->only(['surname', 'name', 'patronymic']));

        $usersFields = $request->only(['roles', 'email', 'phone', 'password']);
        $usersFields['password'] = Hash::make($usersFields['password']);
        $usersFields['roles'] = isset($usersFields['roles']) ? implode(',', $usersFields['roles']) : '';

        $user = User::create($usersFields);

        Admin::create([
            'profile_id' => $profile->id,
            'user_id' => $user->id,
            'school_id' => $request->get('school_id'),
            'locality_id' => $request->get('locality_id'),
        ]);

        return redirect(route('admin.admins'));
    }

    public function removeAction(Request $request)
    {
        Admin::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.admins'));
    }
}
