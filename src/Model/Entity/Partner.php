<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Partner Entity.
 */
class Partner extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'student_id' => true,
        'vorname' => true,
        'nachname' => true,
        'telefon' => true,
        'partner' => true,
        'user' => true,
        'student' => true,
    ];
}
