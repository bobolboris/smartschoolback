<?php

namespace App\CabinetAdminComponent\Http\Controllers;


use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\School;
use App\MainComponent\SchoolClass;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function classesAction(Request $request)
    {
        if($request->exists('search')){
            $classes = SchoolClass::where('name', 'LIKE', "%" . $request->get('search') . "%")->get();
        }else{
            $classes = SchoolClass::all();
        }

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all());

        $data = [
            'classes' => $classes,
            'schools' => $schools
        ];

        return view('cabinet_admin.classes', $data);
    }

    public function classesAddAction(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:parents',
            'name' => 'required',
            'school_id' => 'required|exists:schools,id'
        ]);

        SchoolClass::create($request->all());
        return redirect(route('admin.classes'));
    }

    public function classesSaveAction(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'school_id' => 'required|exists:schools,id'
        ]);

        $id = $request->get('id');

        $class = SchoolClass::find($id);
        $class->fill($request->all());
        $class->save();

        return redirect(route('admin.classes'));
    }
}
