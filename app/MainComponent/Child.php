<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed profile_id
 * @property mixed class_id
 * @property mixed photo_id
 * @property mixed user_id
 * @property mixed system_id
 * @property mixed profile
 * @property mixed parents
 * @property mixed class
 * @property mixed key
 * @property mixed user
 * @property mixed photo
 */
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
        return $this->hasOne(Profile::class, 'id', 'profile_id');
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
        return $this->hasOne(Photo::class, 'id', 'photo_id');
    }

}
