<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed profile_id
 * @property mixed user_id
 * @property mixed school_id
 * @property mixed locality_id
 * @property mixed profile
 * @property mixed user
 * @property mixed school
 * @property mixed locality
 * @property mixed class
 */
class Admin extends Model
{
    public $timestamps = false;
    protected $table = 'admins';
    protected $fillable = ['profile_id', 'user_id', 'school_id', 'locality_id'];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function school()
    {
        return $this->hasOne(School::class, 'id','school_id');
    }

    public function locality()
    {
        return $this->hasOne(Locality::class,  'id', 'locality_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'admin_id',  'id');
    }
}
