<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\School;
use App\CabinetAdminComponent\Locality;
use Illuminate\Http\Request;

class SchoolsController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = '%' . $request->get('search') . '%';
            $schools = School::Orwhere('name', 'LIKE', $pattern)
                ->Orwhere('address', 'LIKE', $pattern)
                ->Orwhere('id', $request->get('search'))
                ->paginate(10);
        } else {
            $schools = School::paginate(10);
        }

        $data = [
            'schools' => $schools
        ];

        return view('cabinet_admin.index.school', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $school = School::findOrFail($request->get('id'));

        $localities = collect([new Locality(['id' => null, 'name' => 'NULL'])])->concat(Locality::all());

        $data = [
            'school' => $school,
            'localities' => $localities,
            'action' => route('admin.schools.save')
        ];

        return view('cabinet_admin.edit.school', $data);
    }

    public function showAddFormAction()
    {
        $school = new School();

        $localities = collect([new Locality(['id' => null, 'name' => 'NULL'])])->concat(Locality::all());

        $data = [
            'school' => $school,
            'localities' => $localities,
            'action' => route('admin.schools.add')
        ];

        return view('cabinet_admin.edit.school', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.schools.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function schoolsAddAction(Request $request)
    {
        $this->validate($request, [
            'address' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
        ]);

        School::create($request->all());

        return redirect(route('admin.schools'));
    }

    public function schoolsSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'schools'],
            'address' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
        ]);

        School::findOrFail($request->get('id'))->fill($request->all())->save();

        return redirect(route('admin.schools'));
    }

    public function schoolsRemoveAction(Request $request)
    {
        School::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.schools'));
    }
}
