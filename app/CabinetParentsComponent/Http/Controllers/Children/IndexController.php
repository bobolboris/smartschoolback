<?php

namespace App\CabinetParentsComponent\Http\Controllers\Children;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends BaseChildrenController
{
    public function indexAction(Request $request)
    {
        $result = $this->validateIndex($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }
        $date = $request->get('date', date('Y-m-d'));
        $data = $this->baseLoad();
        if ($data['parent']->children->count() > 0) {
            return $this->childLoad($data['parent']->children->first()->id, $date, $data);
        }
        return response()->json(['ok' => true, 'data' => $data]);
    }

    protected function validateIndex(array $request)
    {
        $validator = Validator::make($request, [
            'date' => 'required|date'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }
}
