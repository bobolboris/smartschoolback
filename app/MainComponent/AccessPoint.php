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
    protected $with = ['school'];

    public static function findBySystemId($id)
    {
        return AccessPoint::where('system_id', $id)->first();
    }

    public function school()
    {
        return $this->hasOne('App\MainComponent\School', 'id', 'school_id');
    }

    public function access()
    {
        return $this->hasMany(Access::class,  'access_point_id', 'id');
    }
}
