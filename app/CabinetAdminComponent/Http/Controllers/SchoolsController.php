<?php

namespace App\CabinetAdminComponent\Http\Controllers;


use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\School;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    public function schoolsAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = "%" . $request->get('search') . "%";
            $schools = School::Orwhere('name', 'LIKE', $pattern)
                ->OrWhere('address', 'LIKE', $pattern)
                ->get();
        } else {
            $schools = School::all();
        }

        $data = [
            'schools' => $schools
        ];

        return view('cabinet_admin.school', $data);
    }

    public function schoolsAddAction(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'name' => 'required',
        ]);

        School::create($request->all());

        return redirect(route('admin.schools'));
    }

    public function schoolsSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:schools',
            'address' => 'required',
            'name' => 'required',
        ]);

        $id = $request->get('id');

        $school = School::find($id);
        $school->fill($request->all());
        $school->save();

        return redirect(route('admin.schools'));
    }
}
