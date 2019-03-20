<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed type
 * @property mixed profile_id
 * @property mixed user_id
 * @property mixed locality_id
 */
class Admin extends Model
{
    public $timestamps = false;
    protected $table = 'localities';
    protected $fillable = ['type', 'profile_id', 'user_id', 'locality_id'];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'profile_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function locality()
    {
        return $this->hasOne(Locality::class, 'id', 'locality_id');
    }
}
