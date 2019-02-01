<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    public $timestamps = false;
    protected $table = 'classes';
    protected $fillable = ['name', 'school_id'];

    public function school()
    {
        return $this->belongsTo('App\MainComponent\School', 'school_id', 'id');
    }
}
