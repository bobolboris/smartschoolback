<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Child;
use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\SchoolClass;
use App\MainComponent\User;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    use ChildTrait;

    public function childrenAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = "%" . $request->get('search') . "%";
            $children = Child::Orwhere('name', 'LIKE', $pattern)
                ->OrWhere('surname', 'LIKE', $pattern)
                ->OrWhere('patronymic', 'LIKE', $pattern)
                ->get();
        } else {
            $children = Child::all();
        }


        $data = [
            'children' => $children->toArray()
        ];

        return view('cabinet_admin.index.children', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $id = $request->get('id');

        $child = Child::find($id);

        $classes = collect([new SchoolClass(['name' => 'NULL'])]);
        $classes = $classes->concat(SchoolClass::all())->all();

        $users = collect([new User(['email' => 'NULL'])]);
        $users = $users->concat(User::all())->all();

        $data = [
            'child' => $child->toArray(),
            'classes' => $classes,
            'users' => $users,
            'action' => route('admin.children.save')
        ];

        return view('cabinet_admin.edit.children', $data);
    }

    public function showAddFormAction()
    {
        $child = new Child();

        $classes = collect([new SchoolClass(['name' => 'NULL'])]);
        $classes = $classes->concat(SchoolClass::all())->all();

        $users = collect([new User(['email' => 'NULL'])]);
        $users = $users->concat(User::all())->all();

        $data = [
            'child' => $child->toArray(),
            'classes' => $classes,
            'users' => $users,
            'action' => route('admin.children.add')
        ];

        return view('cabinet_admin.edit.children', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.children.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function childrenAddAction(Request $request)
    {
        $this->validate($request, [
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'class_id' => 'nullable|exists:classes,id',
//            'user_id' => 'nullable|exists:users,id|unique:parents|unique:children',
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
//            'user_id' => 'nullable|exists:users,id|unique:parents|unique:children',
            'system_id' => 'nullable|integer',
        ]);

        $id = $request->get('id');

        $child = Child::find($id);
        $child->fill($request->all());
        $child->save();

        return redirect(route('admin.children'));
    }

    public function childrenRemoveAction(Request $request)
    {
        $id = $request->get('id');
        Child::destroy($id);
        return redirect(route('admin.children'));
    }

    public function getByIdAction(Request $request)
    {
        $id = $request->get('id');

        if ($id == -1) {
            $child = $this->createEmptyChild();
            return response()->json(['ok' => true, 'data' => ['child' => $child]]);
        }

        $child = Child::find($id);

        if ($child == null) {
            return response()->json(['ok' => false, 'errors' => ['Ребенок с таким id не был найден']]);
        }

        $child->schoolClass->school;

        return response()->json(['ok' => true, 'data' => ['child' => $child]]);
    }

}
