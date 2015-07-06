<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatusHistorysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatusHistorysTable Test Case
 */
class StatusHistorysTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.status_historys',
        'app.partners',
        'app.users',
        'app.locations',
        'app.schooltypes',
        'app.students',
        'app.tandems',
        'app.student_status',
        'app.student_subjects',
        'app.subjects',
        'app.student_classranges',
        'app.classranges',
        'app.types',
        'app.status',
        'app.preferred_classranges',
        'app.preferred_schooltypes',
        'app.preferred_subjects',
        'app.statuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StatusHistorys') ? [] : ['className' => 'App\Model\Table\StatusHistorysTable'];
        $this->StatusHistorys = TableRegistry::get('StatusHistorys', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StatusHistorys);

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
