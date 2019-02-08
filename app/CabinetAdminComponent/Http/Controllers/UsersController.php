<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
            'action' => route('admin.users.save')
        ];

        return view('cabinet_admin.edit.users', $data);
    }

    public function showAddFormAction()
    {
        $user = new User();

        $data = [
            'user' => $user->toArray(),
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
            'roles' => 'required|regex:/^[0-9]+(,[0-9]+)?,?$/i',
            'email' => 'required',
            'phone' => 'required|regex:/^38071[0-9]{7}$/i',
//            'email_verified_at' => 'nullable|date_format:Y-m-d\Th:m',
            'enabled' => 'required|in:0,1',
//            'type' => 'required|integer',
//            'remember_token' => 'nullable',
//            'created_at' => 'nullable|date_format:Y-m-d\Th:m',
//            'updated_at' => 'nullable|date_format:Y-m-d\Th:m',
        ];

        if ($request->get('password') != "") {
            $rules['password'] = 'min:6';
        }

        $this->validate($request, $rules);

        $only = array_keys($rules);

        $attributes = $request->only($only);

//        if (isset($attributes['email_verified_at'])) {
//            $attributes['email_verified_at'] = DateTime::createFromFormat('Y-m-d\Th:m', $attributes['email_verified_at'])->format('Y-m-d H:i:s');
//        }
//
//        if (isset($attributes['created_at'])) {
//            $attributes['created_at'] = DateTime::createFromFormat('Y-m-d\Th:m', $attributes['created_at'])->format('Y-m-d H:i:s');
//        }
//
//        if (isset($attributes['updated_at'])) {
//            $attributes['updated_at'] = DateTime::createFromFormat('Y-m-d\Th:m', $attributes['updated_at'])->format('Y-m-d H:i:s');
//        }

        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        User::create($attributes);

        return redirect(route('admin.users'));
    }

    public function usersSaveAction(Request $request)
    {
        $rules = [
            'id' => 'required|exists:users',
            'roles' => 'required|regex:/^[0-9]+(,[0-9]+)?,?$/i',
            'email' => 'required',
            'phone' => 'required|regex:/^38071[0-9]{7}$/i',
//            'email_verified_at' => 'nullable|date_format:Y-m-d\Th:m',
            'enabled' => 'required|in:0,1',
//            'type' => 'required|integer',
//            'remember_token' => 'nullable',
//            'created_at' => 'nullable|date_format:Y-m-d\Th:m',
//            'updated_at' => 'nullable|date_format:Y-m-d\Th:m',
        ];

        if ($request->get('password') != "") {
            $rules['password'] = 'min:6';
        }

        $this->validate($request, $rules);

        $only = array_keys($rules);

        $attributes = $request->only($only);

//        if (isset($attributes['email_verified_at'])) {
//            $attributes['email_verified_at'] = DateTime::createFromFormat('Y-m-d\Th:m', $attributes['email_verified_at'])->format('Y-m-d H:i:s');
//        }
//
//        if (isset($attributes['created_at'])) {
//            $attributes['created_at'] = DateTime::createFromFormat('Y-m-d\Th:m', $attributes['created_at'])->format('Y-m-d H:i:s');
//        }
//
//        if (isset($attributes['updated_at'])) {
//            $attributes['updated_at'] = DateTime::createFromFormat('Y-m-d\Th:m', $attributes['updated_at'])->format('Y-m-d H:i:s');
//        }

        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

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
