<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'determination.position']);
    }
}
