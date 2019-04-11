<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Child;
use App\CabinetAdminComponent\ClassModel;
use App\CabinetAdminComponent\Photo;
use App\CabinetAdminComponent\Profile;
use App\CabinetAdminComponent\User;
use Illuminate\Http\Request;

class ChildrenExtendedController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ($request->exists('search')) {
            $children = Child::where('id', $request->get('search'))->paginate(10);
        } else {
            $children = Child::paginate(10);
        }

        $data = [
            'children' => $children
        ];

        return view('cabinet_admin.index.children_extended', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $child = Child::findOrFail($request->get('id'));

        $profiles = collect([new Profile(['name' => 'NULL'])])->concat(Profile::all());
        $classes = collect([new ClassModel(['name' => 'NULL'])])->concat(ClassModel::all());
        $photos = collect([new Photo(['path' => 'NULL'])])->concat(Photo::all());
        $users = collect([new User(['email' => 'NULL'])])->concat(User::all());

        $data = [
            'child' => $child,
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
            'profile_id' => ['nullable', 'exists:profiles,id'],
            'class_id' => ['nullable', 'exists:classes,id'],
            'photo_id' => ['nullable', 'exists:photos,id'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        Child::create($request->all());

        return redirect(route('admin.children_extended'));
    }

    public function childrenSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'exists:children'],
            'profile_id' => ['nullable', 'exists:profiles,id'],
            'class_id' => ['nullable', 'exists:classes,id'],
            'photo_id' => ['nullable', 'exists:photos,id'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        Child::findOrFail($request->get('id'))->fill($request->all())->save();

        return redirect(route('admin.children_extended'));
    }

    public function showAddFormAction()
    {
        $child = new Child();

        $profiles = collect([new Profile(['name' => 'NULL'])])->concat(Profile::all());
        $classes = collect([new ClassModel(['name' => 'NULL'])])->concat(ClassModel::all());
        $photos = collect([new Photo(['path' => 'NULL'])])->concat(Photo::all());
        $users = collect([new User(['email' => 'NULL'])])->concat(User::all());

        $data = [
            'child' => $child,
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
        Child::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.children_extended'));
    }

}
