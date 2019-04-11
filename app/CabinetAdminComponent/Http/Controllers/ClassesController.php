<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Admin;
use App\CabinetAdminComponent\ClassModel;
use App\CabinetAdminComponent\School;
use Illuminate\Http\Request;

class ClassesController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ($request->exists('search')) {
            $classes = ClassModel::where('name', 'LIKE', "%" . $request->get('search') . "%")->paginate(10);
        } else {
            $classes = ClassModel::paginate(10);
        }

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());

        $data = [
            'classes' => $classes,
            'schools' => $schools
        ];

        return view('cabinet_admin.index.classes', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $class = ClassModel::find($request->get('id'));

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());

        $admins = collect([new Admin(['id' => null])])->concat(Admin::all());

        $data = [
            'class' => $class,
            'schools' => $schools,
            'admins' => $admins,
            'action' => route('admin.classes.save')
        ];

        return view('cabinet_admin.edit.classes', $data);
    }

    public function showAddFormAction()
    {
        $class = new ClassModel();

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());

        $admins = collect([new Admin(['id' => null])])->concat(Admin::all());

        $data = [
            'class' => $class,
            'schools' => $schools,
            'admins' => $admins,
            'action' => route('admin.classes.add')
        ];

        return view('cabinet_admin.edit.classes', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.classes.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function classesAddAction(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'school_id' => ['required', 'exists:schools,id']
        ]);

        ClassModel::create($request->all());

        return redirect(route('admin.classes'));
    }

    public function classesSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'exists:classes'],
            'name' => ['required'],
            'school_id' => ['required', 'exists:schools,id']
        ]);

        ClassModel::findOrFail($request->get('id'))->fill($request->all())->save();

        return redirect(route('admin.classes'));
    }

    public function childrenRemoveAction(Request $request)
    {
        ClassModel::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.classes'));
    }
}
