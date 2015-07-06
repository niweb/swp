<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StatusHistory Entity.
 */
class StatusHistory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'partner_id' => true,
        'status_id' => true,
		'text' => true,
        'timestamp' => true,
        'partner' => true,
        'status' => true,
    ];
}
