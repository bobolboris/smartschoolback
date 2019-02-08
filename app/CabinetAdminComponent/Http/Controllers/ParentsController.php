<?php

namespace App\CabinetAdminComponent\Http\Controllers;


use App\MainComponent\Child;
use App\MainComponent\ChildParent;
use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\Parents;
use App\MainComponent\User;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    public function parentsAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = "%" . $request->get('search') . "%";
            $parents = Parents::Orwhere('name', 'LIKE', $pattern)
                ->OrWhere('surname', 'LIKE', $pattern)
                ->OrWhere('patronymic', 'LIKE', $pattern)
                ->get();
        } else {
            $parents = Parents::all();
        }

        $users = collect([new User(['email' => 'NULL'])]);
        $users = $users->concat(User::all())->all();

        $children_ids = Child::select('id')->get();

        $data = [
            'parents' => $parents->toArray(),
            'users' => $users,
            'children_ids' => $children_ids
        ];

        return view('cabinet_admin.index.parents', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $id = $request->get('id');

        $parent = Parents::find($id);
        $users = collect([new User(['email' => 'NULL'])])->concat(User::all())->all();

        $data = [
            'parent' => $parent->toArray(),
            'users' => $users,
            'action' => route('admin.parents.save')
        ];

        return view('cabinet_admin.edit.parents', $data);
    }

    public function showAddFormAction()
    {
        $parent = new Parents();
        $users = collect([new User(['email' => 'NULL'])])->concat(User::all())->all();

        $data = [
            'parent' => $parent->toArray(),
            'users' => $users,
            'action' => route('admin.parents.add')
        ];

        return view('cabinet_admin.edit.parents', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.parents.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function parentsAddAction(Request $request)
    {
        $this->validate($request, [
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
//            'user_id' => 'nullable|exists:users,id|unique:parents|unique:children',
        ]);

        Parents::create($request->all());

        return redirect(route('admin.parents'));
    }

    public function parentsSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:parents',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
//            'user_id' => 'nullable|exists:users,id|unique:parents|unique:children',
        ]);

        $id = $request->get('id');

        $parent = Parents::find($id);
        $parent->fill($request->all());
        $parent->save();

        return redirect(route('admin.parents'));
    }

    public function childrenRemoveAction(Request $request)
    {
        $id = $request->get('id');
        Parents::destroy($id);
        return redirect(route('admin.parents'));
    }





    public function getChildrenAction(Request $request)
    {
        $id = $request->get('id');
        $parent = Parents::find($id);
        if ($parent == null) {
            return response()->json(['ok' => false, 'errors' => ['Родитель с таким id не найден']]);
        }

        foreach ($parent->children as $child) {
            $child->schoolClass->school;
        }

        return response()->json(['ok' => true, 'data' => ['children' => $parent->children]]);
    }

    public function removeChildAction(Request $request)
    {
        if (!$request->has('child_id')) {
            return response()->json(['ok' => 'false', 'errors' => ['id ребенка не найден']]);
        }

        if (!$request->has('parent_id')) {
            return response()->json(['ok' => 'false', 'errors' => ['id родителя не найден']]);
        }

        $child_id = $request->get('child_id');
        $parent_id = $request->get('parent_id');

        $result = ChildParent::where('child_id', $child_id)->where('parent_id', $parent_id)->delete();

        return response()->json(['ok' => $result]);
    }

    public function saveRelationsChildParentAction(Request $request)
    {
        $child_id = $request->get('child_id');
        $parent_id = $request->get('parent_id');

        $child = Child::find($child_id);
        if ($child == null) {
            return response()->json(['ok' => false, 'errors' => ['Ребенок с таким id не был найден']]);
        }

        if (Parents::find($parent_id) == null) {
            return response()->json(['ok' => false, 'errors' => ['Родитель с таким id не был найден']]);
        }

        $count = ChildParent::where('child_id', $child_id)->where('parent_id', $parent_id)->count();
        if ($count != 0) {
            return response()->json(['ok' => false, 'errors' => ['Такой ребенок уже добавлен']]);
        }

        ChildParent::create(['child_id' => $child_id, 'parent_id' => $parent_id]);

        $child->schoolClass->school;

        return response()->json(['ok' => true, 'data' => ['child' => $child]]);
    }
}
