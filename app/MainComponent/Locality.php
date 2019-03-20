<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed type
 * @property mixed name
 * @property mixed locality_id
 * @property mixed locality
 * @property mixed schools
 * @property mixed admins
 */
class Locality extends Model
{
    public $timestamps = false;
    protected $table = 'localities';
    protected $fillable = ['type', 'name', 'locality_id'];

    public function locality()
    {
        return $this->hasOne(Locality::class, 'id', 'locality_id');
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'id', 'locality_id');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'id', 'locality_id');
    }
}
