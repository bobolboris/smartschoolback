<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed address
 * @property mixed name
 * @property mixed locality_id
 * @property mixed classes
 * @property mixed locality
 */
class School extends Model
{
    public $timestamps = false;
    protected $table = 'schools';
    protected $fillable = ['address', 'name', 'locality_id'];

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'school_id', 'id');
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class, 'id', 'locality_id');
    }
}
