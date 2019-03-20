<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed path
 * @property mixed user
 */
class Photo extends Model
{
    public $timestamps = false;
    protected $table = 'photos';
    protected $fillable = ['path'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
