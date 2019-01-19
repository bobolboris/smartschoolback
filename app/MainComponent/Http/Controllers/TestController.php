<?php

namespace App\MainComponent\Http\Controllers;


use App\MainComponent\Child;

class TestController
{
    public function testAction()
    {
        $child = Child::find(1);
        //dump(serialize($child));

//        $child->access = 'huy';

//        dump($child->toArray());

        $child->access = $child->access()->get();
        $child->access = "huy";
        dump($child->toArray());
        return response('111');
    }
}
