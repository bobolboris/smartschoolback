<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Child;
use App\MainComponent\ChildParent;
use App\MainComponent\ParentModel;
use App\MainComponent\Profile;
use App\MainComponent\Setting;
use App\MainComponent\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParentsController extends BaseController
{
    public function parentsAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = "%" . $request->get('search') . "%";
            $parents = ParentModel::join('profiles', 'profiles.id', '=', 'parents.profile_id')
                ->Orwhere('name', 'LIKE', $pattern)
                ->OrWhere('surname', 'LIKE', $pattern)
                ->OrWhere('patronymic', 'LIKE', $pattern)
                ->get();
        } else {
            $parents = ParentModel::all();
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

        $parent = ParentModel::find($id);
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
        $parent = new ParentModel();
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
            'user_id' => 'nullable|exists:users,id|unique:parents|unique:children',
        ]);

        $profile = Profile::create($request->only(['surname', 'name', 'patronymic']));

        ParentModel::create(['profile_id' => $profile->id]);

        return redirect(route('admin.parents'));
    }

    public function parentsSaveAction(Request $request)
    {
        $id = $request->get('id');

        $this->validate($request, [
            'id' => 'required|exists:parents',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'user_id' => ['nullable', 'exists:users,id', Rule::unique('parents', 'user_id')->ignore($id, 'id'), 'unique:children'],
        ]);

        $parent = ParentModel::find($id);
        $parent->profile->fill($request->only(['surname', 'name', 'patronymic']));
        $parent->profile->save();

        $parent->fill(['user_id' => $request->get('user_id')]);
        $parent->save();

        return redirect(route('admin.parents'));
    }

    public function childrenRemoveAction(Request $request)
    {
        $id = $request->get('id');

        $parent = ParentModel::find($id);

        if ($parent == null) {
            return redirect(route('admin.parents'));
        }

        ChildParent::where('parent_id', $id)->delete();

        if ($parent->profile_id != null) {
            Profile::destroy($parent->profile_id);
        }

        if ($parent->user_id != null) {
            $user = User::find($parent->user_id);

            if ($user != null) {
                Setting::where('user_id', $user->id)->delete();
                $user->delete();
            }
        }

        $parent->delete();

        return redirect(route('admin.parents'));
    }

}
