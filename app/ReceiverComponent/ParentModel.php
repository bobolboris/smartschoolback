<?php

namespace App\ReceiverComponent;

use App\MainComponent\ParentModel as Base;

/**
 * @property mixed id
 * @property mixed profile_id
 * @property mixed user_id
 * @property mixed parent_id
 * @property mixed profile
 * @property mixed children
 */
class ParentModel extends Base
{
    public function children()
    {
        return $this->belongsToMany(Child::class, 'children_parents', 'parent_id', 'child_id');
    }
}
