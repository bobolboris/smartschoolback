<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\AccessPoint;
use App\CabinetAdminComponent\School;
use Illuminate\Http\Request;

class AccessPointsController extends BaseController
{
    public function accessPointsAction(Request $request)
    {
        if ($request->exists('search')) {
            $access_points = AccessPoint::where('name', 'LIKE', "%" . $request->get('search') . "%")->get();
        } else {
            $access_points = AccessPoint::all();
        }

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all())->all();

        $data = [
            'access_points' => $access_points,
            'schools' => $schools
        ];
        return view('cabinet_admin.index.access_points', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $id = $request->get('id');

        $access_point = AccessPoint::find($id);

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all())->all();

        $data = [
            'access_point' => $access_point->toArray(),
            'schools' => $schools,
            'action' => route('admin.access_points.save')
        ];

        return view('cabinet_admin.edit.access_points', $data);
    }

    public function showAddFormAction()
    {
        $access_point = new AccessPoint();

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all())->all();

        $data = [
            'access_point' => $access_point->toArray(),
            'schools' => $schools,
            'action' => route('admin.access_points.add')
        ];

        return view('cabinet_admin.edit.access_points', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.access_points.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function accessPointsAddAction(Request $request)
    {
        $this->validate($request, [
            'zonea' => 'required|integer',
            'zoneb' => 'required|integer',
            'school_id' => 'required|exists:schools,id',
            'system_id' => 'required|integer'
        ]);

        AccessPoint::create($request->all());

        return redirect(route('admin.access_points'));
    }

    public function accessPointsSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:access_points',
            'zonea' => 'required|integer',
            'zoneb' => 'required|integer',
            'school_id' => 'required|exists:schools,id',
            'system_id' => 'required|integer'
        ]);

        $id = $request->get('id');
        $access_point = AccessPoint::find($id);
        $access_point->fill($request->all());
        $access_point->save();

        return redirect(route('admin.access_points'));
    }

    public function accessPointRemoveAction(Request $request)
    {
        $id = $request->get('id');
        AccessPoint::destroy($id);
        return redirect(route('admin.access_points'));
    }
}
