<?php

namespace App\CabinetParentsComponent\Http\Controllers\Children;

class IndexController extends BaseChildrenController
{
    public function indexAction()
    {
        $data = $this->baseLoad();
        if ($data['parent']->children->count() > 0) {
            $data['code'] = 200;
            $data['id'] = $data['parent']->children->first()->id;
            return response()->json(['ok' => true, 'data' => $data]);
        }
        $data['code'] = 201;
        return response()->json(['ok' => true, 'data' => $data]);
    }
}
