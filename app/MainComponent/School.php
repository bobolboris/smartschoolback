<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = false;
    protected $table = 'schools';
    protected $fillable = ['address', 'name', 'locality_id'];

    public function classes()
    {
        return $this->belongsTo(ClassModel::class, 'school_id', 'id');
    }

    public function locality()
    {
        return $this->hasOne(Locality::class, 'id', 'locality_id');
    }
}
