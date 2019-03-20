<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed key
 * @property mixed value
 * @property mixed user_id
 * @property mixed user
 */
class Setting extends Model
{
    public $timestamps = false;
    protected $table = 'settings';
    protected $fillable = ['key', 'value', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
