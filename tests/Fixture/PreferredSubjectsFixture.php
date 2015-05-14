<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PreferredSubjectsFixture
 *
 */
class PreferredSubjectsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'subject_id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'partner_id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'not_an_option' => ['type' => 'boolean', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'maximum_class' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'preferred_subjects_subject_id_fkey' => ['type' => 'foreign', 'columns' => ['subject_id'], 'references' => ['subjects', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'preferred_subjects_partner_id_fkey' => ['type' => 'foreign', 'columns' => ['partner_id'], 'references' => ['partners', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'subject_id' => 1,
            'partner_id' => 1,
            'not_an_option' => 1,
            'maximum_class' => 1
        ],
    ];
}
