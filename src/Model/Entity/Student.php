<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity.
 */
class Student extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'location_id' => true,
        'vorname' => true,
        'nachname' => true,
        'telefon' => true,
        'student' => true,
        'location' => true,
    ];
}
