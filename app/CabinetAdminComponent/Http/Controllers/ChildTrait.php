<?php

namespace App\CabinetAdminComponent\Http\Controllers;

use App\MainComponent\Child;
use App\MainComponent\School;
use App\MainComponent\ClassModel;

trait ChildTrait
{
    protected function createEmptyChild()
    {
        $school = new School(['id' => -1, 'name' => '-', 'address' => '-']);
        $schoolClass = new ClassModel(['id' => -1, 'name' => '-', 'school_id' => -1]);
        $schoolClass->school = $school;

        $child = new Child();
        $child->id = -1;
        $child->surname = '';
        $child->name = '-';
        $child->patronymic = '';
        $child->photo_id = null;
        $child->class_id = null;
        $child->user_id = null;
        $child->system_id = -1;
        $child->school_class = $schoolClass;

        return $child;
    }
}
