<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\ClassModel;
use App\CabinetAdminComponent\User;
use App\MainComponent\Child;
use App\MainComponent\Photo;
use App\MainComponent\Profile;
use Illuminate\Http\Request;

class ChildrenExtendedController extends BaseController
{
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

        return view('cabinet_admin.index.children_extended', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $id = $request->get('id');

        $child = Child::find($id);

        $profiles = collect([new Profile(['name' => 'NULL'])]);
        $profiles = $profiles->concat(Profile::all())->all();

        $classes = collect([new ClassModel(['name' => 'NULL'])]);
        $classes = $classes->concat(ClassModel::all())->all();

        $photos = collect([new Photo(['path' => 'NULL'])]);
        $photos = $photos->concat(Photo::all())->all();

        $users = collect([new User(['email' => 'NULL'])]);
        $users = $users->concat(User::all())->all();

        $data = [
            'child' => $child->toArray(),
            'classes' => $classes,
            'profiles' => $profiles,
            'photos' => $photos,
            'users' => $users,
            'action' => route('admin.children_extended.save')
        ];

        return view('cabinet_admin.edit.children_extended', $data);
    }

    public function childrenAddAction(Request $request)
    {
        $this->validate($request, [
            'profile_id' => 'nullable|exists:profiles,id',
            'class_id' => 'nullable|exists:classes,id',
            'photo_id' => 'nullable|exists:photos,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        Child::create($request->all());

        return redirect(route('admin.children_extended'));
    }

    public function childrenSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:children',
            'profile_id' => 'nullable|exists:profiles,id',
            'class_id' => 'nullable|exists:classes,id',
            'photo_id' => 'nullable|exists:photos,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $child = Child::find($request->get('id'));
        $child->fill($request->all());
        $child->save();

        return redirect(route('admin.children_extended'));
    }

    public function showAddFormAction()
    {
        $child = new Child();

        $profiles = collect([new Profile(['name' => 'NULL'])]);
        $profiles = $profiles->concat(Profile::all())->all();

        $classes = collect([new ClassModel(['name' => 'NULL'])]);
        $classes = $classes->concat(ClassModel::all())->all();

        $photos = collect([new Photo(['path' => 'NULL'])]);
        $photos = $photos->concat(Photo::all())->all();

        $users = collect([new User(['email' => 'NULL'])]);
        $users = $users->concat(User::all())->all();

        $data = [
            'child' => $child->toArray(),
            'classes' => $classes,
            'profiles' => $profiles,
            'photos' => $photos,
            'users' => $users,
            'action' => route('admin.children_extended.add')
        ];

        return view('cabinet_admin.edit.children_extended', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.children_extended.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function childrenRemoveAction(Request $request)
    {
        $id = $request->get('id');
        Child::destroy($id);
        return redirect(route('admin.children_extended'));
    }


}
