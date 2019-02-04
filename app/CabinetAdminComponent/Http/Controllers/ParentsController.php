<?php

namespace App\CabinetAdminComponent\Http\Controllers;


use App\MainComponent\Http\Controllers\Controller;
use App\MainComponent\Parents;
use App\MainComponent\User;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    public function parentsAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = "%" . $request->get('search') . "%";
            $parents = Parents::Orwhere('name', 'LIKE', $pattern)
                ->OrWhere('surname', 'LIKE', $pattern)
                ->OrWhere('patronymic', 'LIKE', $pattern)
                ->get();
        } else {
            $parents = Parents::all();
        }


        $users = collect([new User(['email' => 'NULL'])]);
        $users = $users->concat(User::all())->all();

        $data = [
            'parents' => $parents,
            'users' => $users
        ];

        return view('cabinet_admin.parents', $data);
    }

    public function parentsAddAction(Request $request)
    {
        $this->validate($request, [
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
//            'user_id' => 'nullable|exists:users,id|unique:parents|unique:children',
        ]);

        Parents::create($request->all());

        return redirect(route('admin.parents'));
    }

    public function parentsSaveAction(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:parents',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
//            'user_id' => 'nullable|exists:users,id|unique:parents|unique:children',
        ]);

        $id = $request->get('id');

        $parent = Parents::find($id);
        $parent->fill($request->all());
        $parent->save();

        return redirect(route('admin.parents'));
    }
}
