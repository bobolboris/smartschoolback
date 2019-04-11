<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Child;
use App\CabinetAdminComponent\ChildKey;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChildrenKeysController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = '%' . $request->get('search') . '%';
            $children_keys = ChildKey::where('codekey', 'LIKE', $pattern)
                ->Orwhere('short_codekey', 'LIKE', $pattern)
                ->Orwhere('id', $request->get('search'))
                ->paginate(10);
        } else {
            $children_keys = ChildKey::paginate(10);
        }

        $data = [
            'children_keys' => $children_keys,
        ];

        return view('cabinet_admin.index.children_keys', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $children_key = ChildKey::findOrFail($request->get('id'));

        $children = collect([new Child()])->concat(Child::all());

        $children_key->codekeytime = Carbon::createFromFormat('Y-m-d H:i:s', $children_key->codekeytime);
        $children_key->codekeytime = $children_key->codekeytime->format('Y-m-d\TH:i');

        if (isset($children_key->expires)) {
            $children_key->expires = Carbon::createFromFormat('Y-m-d H:i:s', $children_key->expires);
            $children_key->expires = $children_key->expires->format('Y-m-d\TH:i');
        }

        $data = [
            'children_key' => $children_key,
            'children' => $children,
            'action' => route('admin.children_keys.save')
        ];

        return view('cabinet_admin.edit.children_keys', $data);
    }

    public function showAddFormAction()
    {
        $children_key = new ChildKey();

        $children = collect([new Child()])->concat(Child::all());

        $data = [
            'children_key' => $children_key,
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
            'codekey' => ['nullable', 'max:16'],
            'short_codekey' => ['required', 'size:5'],
            'codekeytime' => ['required', 'date_format:Y-m-d\TH:i'],
            'expires' => ['nullable', 'date_format:Y-m-d\TH:i'],
            'status' => ['required', 'in:0,1'],
            'child_id' => ['nullable', 'exists:children,id'],
        ]);

        $values = $request->all();

        if (isset($values['codekeytime'])) {
            $values['codekeytime'] = str_replace('T', ' ', $values['codekeytime']);
        }

        if (isset($values['expires'])) {
            $values['expires'] = str_replace('T', ' ', $values['expires']);
        }

        ChildKey::create($values);

        return redirect(route('admin.children_keys'));
    }

    public function childrenSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'exists:children_keys'],
            'codekey' => ['nullable', 'max:16'],
            'short_codekey' => ['required', 'size:5'],
            'codekeytime' => ['required', 'date_format:Y-m-d\TH:i'],
            'expires' => ['nullable', 'date_format:Y-m-d\TH:i'],
            'status' => ['required', 'in:0,1'],
            'child_id' => ['nullable', 'exists:children,id'],
        ]);

        $values = $request->all();

        if (isset($values['codekey'])) {
            $values['codekey'] = hex2bin($values['codekey']);
        }

        if (isset($values['codekeytime'])) {
            $values['codekeytime'] = str_replace('T', ' ', $values['codekeytime']);
        }

        if (isset($values['expires'])) {
            $values['expires'] = str_replace('T', ' ', $values['expires']);
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
