<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = false;
    protected $table = 'schools';
    protected $fillable = ['address', 'name'];
}
