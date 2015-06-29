<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatusTextsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatusTextsTable Test Case
 */
class StatusTextsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.status_texts',
        'app.locations',
        'app.partners',
        'app.users',
        'app.types',
        'app.status',
        'app.preferred_classranges',
        'app.classranges',
        'app.preferred_schooltypes',
        'app.schooltypes',
        'app.preferred_subjects',
        'app.subjects',
        'app.tandems',
        'app.students',
        'app.student_status',
        'app.student_subjects',
        'app.student_classranges',
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
        $config = TableRegistry::exists('StatusTexts') ? [] : ['className' => 'App\Model\Table\StatusTextsTable'];
        $this->StatusTexts = TableRegistry::get('StatusTexts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StatusTexts);

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
