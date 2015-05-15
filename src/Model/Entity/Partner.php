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
        'id' => true,
        'name' => true,
        'lastname' => true,
        'age' => true,
        'sex' => true,
        'degree_course' => true,
        'job' => true,
        'street' => true,
        'house_number' => true,
        'house_number_addition' => true,
        'postcode' => true,
        'city' => true,
        'telephone' => true,
        'mobile' => true,
        'teach_time' => true,
        'extra_time' => true,
        'spend_time' => true,
        'experience' => true,
        'preferred_gender' => true,
        'support_wish' => true,
        'reason_for_decision' => true,
        'additional_informations' => true,
        'reason_for_schuelerpaten' => true,
        'location_id' => true,
        'location' => true,
        'preferred_classranges' => true,
        'preferred_schooltypes' => true,
        'preferred_subjects' => true,
        'tandems' => true,
    ];
}
