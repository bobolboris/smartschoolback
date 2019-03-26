<?php

namespace App\CabinetParentsComponent\Http\Controllers;

use App\MainComponent\ChildParent;
use App\MainComponent\ParentModel;
use App\MainComponent\Profile;
use App\MainComponent\Setting;
use App\MainComponent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhoenixSmsSender\Facade\SmsSender;
use PhoenixSmsSender\MailingRequest;

class AdditionalParentsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('check.role:СтаршийРодитель');
    }

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
        $parent = ParentModel::find($id);

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

        $parent = ParentModel::find($all['id']);

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
        $user->roles = User::getRoleIdByName('Родитель');
        $user->save();

        Setting::create([
            'key' => 'notification_of_access',
            'value' => '1',
            'user_id' => $user->id
        ]);

        Setting::create([
            'key' => 'notification_of_access_telegram',
            'value' => '1',
            'user_id' => $user->id
        ]);

        $parentId = Auth::user()->parent->id;

        $profile = new Profile();
        $profile->surname = $all['surname'];
        $profile->name = $all['name'];
        $profile->patronymic = $all['patronymic'];
        $profile->save();

        $parent = new ParentModel();
        $parent->profile_id = $profile->id;
        $parent->user_id = $user->id;
        $parent->parent_id = $parentId;
        $parent->save();

        //Send SMS
        if (env('SMS_AUTH_ENABLE', false)) {
            $text = "Вы были зарегестрированы на http://lk.умнаяшколаднр.рф. Ваш пароль: $password Никому его не сообщайте!";
            SmsSender::createMailing(new MailingRequest('', $text, [$all['phone']]));
        }

        foreach ($all as $key => $item) {
            $pos = strpos($key, "child-");

            if ($pos !== false) {
                $child_id = mb_substr($key, strlen("child-"));
                if (!is_numeric($child_id)) {
                    return ['ok' => false, 'errors' => ['error' => 'Неверный child_id ребенка']];
                }
                if (ChildParent::findByParentAndChildId($child_id, $parentId) == null) {
                    return ['ok' => false, 'errors' => ['error' => "$child_id это не ваш ребенок!"]];
                }
                ChildParent::create(['parent_id' => $parent->id, 'child_id' => $child_id]);
            }
        }

        return response()->json(['ok' => true]);
    }

    public function removeAdditionalParentAction(Request $request)
    {
        $result = $this->validationDeleteAdditionalParent($request->all());

        if (!$result['ok']) {
            return response()->json($result);
        }

        $parent = ParentModel::find($request->get('id'));
        if ($parent->parent_id != Auth::user()->parent->id) {
            return response()->json(['ok' => false, 'code' => 404, 'errors' => ['Это не ваш представитель']]);
        }

        ChildParent::where('parent_id', $request->get('id'))->delete();
        $profile_id = $parent->profile_id;
        $user_id = $parent->user_id;

        $parent->delete();

        Profile::find($profile_id)->delete();

        Setting::where('user_id', $user_id)->delete();

        User::find($user_id)->delete();

        return response()->json($result);
    }

    protected function validationAdditionalParent(array $request)
    {
        $validator = Validator::make($request, [
            'phone' => ['required', 'regex:/^38071[0-9]{7}$/i', 'unique:users,phone'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'surname' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'patronymic' => ['required', 'max:255'],
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    protected function validationEditAdditionalParent(array $request)
    {
        $id = ParentModel::find($request['id'])->user;
        $validator = Validator::make($request, [
            'id' => ['required', 'exists:parents,id'],
            'phone' => ['required', 'regex:/^38071[0-9]{7}$/i', Rule::unique('users', 'phone')->ignore($id, 'id')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id, 'id')]
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }

    protected function validationDeleteAdditionalParent(array $request)
    {
        $validator = Validator::make($request, [
            'id' => ['required', 'exists:parents,id'],
        ]);
        return ($validator->fails()) ? ['ok' => false, 'errors' => $validator->errors()] : ['ok' => true];
    }
}
