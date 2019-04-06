<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed time
 * @property mixed date
 * @property mixed direction
 * @property mixed cause
 * @property mixed key_id
 * @property mixed access_point_id
 * @property mixed system_id
 */
class AccessDenial extends Model
{
    public $timestamps = false;
    protected $table = 'access_denials';
    protected $fillable = ['time', 'date', 'direction', 'cause', 'key_id', 'access_point_id', 'system_id'];

    public function key()
    {
        return $this->hasOne(ChildKey::class, 'id', 'key_id');
    }

    public function accessPoint()
    {
        return $this->hasOne(AccessPoint::class, 'id', 'access_point_id');
    }
}
