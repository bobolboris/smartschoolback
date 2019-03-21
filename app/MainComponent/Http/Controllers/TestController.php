<?php

namespace App\MainComponent\Http\Controllers;

use App\MainComponent\User;

class TestController
{
    public function testAction()
    {
        dd(User::find(1)->settings->where('key','notification_of_access')->first()->toArray());
        return response('111');
    }
}
