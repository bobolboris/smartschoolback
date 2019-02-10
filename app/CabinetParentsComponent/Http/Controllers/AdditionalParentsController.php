<?php

namespace App\CabinetParentsComponent\Http\Controllers;

use App\MainComponent\ChildParent;
use App\MainComponent\Parents;
use App\MainComponent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdditionalParentsController extends BaseController
{
    public function additionalParentsIndexAction()
    {
        $data = $this->baseLoad();
        $data['parent']->additional_parents;
        return response()->json(['ok' => true, 'data' => $data]);
    }

    public function addNewAdditionalParentAction(Request $request)
    {
        $all = $request->all();
        $result = $this->validationAdditionalParent($all);

        if (!$result['ok']) {
            return response()->json($result);
        }

        $password = $this->generateRandomWord(8);

        $user = new User();

        $user->phone = $all['phone'];
        $user->email = @$all['email'];
        $user->password = Hash::make($password);
        $user->roles = "1";
        $user->save();

        $parent_id = Auth::user()->entity->id;

        $parent = new Parents();
        $parent->surname = $all['surname'];
        $parent->name = $all['name'];
        $parent->patronymic = $all['patronymic'];
        $parent->user_id = $user->id;
        $parent->parent_id = $parent_id;
        $parent->save();

        //Send SMS

        foreach ($all as $key => $item) {
            $pos = strpos($key, "child-");

            if ($pos !== false) {
                $child_id = mb_substr($key, strlen("child-"));
                if (!is_numeric($child_id)) {
                    return ['ok' => false, 'errors' => ['error' => 'Неверный child_id ребенка']];
                }
                if (ChildParent::findByParentAndChildId($child_id, $parent_id) == null) {
                    return ['ok' => false, 'errors' => ['error' => "$child_id это не ваш ребенок!"]];
                }
                ChildParent::create(['parent_id' => $parent->id, 'child_id' => $child_id]);
            }
        }

        return response()->json(['ok' => true]);
    }

    protected function validationAdditionalParent(array $request)
    {
        $validator = Validator::make($request, [
            'phone' => 'required|regex:/^38071[0-9]{7}$/i|unique:users,phone',
            'email' => 'nullable|email',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }
}
