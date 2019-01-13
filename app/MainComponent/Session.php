<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed sms_code
 * @property mixed token
 * @property mixed expire_sms_code
 * @property mixed ip
 * @property mixed os
 * @property mixed browser
 * @property mixed user_id
 */
class Session extends Model
{
    protected $table = 'sessions';
    protected $fillable = ['sms_code', 'token', 'expire', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\MainComponent\User', 'user_id', 'id');
    }
}
