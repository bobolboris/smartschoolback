<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends BaseController
{
    public function usersAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = "%" . $request->get('search') . "%";
            $users = User::Orwhere('email', 'LIKE', $pattern)
                ->OrWhere('phone', 'LIKE', $pattern)
                ->get();
        } else {
            $users = User::all();
        }

        $data = [
            'users' => $users->toArray()
        ];

        return view('cabinet_admin.index.users', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $id = $request->get('id');

        $user = User::find($id);

        $data = [
            'user' => $user->toArray(),
            'roles' => User::getAllRoles(),
            'action' => route('admin.users.save')
        ];

        return view('cabinet_admin.edit.users', $data);
    }

    public function showAddFormAction()
    {
        $user = new User();

        $data = [
            'user' => $user->toArray(),
            'roles' => User::getAllRoles(),
            'action' => route('admin.users.add')
        ];

        return view('cabinet_admin.edit.users', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.users.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function usersAddAction(Request $request)
    {
        $rules = [
            'roles' => 'nullable|array',
            'email' => 'required',
            'phone' => 'required',
            'email_verified_at' => 'nullable|date_format:Y-m-d\TH:i',
            'enabled' => 'required|in:0,1',
            'remember_token' => 'nullable',
            'created_at' => 'nullable|date_format:Y-m-d\TH:i',
            'updated_at' => 'nullable|date_format:Y-m-d\TH:i',
            'password' => 'required|min:6',
        ];

        $this->validate($request, $rules);

        $only = array_keys($rules);

        $attributes = $request->only($only);

        if (isset($attributes['email_verified_at'])) {
            $attributes['email_verified_at'] = DateTime::createFromFormat('Y-m-d\TH:i', $attributes['email_verified_at']);
            $attributes['email_verified_at'] = $attributes['email_verified_at']->format('Y-m-d H:i:s');
        }

        if (isset($attributes['created_at'])) {
            $attributes['created_at'] = DateTime::createFromFormat('Y-m-d\TH:i', $attributes['created_at']);
            $attributes['created_at'] = $attributes['created_at']->format('Y-m-d H:i:s');
        }

        if (isset($attributes['updated_at'])) {
            $attributes['updated_at'] = DateTime::createFromFormat('Y-m-d\TH:i', $attributes['updated_at']);
            $attributes['updated_at'] = $attributes['updated_at']->format('Y-m-d H:i:s');
        }

        $attributes['password'] = Hash::make($attributes['password']);

        $attributes['roles'] = isset($attributes['roles']) ? implode(',', $attributes['roles']) : '';

        User::create($attributes);

        return redirect(route('admin.users'));
    }

    public function usersSaveAction(Request $request)
    {
        $rules = [
            'id' => 'required|exists:users',
            'roles' => 'nullable|array',
            'email' => 'required',
            'phone' => 'required',
            'email_verified_at' => 'nullable|date_format:Y-m-d\TH:i:s',
            'enabled' => 'required|in:0,1',
            'remember_token' => 'nullable',
            'created_at' => 'nullable|date_format:Y-m-d\TH:i:s',
            'updated_at' => 'nullable|date_format:Y-m-d\TH:i:s',
        ];

        if ($request->get('password') != "") {
            $rules['password'] = 'min:6';
        }

        $this->validate($request, $rules);

        $only = array_keys($rules);

        $attributes = $request->only($only);

        if (isset($attributes['email_verified_at'])) {
            $attributes['email_verified_at'] = DateTime::createFromFormat('Y-m-d\TH:i:s', $attributes['email_verified_at']);
            $attributes['email_verified_at'] = $attributes['email_verified_at']->format('Y-m-d H:i:s');
        }

        if (isset($attributes['created_at'])) {
            $attributes['created_at'] = DateTime::createFromFormat('Y-m-d\TH:i:s', $attributes['created_at']);
            $attributes['created_at'] = $attributes['created_at']->format('Y-m-d H:i:s');
        }

        if (isset($attributes['updated_at'])) {
            $attributes['updated_at'] = DateTime::createFromFormat('Y-m-d\TH:i:s', $attributes['updated_at']);
            $attributes['updated_at'] = $attributes['updated_at']->format('Y-m-d H:i:s');
        }

        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        $attributes['roles'] = isset($attributes['roles']) ? implode(',', $attributes['roles']) : '';


        $id = $request->get('id');
        $user = User::find($id);
        $user->fill($attributes);

        $user->save();

        return redirect(route('admin.users'));
    }

    public function usersRemoveAction(Request $request)
    {
        $id = $request->get('id');
        User::destroy($id);
        return redirect(route('admin.users'));
    }
}
