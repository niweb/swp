<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PreferredSubject Entity.
 */
class PreferredSubject extends Entity
{

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * @var array
	 */
	protected $_accessible = [
        'subject_id' => true,
        'partner_id' => true,
        'maximum_class' => true,
        'subject' => true,
        'partner' => true,
	];
}
