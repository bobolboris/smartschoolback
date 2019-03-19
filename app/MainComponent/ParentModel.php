<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed surname
 * @property mixed name
 * @property mixed patronymic
 * @property mixed is_main
 * @property mixed user_id
 * @property mixed parent_id
 * @property mixed children
 * @property mixed user
 * @property mixed additional_parents
 */
class ParentModel extends Model
{
    public $timestamps = false;
    protected $table = 'parents';
    protected $fillable = ['profile_id', 'user_id', 'parent_id'];
    protected $with = ['user'];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'profile_id', 'id');
    }

    public function children()
    {
        return $this->belongsToMany(Child::class, 'children_parents', 'parent_id', 'child_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function additional_parents()
    {
        return $this->hasMany(ParentModel::class, 'parent_id', 'id');
    }
}
