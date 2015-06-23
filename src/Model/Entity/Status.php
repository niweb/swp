<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Status Entity.
 */
class Status extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'text' => true,
    ];
}
