<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentClassrangesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentClassrangesTable Test Case
 */
class StudentClassrangesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_classranges',
        'app.students',
        'app.locations',
        'app.partners',
        'app.users',
        'app.status',
        'app.preferred_classranges',
        'app.classranges',
        'app.preferred_schooltypes',
        'app.schooltypes',
        'app.preferred_subjects',
        'app.subjects',
        'app.tandems'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentClassranges') ? [] : ['className' => 'App\Model\Table\StudentClassrangesTable'];
        $this->StudentClassranges = TableRegistry::get('StudentClassranges', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentClassranges);

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
