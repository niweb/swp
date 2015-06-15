<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentSubjectsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentSubjectsTable Test Case
 */
class StudentSubjectsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_subjects',
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
        $config = TableRegistry::exists('StudentSubjects') ? [] : ['className' => 'App\Model\Table\StudentSubjectsTable'];
        $this->StudentSubjects = TableRegistry::get('StudentSubjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentSubjects);

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
