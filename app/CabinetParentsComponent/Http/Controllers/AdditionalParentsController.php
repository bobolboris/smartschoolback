<?php

namespace App\CabinetParentsComponent\Http\Controllers;

use App\MainComponent\ChildParent;
use App\MainComponent\ParentModel;
use App\MainComponent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhoenixSmsSender\Facade\SmsSender;
use PhoenixSmsSender\MailingRequest;

class AdditionalParentsController extends BaseController
{
    public function additionalParentsIndexAction()
    {
        $data = $this->baseLoad();
        $data['parent']->additional_parents;
        return response()->json(['ok' => true, 'data' => $data]);
    }

    public function additionalParentsEditAction(Request $request)
    {
        $data = $this->baseLoad();
        $id = $request->get('id', -1);
        $parent = Parent::find($id);

        if ($parent == null) {
            return response()->json(['ok' => false, 'code' => 404, 'errors' => ['Родитель с таким id не был найден']]);
        }

        $parent->user;

        $data['aparent'] = $parent;

        return response()->json(['ok' => true, 'data' => $data]);
    }

    public function saveAdditionalParentAction(Request $request)
    {
        $all = $request->all();
        $result = $this->validationEditAdditionalParent($all);

        if (!$result['ok']) {
            return response()->json($result);
        }

        $parent = Parent::find($all['id']);

        $parent->user;
        $parent->user->phone = $all['phone'];
        $parent->user->email = $all['email'];
        $parent->user->save();

        return response()->json(['ok' => true]);
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
        $user->email = $all['email'];
        $user->password = Hash::make($password);
        $user->roles = "1";
        $user->save();

        $parent_id = Auth::user()->entity->id;

        $parent = new Parent();
        $parent->surname = $all['surname'];
        $parent->name = $all['name'];
        $parent->patronymic = $all['patronymic'];
        $parent->user_id = $user->id;
        $parent->parent_id = $parent_id;
        $parent->save();

        //Send SMS
        $text = "Вы были зарегестрированы на http://lk.умнаяшколаднр.рф. Ваш пароль: $password Никому его не сообщайте!";
        SmsSender::createMailing(new MailingRequest('', $text, [$all['phone']]));

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
            'email' => 'required|email',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    protected function validationEditAdditionalParent(array $request)
    {
        $id = $request['id'];
        $validator = Validator::make($request, [
            'id' => 'required',
            'phone' => "required|regex:/^38071[0-9]{7}$/i|unique:users,phone,$id",
            'email' => "required|email|unique:users,email,$id",
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }
}
