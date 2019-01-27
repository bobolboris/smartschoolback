<?php

namespace App\CabinetComponent\Http\Controllers\Children;

use App\CabinetComponent\Http\Controllers\BaseController;
use App\MainComponent\Access;
use App\MainComponent\Child;

class BaseChildrenController extends BaseController
{
    protected function childLoad($id, $date, $data)
    {
        $child = Child::find($id);
        $child->school;
        $child->key;
        $child->key->codekey = base64_encode($child->key->codekey);
        if ($child->key->expires == null) {
            $child->key->state = 1;
        } else {
            $expires = strtotime($child->key->expires);
            $now = time();

            if ($expires < $now) {
                $child->key->state = 0;
            } else {
                $diff = $now - $expires;
                if ($diff > 60) {
                    $child->key->state = 1;
                } else {
                    $child->key->state = 2;
                    $child->key->diff = -$diff;
                }
            }
        }

        $last = Access::where('child_id', $id)->orderBy('id', 'desc')->first();

        $child->status = ($last->direction == 1) ? 'В учебном заведении с: ' : 'Не в учебном заведении с ';
        $child->status .= "$last->date $last->time";

        $child->access = Access::where('child_id', $id)->where('date', $date)->orderBy('id', 'desc')->get();


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
}