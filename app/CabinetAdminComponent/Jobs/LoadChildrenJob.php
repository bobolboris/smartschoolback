<?php

namespace App\CabinetAdminComponent\Jobs;

use App\CabinetAdminComponent\Child;
use App\CabinetAdminComponent\ChildKey;
use App\CabinetAdminComponent\ChildParent;
use App\CabinetAdminComponent\ClassModel;
use App\CabinetAdminComponent\ParentModel;
use App\CabinetAdminComponent\Profile;
use App\CabinetAdminComponent\Tools\Coordinate;
use App\CabinetAdminComponent\User;
use App\MainComponent\Jobs\Job;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LoadChildrenJob extends Job
{
    protected $data;
    protected $redisKey;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    protected function pushToRedis($value)
    {
        Redis::lpush($this->redisKey, $value);
        Redis::expire($this->redisKey, 60 * 60 * 2);
    }

    protected function getReader($extension)
    {
        $readers = [
            'xlsx' => \PhpOffice\PhpSpreadsheet\Reader\Xlsx::class,
            'xls' => \PhpOffice\PhpSpreadsheet\Reader\Xls::class,
            'ods' => \PhpOffice\PhpSpreadsheet\Reader\Ods::class
        ];
        return $readers[$extension];
    }

    protected function readRow(Worksheet $sheet, Coordinate $coordinate)
    {
        $names = [
            'short_codekey', 'childSurname', 'childName',
            'childPatronymic', 'childInn', 'class',
            'parentSurname', 'parentName', 'parentPatronymic',
            'parentInn', 'parentPhone', 'parentEmail',
        ];

        $row = [];

        $start = clone $coordinate;
        try {
            foreach ($names as $key) {
                $row[$key] = $sheet->getCell(strval($start))->getValue();
                $start->nextX();
            }
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            $this->pushToRedis($e->getMessage());
        }
        return $row;
    }

    protected function check($path, $extension, $start, $finish)
    {
        $readerClass = $this->getReader($extension);
        $reader = new $readerClass();

        try {
            $file = $reader->load($path);
            $sheet = $file->getActiveSheet();
        } catch (Exception $e) {
            $this->pushToRedis($e->getMessage());
            return false;
        }

        $start = new Coordinate($start);
        $finish = new Coordinate($finish);

        $rules = [
            'short_codekey' => ['required', 'size:5', 'exists:children_keys,short_codekey'],
            'childSurname' => ['required', 'max:255'],
            'childName' => ['required', 'max:255'],
            'childPatronymic' => ['required', 'max:255'],
            'childInn' => ['required', 'regex:/^[0-9]{10}$/i', 'unique:parents,inn', 'unique:children,inn'],
            'class' => ['required', 'max:255', 'exists:classes,name'],
            'parentSurname' => ['required', 'max:255'],
            'parentName' => ['required', 'max:255'],
            'parentPatronymic' => ['required', 'max:255'],
            'parentInn' => ['required', 'regex:/^[0-9]{10}$/i', 'unique:parents,inn', 'unique:children,inn'],
            'parentPhone' => ['required', 'regex:/^38071[0-9]{7}$/i', 'unique:users,phone'],
            'parentEmail' => ['required', 'email', 'unique:users,email'],
        ];


        $inns = [];
        $phones = [];
        $emails = [];
        $codes = [];

        while ($start->getY() <= $finish->getY()) {
            $row = $this->readRow($sheet, $start);
            $validator = Validator::make($row, $rules);

            if ($validator->fails()) {
                $this->pushToRedis(json_encode(['ok' => false, 'errors' => $validator->errors()->all()]));
                return false;
            }

            $child = $row['childSurname'] . $row['childName'] . $row['childPatronymic'];

            if (isset($inns[$row['childInn']])) {
                $arr = ['ok' => false, 'errors' => ['Ребенок (или Родитель) с таким инн уже существует']];
                $this->pushToRedis(json_encode($arr));
                return false;
            }
            $inns[$row['childInn']] = $child;

            $parent = $row['parentSurname'] . $row['parentName'] . $row['parentPatronymic'];
            if (isset($inns[$row['parentInn']]) && $inns[$row['parentInn']] != $parent) {
                $arr = ['ok' => false, 'errors' => ['Родитель (или Ребенок) с таким инн уже существует']];
                $this->pushToRedis(json_encode($arr));
                return false;
            }
            $inns[$row['parentInn']] = $parent;

            if (isset($phones[$row['parentPhone']]) && $phones[$row['parentPhone']] != $parent) {
                $arr = [
                    'ok' => false,
                    'errors' => ['Родитель с другим именем и с таким же номером телефона уже существует']
                ];
                $this->pushToRedis(json_encode($arr));
                return false;
            }
            $phones[$row['parentPhone']] = $parent;

            if (isset($emails[$row['parentEmail']]) && $inns[$row['parentEmail']] != $parent) {
                $arr = [
                    'ok' => false,
                    'errors' => ['Родитель с другим именем и с таким же email уже существует']
                ];
                $this->pushToRedis(json_encode($arr));
                return false;
            }
            $emails[$row['parentEmail']] = $parent;

            if (isset($emails[$row['short_codekey']]) && $inns[$row['short_codekey']] != $parent) {
                $arr = [
                    'ok' => false,
                    'errors' => ['Ребенок с таким номером пропуска уже существует номер пропуска']
                ];
                $this->pushToRedis(json_encode($arr));
                return false;
            }
            $codes[$row['short_codekey']] = $parent;

            $this->pushToRedis(json_encode([
                'ok' => true,
                'finish' => false,
                'data' => ['Line: ' . $start->getY() . ' success']
            ]));

            $start->nextY();
        }
        return true;
    }

    public function handle()
    {
        $this->redisKey = 'LoadExcel' . $this->job->getJobId();

        $this->pushToRedis(json_encode([
            'ok' => true,
            'finish' => false,
            'data' => ['Started']
        ]));

        $state = $this->check($this->data['path'], $this->data['extension'], $this->data['start'], $this->data['finish']);
        if ($state) {
            $this->load($this->data['path'], $this->data['extension'], $this->data['start'], $this->data['finish']);
        }
        File::delete($this->data['path']);
    }

    protected function load($path, $extension, $start, $finish)
    {
        $readerClass = $this->getReader($extension);
        $reader = new $readerClass();

        try {
            $file = $reader->load($path);
            $sheet = $file->getActiveSheet();
        } catch (Exception $e) {
            $arr = [
                'ok' => false,
                'errors' => [$e->getMessage()]
            ];
            $this->pushToRedis(json_encode($arr));
            return;
        }

        $start = new Coordinate($start);
        $finish = new Coordinate($finish);

        while ($start->getY() <= $finish->getY()) {
            try {
                $row = $this->readRow($sheet, $start);

                $class = ClassModel::where('name', $row['class'])->first();

                $childProfile = Profile::create([
                    'surname' => $row['childSurname'],
                    'name' => $row['childName'],
                    'patronymic' => $row['childPatronymic'],
                ]);

                $child = Child::create([
                    'profile_id' => $childProfile->id,
                    'class_id' => $class->id,
                    'inn' => $row['childInn']
                ]);

                $childKey = ChildKey::where('short_codekey', $row['short_codekey'])->first();
                $childKey->child_id = $child->id;
                $childKey->save();

                $parentUser = User::create([
                    'roles' => '12',
                    'email' => $row['parentEmail'],
                    'phone' => $row['parentPhone'],
                    'password' => Hash::make('123456')
                ]);

                $parentProfile = Profile::create([
                    'surname' => $row['parentSurname'],
                    'name' => $row['parentName'],
                    'patronymic' => $row['parentPatronymic'],
                ]);

                $parent = ParentModel::create([
                    'profile_id' => $parentProfile->id,
                    'user_id' => $parentUser->id,
                    'inn' => $row['parentInn']
                ]);

                ChildParent::create([
                    'child_id' => $child->id,
                    'parent_id' => $parent->id
                ]);

                $this->pushToRedis('Line: ' . $start->getY() . ' added');

                $start->nextY();
            } catch (Exception $e) {
                $arr = [
                    'ok' => false,
                    'errors' => [$e->getMessage()]
                ];
                $this->pushToRedis(json_encode($arr));
                return;
            }
        }

        $this->pushToRedis(json_encode([
            'ok' => true,
            'finish' => true,
            'data' => []
        ]));
    }
}
