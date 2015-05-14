<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PreferredClassrangesFixture
 *
 */
class PreferredClassrangesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'partner_id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'classrange_id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'preferred_classranges_partner_id_fkey' => ['type' => 'foreign', 'columns' => ['partner_id'], 'references' => ['partners', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'preferred_classranges_classrange_id_fkey' => ['type' => 'foreign', 'columns' => ['classrange_id'], 'references' => ['classranges', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'partner_id' => 1,
            'classrange_id' => 1
        ],
    ];
}
