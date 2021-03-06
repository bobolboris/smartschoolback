<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed child_id
 * @property mixed child
 * @property mixed parent_id
 * @property mixed parent
 */
class ChildParent extends Model
{
    public $timestamps = false;
    protected $table = 'children_parents';
    protected $fillable = ['child_id', 'parent_id'];

    public static function findByParentAndChildId($child_id, $parent_id)
    {
        return ChildParent::where('child_id', $child_id)->where('parent_id', $parent_id)->first();
    }

    public function child()
    {
        return $this->hasOne(Child::class, 'id', 'child_id');
    }

    public function parent()
    {
        return $this->hasOne(ParentModel::class, 'id', 'parent_id');
    }
}
