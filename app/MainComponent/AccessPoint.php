<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class AccessPoint extends Model
{
    public $timestamps = false;
    protected $table = 'access_points';
    protected $fillable = ['name', 'zonea', 'zoneb', 'school_id', 'system_id'];

    public function school()
    {

    }

    public static function findBySystemId($id)
    {
        return AccessPoint::where('system_id', $id)->first();
    }
}
