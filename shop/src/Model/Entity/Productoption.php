<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Productoption extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

}
