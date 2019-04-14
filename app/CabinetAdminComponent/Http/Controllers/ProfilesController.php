<?php


namespace App\CabinetAdminComponent\Http\Controllers;

use App\CabinetAdminComponent\Profile;
use Illuminate\Http\Request;

class ProfilesController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ($request->exists('search')) {
            $pattern = '%' . $request->get('search') . '%';
            $profiles = Profile::where('name', 'LIKE', $pattern)
                ->Orwhere('surname', 'LIKE', $pattern)
                ->Orwhere('patronymic', 'LIKE', $pattern)
                ->Orwhere('id', $request->get('search'))
                ->paginate(10);
        } else {
            $profiles = Profile::paginate(10);
        }

        $data = [
            'profiles' => $profiles
        ];

        return view('cabinet_admin.index.profiles', $data);
    }

    public function showEditFormAction(Request $request)
    {
        $data = [
            'profile' => Profile::findOrFail($request->get('id')),
            'action' => route('admin.profile.save')
        ];

        return view('cabinet_admin.edit.profiles', $data);
    }

    public function showAddFormAction()
    {
        $data = [
            'profile' => new Profile(),
            'action' => route('admin.profile.add')
        ];

        return view('cabinet_admin.edit.profiles', $data);
    }

    public function showRemoveFormAction(Request $request)
    {
        $data = [
            'id' => $request->get('id'),
            'backurl' => $request->server('HTTP_REFERER', '/'),
            'action' => route('admin.profile.remove')
        ];

        return view('cabinet_admin.remove.remove', $data);
    }

    public function addAction(Request $request)
    {
        $this->validate($request, [
            'surname' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'patronymic' => ['required', 'max:255'],
        ]);

        Profile::create($request->all());

        return redirect(route('admin.profiles'));
    }

    public function saveAction(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'exists:profiles'],
            'surname' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'patronymic' => ['required', 'max:255'],
        ]);

        Profile::findOrFail($request->get('id'))->fill($request->all())->save();

        return redirect(route('admin.profiles'));
    }

    public function removeAction(Request $request)
    {
        Profile::findOrFail($request->get('id'))->delete();
        return redirect(route('admin.profiles'));
    }
}
