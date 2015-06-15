<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentClassrange Entity.
 */
class StudentClassrange extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'student_id' => true,
        'classrange_id' => true,
        'student' => true,
        'classrange' => true,
    ];
}
