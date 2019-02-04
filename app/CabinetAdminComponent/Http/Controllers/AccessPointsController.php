<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\AccessPoint;
use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\School;
use Illuminate\Http\Request;

class AccessPointsController extends Controller
{
    public function accessPointsAction(Request $request)
    {
        if($request->exists('search')){
            $access_points = AccessPoint::where('name', 'LIKE', "%" . $request->get('search') . "%")->get();
        }else{
            $access_points = AccessPoint::all();
        }

        $schools = collect([new School(['name' => 'NULL'])])->concat(School::all())->all();

        $data = [
            'access_points' => $access_points,
            'schools' => $schools
        ];
        return view('cabinet_admin.access_points', $data);
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
}
