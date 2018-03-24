<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class User extends Entity
{

////////////////////////////////////////////////////////////////////////////////

    protected $_accessible = [
        'role' => true,
        'first_name' => true,
        'last_name' => true,
        'phone' => true,
        'email' => true,
        'password' => true,
        'uuid' => true,
        'active' => true,
        'login_count' => true,
        'login_last' => true,
    ];

////////////////////////////////////////////////////////////////////////////////

    protected function _getName()
    {
        return $this->_properties['first_name'] . '  ' . $this->_properties['last_name'];
    }

////////////////////////////////////////////////////////////////////////////////

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }

////////////////////////////////////////////////////////////////////////////////

}
