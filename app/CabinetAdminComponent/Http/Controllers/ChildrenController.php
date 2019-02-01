<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Child;
use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\SchoolClass;
use App\MainComponent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChildrenController extends Controller
{

    public function childrenAction()
    {
        $children = Child::all();

        $classes = collect([new SchoolClass(['name' => 'NULL'])]);
        $classes = $classes->concat(SchoolClass::all())->all();

        $users = collect([new User(['email' => 'NULL'])]);
        $users = $users->concat(User::all())->all();

        $data = [
            'children' => $children,
            'classes' => $classes,
            'users' => $users
        ];

        return view('cabinet_admin.children', $data);
    }

    public function childrenAddAction(Request $request)
    {
        $this->validate($request, [
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'class_id' => 'nullable|exists:classes,id',
            'user_id' => 'nullable|exists:users,id|unique:parents|unique:children',
            'system_id' => 'nullable|integer',
        ]);

        Child::create($request->all());

        return redirect(route('admin.children'));
    }

    public function childrenSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:children',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'class_id' => 'nullable|exists:classes,id',
            'user_id' => 'nullable|exists:users,id|unique:parents|unique:children',
            'system_id' => 'nullable|integer',
        ]);

        $id = $request->get('id');

        $child = Child::find($id);
        $child->fill($request->all());
        $child->save();

        return redirect(route('admin.children'));
    }
}
