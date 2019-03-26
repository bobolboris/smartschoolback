<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed child
 * @property mixed admin_id
 * @property mixed school_id
 * @property mixed admin
 * @property mixed school
 */
class ClassModel extends Model
{
    public $timestamps = false;
    protected $table = 'classes';
    protected $fillable = ['name', 'admin_id', 'school_id'];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id','admin_id');
    }

    public function school()
    {
        return $this->hasOne(School::class, 'id','school_id');
    }

    public function children()
    {
        return $this->hasMany(Child::class,  'class_id', 'id');
    }
}
