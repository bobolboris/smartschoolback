<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Access;
use App\CabinetAdminComponent\AccessPoint;
use App\CabinetAdminComponent\Child;
use Illuminate\Http\Request;

class AccessesController extends BaseController
{
    protected $directionsArray = [];

    public function __construct()
    {
        parent::__construct();
        $this->directionsArray = ['0' => 'Неизвестно', '1' => 'Вход', '2' => 'Выход'];
    }

    public function indexAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = '%' . $request->get('search') . '%';
            $accesses = Access::join('children', 'children.id', '=', 'accesses.child_id')
                ->join('profiles', 'profiles.id', '=', 'children.profile_id')
                ->where('accesses.time', 'LIKE', $pattern)
                ->Orwhere('accesses.date', 'LIKE', $pattern)
                ->Orwhere('profiles.name', 'LIKE', $pattern)
                ->Orwhere('profiles.surname', 'LIKE', $pattern)
                ->Orwhere('profiles.patronymic', 'LIKE', $pattern)
                ->Orwhere('children.id', $request->get('search'))
                ->select('accesses.*')
                ->paginate(10);
        } else {
            $accesses = Access::paginate(10);
        }

        $data = [
            'accesses' => $accesses,
            'directionsArray' => $this->directionsArray
        ];

        return view('cabinet_admin.index.accesses', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $access = Access::findOrFail($request->get('id'));

        $children = collect([new Child()])->concat(Child::all());
        $accessPoints = collect([new AccessPoint()])->concat(AccessPoint::all());

        $data = [
            'access' => $access,
            'children' => $children,
            'accessPoints' => $accessPoints,
            'directionsArray' => $this->directionsArray,
            'action' => route('admin.accesses.save')
        ];

        return view('cabinet_admin.edit.accesses', $data);
    }

    public function showAddFormAction()
    {
        $access = new Access();

        $children = collect([new Child()])->concat(Child::all());
        $accessPoints = collect([new AccessPoint()])->concat(AccessPoint::all());

        $data = [
            'access' => $access,
            'children' => $children,
            'accessPoints' => $accessPoints,
            'directionsArray' => $this->directionsArray,
            'action' => route('admin.accesses.add')
        ];

        return view('cabinet_admin.edit.accesses', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.accesses.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function addAction(Request $request)
    {
        $this->validate($request, [
            'time' => ['required', 'date_format:h:i:s'],
            'date' => ['required', 'date_format:Y-m-d'],
            'direction' => ['required', 'in:0,1,2'],
            'cause' => ['required', 'in:1,2'],
            'child_id' => ['nullable', 'exists:children,id'],
            'access_point_id' => ['nullable', 'exists:access_points,id'],
            'system_id' => ['nullable', 'integer'],
        ]);

        Access::create($request->all());

        return redirect(route('admin.accesses'));
    }

    public function saveAction(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'exists:accesses'],
            'time' => ['required', 'date_format:h:i:s'],
            'date' => ['required', 'date_format:Y-m-d'],
            'direction' => ['required', 'in:0,1,2'],
            'cause' => ['required', 'in:1,2'],
            'child_id' => ['nullable', 'exists:children,id'],
            'access_point_id' => ['nullable', 'exists:access_points,id'],
            'system_id' => ['nullable', 'integer'],
        ]);

        Access::findOrFail($request->get('id'))->fill($request->all())->save();

        return redirect(route('admin.accesses'));
    }

    public function removeAction(Request $request)
    {
        Access::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.accesses'));
    }
}
