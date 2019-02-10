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
class Parents extends Model
{
    public $timestamps = false;
    protected $table = 'parents';
    protected $fillable = ['surname', 'name', 'patronymic', 'is_main', 'user_id', 'parent_id'];
    protected $with = ['user'];

    public function children()
    {
        return $this->belongsToMany('App\MainComponent\Child', 'children_parents', 'parent_id', 'child_id');
    }

    public function user()
    {
        return $this->belongsTo('App\MainComponent\User', 'user_id', 'id');
    }

    public function additional_parents()
    {
        return $this->hasMany('App\MainComponent\Parents', 'parent_id', 'id');
    }
}
