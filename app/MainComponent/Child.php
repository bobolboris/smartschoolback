<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    public $timestamps = false;
    protected $table = 'children';
    protected $fillable = ['surname', 'name', 'patronymic', 'photo_id', 'school_id', 'user_id', 'system_id'];

    public static function findBySystemId($id)
    {
        return Child::where('system_id', $id)->first();
    }

    public function parents()
    {
        return $this->belongsToMany('App\MainComponent\Parents', 'children_parents', 'child_id', 'parent_id');
    }

    public function school()
    {
        return $this->belongsTo('App\MainComponent\School', 'school_id', 'id');
    }

    public function key()
    {
        return $this->hasOne('App\MainComponent\ChildKey', 'child_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\MainComponent\User', 'user_id', 'id');
    }

//    public function access()
//    {
//        return $this->hasMany('App\MainComponent\Access', 'child_id', 'id');
//    }
//
//    public function photo()
//    {
//
//    }
//
//    public function keys()
//    {
//
//    }
}
