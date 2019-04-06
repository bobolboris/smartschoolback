<?php

namespace App\MainComponent\Traits;

/**
 * @property mixed type
 */
trait TypesLocationsTrait
{
    static protected $_types = [
        '0' => 'Страна',
        '1' => 'Город',
        '2' => 'Район'
    ];

    public static function getAllTypes()
    {
        return array_values(static::$_types);
    }

    public static function getTypeById($id)
    {
        if (!key_exists($id, static::$_types)) {
            return false;
        }

        return static::$_types[$id];
    }

    public static function getIdByType($name)
    {
        return array_search($name, static::$_types);
    }

    public function getTypeNameAttribute()
    {
        return static::getTypeById($this->type);
    }
}
