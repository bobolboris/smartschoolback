<?php

namespace App\CabinetComponent\Http\Controllers;

use App\MainComponent\Access;
use App\MainComponent\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChildrenController extends BaseController
{

    /* entry points*/
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


    /*no entry points*/
    private function childLoad($id, $date, $data)
    {
        $child = Child::find($id);
        $child->school;

        $last = Access::where('child_id', $id)->orderBy('id', 'desc')->first();

        $child->status = ($last->direction == 1) ? 'В учебном заведении с: ' : 'Не в учебном заведении с ';
        $child->status .= "$last->date $last->time";

        $child->access = Access::where('child_id', $id)
            ->where('date', $date)
            ->orderBy('id', 'desc')->get();


        $count = count($child->access);
        foreach ($child->access as $access) {
            $access->number = $count;
            $access->direction_word = ($access->direction == 1) ? 'вход' : 'выход';
            $count--;
        }
        $child->access;
        if (!isset($child)) {
            return response()->json(['ok' => false, 'errors' => ['Child not found']]);
        }
        $data['child'] = $child;
        $data['currentDate'] = $date;
        return response()->json(['ok' => true, 'data' => $data]);
    }

    private function validateIndex(array $request)
    {
        $validator = Validator::make($request, [
            'date' => 'required|date'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    private function validateChild(array $request)
    {
        $validator = Validator::make($request, [
            'date' => 'required|date',
            'child_id' => 'required|exists:children,id'
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }
}
