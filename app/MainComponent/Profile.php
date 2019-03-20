<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed surname
 * @property mixed name
 * @property mixed patronymic
 */
class Profile extends Model
{
    public $timestamps = false;
    protected $table = 'profiles';
    protected $fillable = ['surname', 'name', 'patronymic'];
}
