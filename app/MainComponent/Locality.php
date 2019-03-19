<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    public $timestamps = false;
    protected $table = 'localities';
    protected $fillable = ['type', 'name', 'locality_id'];

    public function locality()
    {
        return $this->hasOne(Locality::class, 'id', 'locality_id');
    }
}
