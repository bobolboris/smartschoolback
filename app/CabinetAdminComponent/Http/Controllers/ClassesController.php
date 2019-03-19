<?php

namespace App\CabinetAdminComponent\Http\Controllers;


use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\School;
use App\MainComponent\ClassModel;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function classesAction(Request $request)
    {
        if ($request->exists('search')) {
            $classes = ClassModel::where('name', 'LIKE', "%" . $request->get('search') . "%")->get();
        } else {
            $classes = ClassModel::all();
        }

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());

        $data = [
            'classes' => $classes->toArray(),
            'schools' => $schools->toArray()
        ];

        return view('cabinet_admin.index.classes', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $id = $request->get('id');

        $class = ClassModel::find($id);

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());

        $data = [
            'class' => $class->toArray(),
            'schools' => $schools->toArray(),
            'action' => route('admin.classes.save')
        ];

        return view('cabinet_admin.edit.classes', $data);
    }

    public function showAddFormAction()
    {
        $class = new ClassModel();

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());

        $data = [
            'class' => $class->toArray(),
            'schools' => $schools->toArray(),
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
            'name' => 'required',
            'school_id' => 'required|exists:schools,id'
        ]);

        ClassModel::create($request->all());
        return redirect(route('admin.classes'));
    }

    public function classesSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:classes',
            'name' => 'required',
            'school_id' => 'required|exists:schools,id'
        ]);

        $id = $request->get('id');

        $class = ClassModel::find($id);
        $class->fill($request->all());
        $class->save();

        return redirect(route('admin.classes'));
    }

    public function childrenRemoveAction(Request $request)
    {
        $id = $request->get('id');
        ClassModel::destroy($id);
        return redirect(route('admin.classes'));
    }
}
