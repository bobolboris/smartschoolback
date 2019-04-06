<?php

namespace App\ReceiverComponent;

use App\MainComponent\AccessPoint as Base;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed zonea
 * @property mixed zoneb
 * @property mixed school_id
 * @property mixed system_id
 */
class AccessPoint extends Base
{
    public static function findBySystemId($id)
    {
        return AccessPoint::where('system_id', $id)->first();
    }
}
