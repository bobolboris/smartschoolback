<?php

namespace App\CabinetParentsComponent\Http\Controllers\Children;

use App\CabinetParentsComponent\Http\Controllers\BaseController;
use App\MainComponent\Access;
use App\MainComponent\Child;
use Illuminate\Support\Facades\Log;

class BaseChildrenController extends BaseController
{
    protected function childLoad($id, $date, $data)
    {
        $child = Child::find($id);

        if ($child == null) {
            return response()->json(['ok' => false, 'code' => 404, 'errors' => ['Child not found']]);
        }

        $child->schoolClass->school;
        $child->key;
        $child->key->codekey = base64_encode($child->key->codekey);

        Log::info('2');

        if ($child->key->expires != null) {
            $expires = strtotime($child->key->expires);
            $now = time();
            $child->key->state = ($expires < $now) ? 0 : 1;
        } else {
            $child->key->state = 1;
        }

        $last = Access::where('child_id', $id)->orderBy('id', 'desc')->first();

        $child->status = ($last->direction == 1) ? 'В учебном заведении с: ' : 'Не в учебном заведении с ';
        $child->status .= "$last->date $last->time";

        $child->access = Access::where('child_id', $id)->where('date', $date)->orderBy('id', 'desc')->get();

        Log::info('2');
        $count = count($child->access);
        foreach ($child->access as $access) {
            $access->number = $count;
            $access->direction_word = ($access->direction == 1) ? 'вход' : 'выход';
            $count--;
        }
        $child->access;

        Log::info('4');

        $data['child'] = $child;
        $data['currentDate'] = $date;
        return response()->json(['ok' => true, 'data' => $data]);
    }
}
