<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false;
    protected $table = 'profiles';
    protected $fillable = ['surname', 'name', 'patronymic'];
}
