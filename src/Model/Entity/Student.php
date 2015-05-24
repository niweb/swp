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
        'name' => true,
        'lastname' => true,
        'telephone' => true,
        'mobile' => true,
        'location_id' => true,
        'location' => true,
        'tandems' => true,
	];
}
