<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return view('cabinet_admin.index');
    }

    public function parentsAction()
    {
        return view('cabinet_admin.parents');
    }

    public function usersAction()
    {
        return view('cabinet_admin.users');
    }

    public function accessPointsAction()
    {
        return view('cabinet_admin.access_points');
    }
}
