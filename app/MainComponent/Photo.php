<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $timestamps = false;
    protected $table = 'photos';
    protected $fillable = ['path'];
}
