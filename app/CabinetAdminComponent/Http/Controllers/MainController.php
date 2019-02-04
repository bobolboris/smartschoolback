<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return view('cabinet_admin.index');
    }
}
