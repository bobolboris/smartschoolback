<?php

namespace App\MainComponent\Http\Controllers;

use App\MainComponent\Child;
use PhoenixSmsSender\Facade\SmsSender;

class TestController
{
    public function testAction()
    {
        return response('111');
    }
}
