<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tandem Entity.
 */
class Tandem extends Entity
{

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
        'partner_id' => true,
        'student_id' => true,
        'active' => true,
        'partner' => true,
        'student' => true,
	];
}
