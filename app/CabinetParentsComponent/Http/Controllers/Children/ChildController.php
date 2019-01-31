<?php

namespace App\CabinetParentsComponent\Http\Controllers\Children;

use App\MainComponent\Access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChildController extends BaseChildrenController
{
    public function getAccessByDateAction(Request $request)
    {
        $result = $this->validateChild($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }

        $date = $request->get('date');
        $id = $request->get('child_id');

        $access = Access::where('child_id', $id)->where('date', $date)->orderBy('id', 'desc')->get();

        $count = count($access);
        foreach ($access as $value) {
            $value->number = $count;
            $value->direction_word = ($value->direction == 1) ? 'вход' : 'выход';
            $count--;
        }

        $result['data'] = $access;

        return response()->json($result);
    }

    public function childAction(Request $request)
    {
        $result = $this->validateChild($request->all());
        if (!$result['ok']) {
            return response()->json($result);
        }
        $date = $request->get('date', date('Y-m-d'));
        $child_id = $request->get('child_id');
        return $this->childLoad($child_id, $date, $this->baseLoad());
    }

    protected function validateChild(array $request)
    {
        $validator = Validator::make($request, [
            'date' => 'required|date',
            'child_id' => 'required|exists:children,id'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }
}
