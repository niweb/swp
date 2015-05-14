<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schooltype Entity.
 */
class Schooltype extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'maximum_class' => true,
        'minimum_class' => true,
        'location_id' => true,
        'location' => true,
    ];
}
