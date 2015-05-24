<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Location Entity.
 */
class Location extends Entity
{

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
        'name' => true,
        'partners' => true,
        'schooltypes' => true,
        'students' => true,
        'subjects' => true,
        'users' => true,
	];
}
