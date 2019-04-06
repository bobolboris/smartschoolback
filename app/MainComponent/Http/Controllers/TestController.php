<?php

namespace App\MainComponent\Http\Controllers;

use App\CabinetAdminComponent\Locality;

class TestController
{
    public function testAction()
    {
        dd(Locality::find(2));
        return response('111');
    }
}
