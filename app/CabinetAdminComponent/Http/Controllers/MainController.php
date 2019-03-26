<?php

namespace App\CabinetAdminComponent\Http\Controllers;

class MainController extends BaseController
{
    public function indexAction()
    {
        return view('cabinet_admin.index');
    }
}
