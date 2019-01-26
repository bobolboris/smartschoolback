<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class ChildParent extends Model
{
    public $timestamps = false;
    protected $table = 'children_parents';
    protected $fillable = ['child_id', 'parent_id'];

    public function child()
    {
        return $this->belongsTo('App\MainComponent\Child', 'child_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\MainComponent\Parent', 'parent_id', 'id');
    }

    public static function findByParentAndChildId($child_id, $parent_id)
    {
        return ChildParent::where('child_id', $child_id)->where('parent_id', $parent_id)->first();
    }
}
