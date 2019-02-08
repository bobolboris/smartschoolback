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

        ChildParent::where('parent_id', $id)->delete();

        Parents::destroy($id);
        return redirect(route('admin.parents'));
    }

}
