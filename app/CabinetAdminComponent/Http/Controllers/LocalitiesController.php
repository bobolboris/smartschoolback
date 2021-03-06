<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Locality;
use Illuminate\Http\Request;

class LocalitiesController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ($request->exists('search')) {
            $localities = Locality::where('name', 'LIKE', '%' . $request->get('search') . '%')
                ->Orwhere('id', $request->get('search'))
                ->paginate(10);
        } else {
            $localities = Locality::paginate(10);
        }

        $data = [
            'localities' => $localities,
        ];

        return view('cabinet_admin.index.localities', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $locality = Locality::findOrFail($request->get('id'));
        $localities = collect([new Locality(['name' => 'NULL'])])->concat(Locality::all());

        $data = [
            'locality' => $locality,
            'localities' => $localities,
            'types' => Locality::getAllTypes(),
            'action' => route('admin.localities.save')
        ];

        return view('cabinet_admin.edit.localities', $data);
    }

    public function showAddFormAction()
    {
        $locality = new Locality();
        $localities = collect([new Locality(['name' => 'NULL'])])->concat(Locality::all());

        $data = [
            'locality' => $locality,
            'localities' => $localities,
            'types' => Locality::getAllTypes(),
            'action' => route('admin.localities.add')
        ];

        return view('cabinet_admin.edit.localities', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.localities.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function addAction(Request $request)
    {
        $this->validate($request, [
            'type' => ['required', 'in:0,1,2'],
            'name' => ['required', 'max:255'],
            'locality_id' => ['nullable', 'exists:localities,id'],
        ]);

        Locality::create($request->all());

        return redirect(route('admin.localities'));
    }

    public function saveAction(Request $request)
    {
        $this->validate($request, [
            'type' => ['required', 'in:0,1,2'],
            'name' => ['required', 'max:255'],
            'locality_id' => ['nullable', 'exists:localities,id'],
        ]);

        Locality::findOrFail($request->get('id'))->fill($request->all())->save();

        return redirect(route('admin.localities'));
    }

    public function removeAction(Request $request)
    {
        Locality::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.localities'));
    }
}
