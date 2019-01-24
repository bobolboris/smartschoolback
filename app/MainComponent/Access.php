<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/*
 * 0 – Неопределенно.
 * 1 – На выход.
 * 2 – На вход.
 * 3 – Неизвестно.
 */

class Access extends Model
{
    public $timestamps = false;
    protected $table = 'access';
    protected $fillable = ['direction', 'time', 'date', 'cause', 'child_id', 'access_point_id', 'system_id'];

    public function child()
    {

    }

    public function accessPoint()
    {
        return $this->hasOne('App\MainComponent\AccessPoint', 'id', 'access_point_id');
    }
}
