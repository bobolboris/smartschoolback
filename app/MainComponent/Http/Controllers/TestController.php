<?php

namespace App\MainComponent\Http\Controllers;

use App\CabinetAdminComponent\Jobs\LoadChildrenJob;

class TestController extends Controller
{
    public function testAction()
    {
        $data = [
            'path' => '/tmp/book.xlsx',
            'extension' => 'xlsx',
            'start' => 'A1',
            'finish' => 'L20',
        ];

        $this->dispatch(new LoadChildrenJob($data));
        return response('111');
    }
}
