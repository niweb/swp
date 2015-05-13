<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'location_id' => true,
        'type' => true,
        'mail' => true,
        'password' => true,
        'user' => true,
        'location' => true,
    ];
}
