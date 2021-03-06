<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed zonea
 * @property mixed zoneb
 * @property mixed school_id
 * @property mixed system_id
 */
class AccessPoint extends Model
{
    public $timestamps = false;
    protected $table = 'access_points';
    protected $fillable = ['name', 'zonea', 'zoneb', 'school_id', 'system_id'];

    public function school()
    {
        return $this->hasOne(School::class, 'id', 'school_id');
    }

    public function access()
    {
        return $this->hasMany(Access::class,  'access_point_id', 'id');
    }
}
