<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    public $timestamps = false;
    protected $table = 'parents';
    protected $fillable = ['surname', 'name', 'patronymic', 'user_id'];

    public function children()
    {
        return $this->belongsToMany('App\MainComponent\Child', 'children_parents', 'parent_id', 'child_id');
    }

    public function user()
    {
		return $this->belongsTo('App\MainComponent\User', 'user_id', 'id');
    }
}
