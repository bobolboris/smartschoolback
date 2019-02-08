<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Child;
use App\MainComponent\ChildParent;
use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\Parents;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChildParentController extends Controller
{
    public function parentChildrenAction(Request $request)
    {
        $id = $request->get('id');

        $children = Parents::find($id)->children;

        $data = [
            'children' => $children->toArray(),
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

    public function parentChildrenRemoveAction(Request $request)
    {
        $id = $request->get('id');
        ChildParent::destroy($id);
        return redirect(route('admin.parents'));
    }

    public function showAddChildFormAction(Request $request)
    {
        $parent_id = $request->get('id');

        $children = Child::all();

        $data = [
            'parent_id' => $parent_id,
            'children' => $children->toArray()
        ];

        return view('cabinet_admin.edit.parent_children', $data);
    }

    public function addChildAction(Request $request)
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
}
