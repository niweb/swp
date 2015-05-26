<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserHasTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserHasTypesTable Test Case
 */
class UserHasTypesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_has_types',
        'app.users',
        'app.locations',
        'app.partners',
        'app.statuses',
        'app.preferred_classranges',
        'app.classranges',
        'app.preferred_schooltypes',
        'app.schooltypes',
        'app.preferred_subjects',
        'app.subjects',
        'app.tandems',
        'app.students',
        'app.types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserHasTypes') ? [] : ['className' => 'App\Model\Table\UserHasTypesTable'];
        $this->UserHasTypes = TableRegistry::get('UserHasTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserHasTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
