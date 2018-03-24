<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Orderproduct extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

}
