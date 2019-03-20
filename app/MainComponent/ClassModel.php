<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed child
 * @property mixed school_id
 * @property mixed school
 */
class ClassModel extends Model
{
    public $timestamps = false;
    protected $table = 'classes';
    protected $fillable = ['name', 'school_id'];
    protected $with = ['school'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Child::class,  'class_id', 'id');
    }
}
