<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    public $timestamps = false;
    protected $table = 'children';
    protected $fillable = ['profile_id', 'class_id', 'photo_id', 'user_id', 'system_id'];
    protected $with = ['profile', 'user', 'photo', 'class'];

    public static function findBySystemId($id)
    {
        return Child::where('system_id', $id)->first();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'profile_id', 'id');
    }

    public function parents()
    {
        return $this->belongsToMany(ParentModel::class, 'children_parents', 'child_id', 'parent_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function key()
    {
        return $this->hasOne(ChildKey::class, 'child_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function photo()
    {
        return $this->hasOne(Photo::class, 'photo_id', 'id');
    }

}
