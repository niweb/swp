<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StudentSubject Entity.
 */
class StudentSubject extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'student_id' => true,
        'subject1' => true,
		'subject2' => true,
		'subject3' => true,
        'student' => true,
        'subject' => true,
    ];
}
