<?php

namespace App\MainComponent\Traits;


/**
 * @property mixed roles_array
 */
trait RolesTrait
{
    static protected $_roles = [
        'СуперАдмин' => '0',
        'АдминСтраны' => '2',
        'АдминГорода' => '4',
        'АдминРайона' => '6',
        'АдминШколы' => '8',
        'КлассныйРуководитель' => '10',
        'СтаршийРодитель' => '12',
        'Родитель' => '14',
        'Ребенок' => '16',
    ];

    /**
     * @param $roles
     * @return bool
     * @throws \Throwable
     */
    public function hasAllRoles($roles)
    {
        if (count($this->roles_array) == 0) {
            return false;
        }

        if (!is_array($roles)) {
            $roles = [$roles];
        }

        foreach ($roles as $role) {
            throw_if(!key_exists($role, static::$_roles), \Exception::class, "Unknown role: $role");

            if (array_search(static::$_roles[$role], $this->roles_array) === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $roles
     * @return bool
     * @throws \Throwable
     */
    public function hasOneRoles($roles)
    {
        if (count($this->roles_array) == 0) {
            return false;
        }

        if (!is_array($roles)) {
            $roles = [$roles];
        }

        foreach ($roles as $role) {
            throw_if(!key_exists($role, static::$_roles), \Exception::class, "Unknown role: $role");

            if (array_search(static::$_roles[$role], $this->roles_array) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $role
     * @return bool
     * @throws \Throwable
     */
    public function hasRole($role)
    {
        return $this->hasOneRoles([$role]);
    }

    public static function getRoleIdByName($name)
    {
        if (!isset(static::$_roles[$name])) {
            return -1;
        }

        return static::$_roles[$name];
    }

    public static function getRoleById($id)
    {
        return array_search($id, static::$_roles);
    }

    public static function getAllRoles()
    {
        return static::$_roles;
    }

    public function getRolesArrayAttribute()
    {
        static $value = [];
        static $old = null;

        if (!isset($this->attributes['roles'])) {
            return $value;
        }

        if ($old == null) {
            $old = $this->attributes['roles'];
            $value = explode(',', $this->attributes['roles']);
        } else if ($old != $this->attributes['roles']) {
            $value = explode(',', $this->attributes['roles']);
        }

        return $value;
    }

}
