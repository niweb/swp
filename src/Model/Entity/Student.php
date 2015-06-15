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
        'first_name' => true,
        'last_name' => true,
		'sex' => true,
		'street' => true,
        'house_number' => true,
        'house_number_addition' => true,
        'postcode' => true,
        'city' => true,
        'telephone' => true,
        'mobile' => true,
        'location_id' => true,
        'location' => true,
        'tandems' => true,
        'lat'=>true,
        'lng'=>true,
	];
}
