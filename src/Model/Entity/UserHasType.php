<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserHasType Entity.
 */
class UserHasType extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'type_id' => true,
        'user' => true,
        'type' => true,
    ];
}
