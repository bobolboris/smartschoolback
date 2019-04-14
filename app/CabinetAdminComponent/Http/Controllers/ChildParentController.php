<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Child;
use App\CabinetAdminComponent\ChildParent;
use App\CabinetAdminComponent\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChildParentController extends BaseController
{
    public function indexAction(Request $request)
    {
        $id = $request->get('id');

        $parent = ParentModel::findOrFail($id);

        $children = $parent->children;

        $data = [
            'children' => $children,
            'fullName' => $parent->profile->full_name,
            'id' => $id
        ];

        return view('cabinet_admin.index.parent_children', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'action' => route('admin.parent_children.remove'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'id' => $request->get('id')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function showAddFormAction(Request $request)
    {
        $children = Child::all();

        $data = [
            'parent_id' => $request->get('id'),
            'children' => $children
        ];

        return view('cabinet_admin.edit.parent_children', $data);
    }

    public function addAction(Request $request)
    {
        $child_id = $request->get('child_id');
        $parent_id = $request->get('parent_id');

        $count = ChildParent::where('child_id', $child_id)->where('parent_id', $parent_id)->count();
        if ($count > 0) {
            throw ValidationException::withMessages(['child_id' => ['У данного родителя уже назначен этот ребенок']]);
        }

        ChildParent::create(['child_id' => $child_id, 'parent_id' => $parent_id]);

        return redirect(route('admin.parent_children', ['id' => $parent_id]));
    }

    public function removeAction(Request $request)
    {
        ChildParent::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.parents'));
    }
}
