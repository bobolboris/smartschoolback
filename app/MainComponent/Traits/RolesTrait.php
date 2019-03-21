<?php

namespace App\MainComponent\Traits;


/**
 * @property mixed roles
 */
trait RolesTrait
{
    protected $_roles = [
        'Родитель' => '0',
        'СтаршийРодитель' => '1'
    ];

    public function hasAllRoles($roles)
    {
        if ($this->roles == null) {
            return false;
        }

        if (!is_array($roles)) {
            $roles = [$roles];
        }

        $userRoles = explode(',', $this->roles);

        if (count($userRoles) == 0) {
            return false;
        }

        foreach ($roles as $role) {
            if (!isset($this->_roles[$role])) {
                throw new \Exception("Unknown role: $role");
            }

            if (array_search($this->_roles[$role], $userRoles) == false) {
                return false;
            }
        }

        return true;
    }

    public function hasOneRoles($roles)
    {
        if ($this->roles == null) {
            return false;
        }

        if (!is_array($roles)) {
            $roles = [$roles];
        }

        $userRoles = explode(',', $this->roles);

        if (count($userRoles) == 0) {
            return false;
        }

        foreach ($roles as $role) {
            if (!isset($this->_roles[$role])) {
                throw new \Exception("Unknown role: $role");
            }

            if (array_search($this->_roles[$role], $userRoles) != false) {
                return true;
            }
        }

        return false;
    }

    public function hasRole($role)
    {
        return $this->hasAllRoles([$role]);
    }
}
