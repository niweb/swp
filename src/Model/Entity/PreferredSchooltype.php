<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PreferredSchooltype Entity.
 */
class PreferredSchooltype extends Entity
{

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
        'partner_id' => true,
        'schooltype_id' => true,
        'partner' => true,
        'schooltype' => true,
	];
}
