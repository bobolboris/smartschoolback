<?php

namespace App\MainComponent;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed codekey
 * @property mixed short_codekey
 * @property mixed codekeytime
 * @property mixed expires
 * @property mixed status
 * @property mixed child_id
 * @property mixed child
 */
class ChildKey extends Model
{
    public $timestamps = false;
    protected $table = 'children_keys';
    protected $fillable = ['codekey', 'short_codekey', 'codekeytime', 'expires', 'status', 'child_id'];

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id', 'id');
    }
}
