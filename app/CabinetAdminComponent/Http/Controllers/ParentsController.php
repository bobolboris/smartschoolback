<?php

namespace App\CabinetAdminComponent\Http\Controllers;


use App\MainComponent\Child;
use App\MainComponent\ChildParent;
use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\Parents;
use App\MainComponent\School;
use App\MainComponent\SchoolClass;
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

//        $school = new School(['id' => -1, 'name' => '-', 'address' => '-']);
//        $schoolClass = new SchoolClass(['id' => -1, 'name' => '-', 'school_id' => -1]);
//        $schoolClass->school = $school;
//
//        $child = new Child();
//        $child->id = null;
//        $child->surname = '-';
//        $child->name = '-';
//        $child->patronymic = '-';
//        $child->photo_id = null;
//        $child->class_id = null;
//        $child->user_id = null;
//        $child->system_id = -1;
//        $child->schoolClass = $schoolClass;
        $users = collect([new User(['email' => 'NULL'])]);
        $users = $users->concat(User::all())->all();


        $children_ids = Child::select('id')->get();
        $children_ids = collect([new Child()])->concat($children_ids)->all();

        $data = [
            'parents' => $parents,
            'users' => $users,
            'children_ids' => $children_ids
        ];

        return view('cabinet_admin.parents', $data);
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
}
