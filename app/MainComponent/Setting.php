<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

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
