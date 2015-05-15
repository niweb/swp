<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartnersFixture
 *
 */
class PartnersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'name' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'lastname' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'age' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'sex' => ['type' => 'string', 'length' => 30, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'degree_course' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'fixed' => null],
        'job' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'fixed' => null],
        'street' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'house_number' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'house_number_addition' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'fixed' => null],
        'postcode' => ['type' => 'string', 'length' => 5, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'telephone' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'mobile' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'fixed' => null],
        'teach_time' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'extra_time' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'spend_time' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'experience' => ['type' => 'string', 'length' => 510, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'preferred_gender' => ['type' => 'string', 'length' => 30, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'fixed' => null],
        'support_wish' => ['type' => 'string', 'length' => 510, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'fixed' => null],
        'reason_for_decision' => ['type' => 'string', 'length' => 510, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'additional_informations' => ['type' => 'string', 'length' => 510, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'fixed' => null],
        'reason_for_schuelerpaten' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'fixed' => null],
        'location_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'partners_location_id_fkey' => ['type' => 'foreign', 'columns' => ['location_id'], 'references' => ['locations', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'lastname' => 'Lorem ipsum dolor sit amet',
            'age' => 1,
            'sex' => 'Lorem ipsum dolor sit amet',
            'degree_course' => 'Lorem ipsum dolor sit amet',
            'job' => 'Lorem ipsum dolor sit amet',
            'street' => 'Lorem ipsum dolor sit amet',
            'house_number' => 'Lorem ipsum dolor sit amet',
            'house_number_addition' => 'Lorem ipsum dolor sit amet',
            'postcode' => 'Lor',
            'city' => 'Lorem ipsum dolor sit amet',
            'telephone' => 'Lorem ipsum dolor sit amet',
            'mobile' => 'Lorem ipsum dolor sit amet',
            'teach_time' => 1,
            'extra_time' => 1,
            'spend_time' => 'Lorem ipsum dolor sit amet',
            'experience' => 'Lorem ipsum dolor sit amet',
            'preferred_gender' => 'Lorem ipsum dolor sit amet',
            'support_wish' => 'Lorem ipsum dolor sit amet',
            'reason_for_decision' => 'Lorem ipsum dolor sit amet',
            'additional_informations' => 'Lorem ipsum dolor sit amet',
            'reason_for_schuelerpaten' => 'Lorem ipsum dolor sit amet',
            'location_id' => 1
        ],
    ];
}
