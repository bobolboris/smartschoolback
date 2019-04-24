<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed profile_id
 * @property mixed class_id
 * @property mixed photo_id
 * @property mixed user_id
 * @property mixed inn
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
    protected $fillable = ['profile_id', 'class_id', 'photo_id', 'user_id', 'inn', 'system_id'];

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
        return $this->hasOne(ClassModel::class, 'id', 'class_id');
    }

    public function key()
    {
        return $this->hasOne(ChildKey::class, 'child_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function photo()
    {
        return $this->hasOne(Photo::class, 'id', 'photo_id');
    }

}
