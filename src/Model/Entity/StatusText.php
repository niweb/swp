<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StatusText Entity.
 */
class StatusText extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'location_id' => true,
        'status_id' => true,
        'text' => true,
        'location' => true,
        'status' => true,
    ];
}
