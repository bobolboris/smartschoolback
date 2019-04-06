<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Child;
use App\CabinetAdminComponent\ChildKey;
use Illuminate\Http\Request;

class ChildrenKeysController extends BaseController
{
    public function childrenKeysAction(Request $request)
    {
        if ($request->exists('search')) {
            $children_keys = ChildKey::where('codekey', 'LIKE', "%" . $request->get('search') . "%")->get();
        } else {
            $children_keys = ChildKey::all();
        }

        $data = [
            'children_keys' => $children_keys,
        ];

        return view('cabinet_admin.index.children_keys', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $children_key = ChildKey::findOrFail($request->get('id'));

        $children = collect([new Child()])->concat(Child::all())->all();

        $data = [
            'children_key' => $children_key->toArray(),
            'children' => $children,
            'action' => route('admin.children_keys.save')
        ];

        return view('cabinet_admin.edit.children_keys', $data);
    }

    public function showAddFormAction()
    {
        $children_key = new ChildKey();

        $children = collect([new Child()])->concat(Child::all())->all();

        $data = [
            'children_key' => $children_key->toArray(),
            'children' => $children,
            'action' => route('admin.children_keys.add')
        ];

        return view('cabinet_admin.edit.children_keys', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.children_keys.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function childrenKeysAddAction(Request $request)
    {
        $this->validate($request, [
            'codekey' => ['nullable', 'max:8'],
            'short_codekey' => ['required', 'size:5'],
            'codekeytime' => ['required', 'date'],
            'expires' => ['nullable', 'date'],
            'status' => ['required', 'in:0,1'],
            'child_id' => ['nullable', 'exists:children,id'],
        ]);

        ChildKey::create($request->all());

        return redirect(route('admin.children_keys'));
    }

    public function childrenSaveAction(Request $request)
    {
        $this->validate($request, [
            'codekey' => ['nullable', 'max:8'],
            'short_codekey' => ['required', 'size:5'],
            'codekeytime' => ['required', 'date'],
            'expires' => ['nullable', 'date'],
            'status' => ['required', 'in:0,1'],
            'child_id' => ['nullable', 'exists:children,id'],
        ]);

        $values = $request->all();
        if (isset($values['codekey'])) {
            $values['codekey'] = hex2bin($values['codekey']);
        }

        ChildKey::findOrFail($request->get('id'))->fill($values)->save();

        return redirect(route('admin.children_keys'));
    }

    public function childrenRemoveAction(Request $request)
    {
        ChildKey::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.access_points'));
    }
}
