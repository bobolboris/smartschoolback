<?php

namespace App\ReceiverComponent;

use App\MainComponent\Child as Base;

/**
 * @property mixed id
 * @property mixed profile_id
 * @property mixed class_id
 * @property mixed photo_id
 * @property mixed user_id
 * @property mixed system_id
 * @property mixed profile
 * @property mixed parents
 */
class Child extends Base
{
    public static function findBySystemId($id)
    {
        return Child::where('system_id', $id)->first();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }

    public function parents()
    {
        return $this->belongsToMany(ParentModel::class, 'children_parents', 'child_id', 'parent_id');
    }
}
