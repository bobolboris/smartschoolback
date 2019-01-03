<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class ChildKey extends Model
{
    public $timestamps = false;
    protected $table = 'children_keys';
    protected $fillable = ['codekey', 'short_codekey', 'codekeytime', 'expires', 'status', 'child_id'];

    public function child()
    {

    }
}
