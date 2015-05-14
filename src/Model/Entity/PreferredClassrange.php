<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PreferredClassrange Entity.
 */
class PreferredClassrange extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'partner_id' => true,
        'classrange_id' => true,
        'partner' => true,
        'classrange' => true,
    ];
}
