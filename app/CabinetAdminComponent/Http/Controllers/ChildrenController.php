<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Child;
use App\CabinetAdminComponent\ChildKey;
use App\CabinetAdminComponent\ChildParent;
use App\CabinetAdminComponent\ClassModel;
use App\CabinetAdminComponent\Photo;
use App\CabinetAdminComponent\Profile;
use App\CabinetAdminComponent\Setting;
use App\CabinetAdminComponent\User;
use Illuminate\Http\Request;

class ChildrenController extends BaseController
{
    use ChildTrait;

    public function childrenAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = "%" . $request->get('search') . "%";
            $children = Child::join('profiles', 'profiles.id', '=', 'children.profile_id')
                ->Orwhere('name', 'LIKE', $pattern)
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

        $classes = collect([new ClassModel(['name' => 'NULL'])]);
        $classes = $classes->concat(ClassModel::all())->all();

        $data = [
            'child' => $child->toArray(),
            'classes' => $classes,
            'action' => route('admin.children.save')
        ];

        return view('cabinet_admin.edit.children', $data);
    }

    public function showAddFormAction()
    {
        $child = new Child();

        $classes = collect([new ClassModel(['name' => 'NULL'])]);
        $classes = $classes->concat(ClassModel::all())->all();

        $data = [
            'child' => $child->toArray(),
            'classes' => $classes,
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
        ]);

        $profile = Profile::create($request->only(['surname', 'name', 'patronymic']));

        Child::create([
            'class_id' => $request->get('class_id'),
            'profile_id' => $profile->id,
        ]);

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
        ]);

        $id = $request->get('id');

        $child = Child::find($id);

        $profile = Profile::find($child->profile_id);

        if ($profile == null) {
            $profile = new Profile();
        }

        $profile->fill($request->only(['surname', 'name', 'patronymic']));
        $profile->save();

        $child->class_id = $request->get('class_id');
        $child->profile_id = $profile->id;
        $child->save();

        return redirect(route('admin.children'));
    }

    public function childrenRemoveAction(Request $request)
    {
        $id = $request->get('id');

        $child = Child::find($id);

        if ($child == null) {
            return redirect(route('admin.children'));
        }

        if ($child->profile_id != null) {
            Profile::destroy($child->profile_id);
        }

        if ($child->user_id != null) {
            $user = User::find($child->user_id);

            if ($user != null) {
                Setting::where('user_id', $user->id)->delete();
                $user->delete();
            }
        }

        if ($child->photo_id != null) {
            $photo = Photo::find($child->photo_id);

            if ($photo != null) {
                @unlink($photo->path);
                $photo->delete();
            }
        }

        ChildParent::where('child_id', $id)->delete();
        ChildKey::where('child_id', $id)->delete();

        $child->delete();

        return redirect(route('admin.children'));
    }

}
