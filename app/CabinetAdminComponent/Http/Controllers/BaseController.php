<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $showNULL;

    public function __construct()
    {
        $this->middleware(['auth', 'determination.position']);

        $this->showNULL = function ($value) {
            return $value == null ? 'NULL' : $value;
        };


    }
}
