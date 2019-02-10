<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    protected $table = 'settings';
    protected $fillable = [
        'user_id',
        'notification_of_access',
        'notification_of_access_telegram',
        'telegram_chat_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\MainComponent\User', 'user_id', 'id');
    }
}
