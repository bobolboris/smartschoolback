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

    }

    public function parent()
    {

    }
}
