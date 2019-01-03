<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class AccessDenials extends Model
{
    public $timestamps = false;
    protected $table = 'access_denials';
    protected $fillable = ['time', 'date', 'direction', 'cause', 'key_id', 'access_point_id', 'system_id'];

    public function key()
    {

    }

    public function accessPoint()
    {

    }
}
