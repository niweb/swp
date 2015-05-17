<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreferredSchooltypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PreferredSchooltypesTable Test Case
 */
class PreferredSchooltypesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.preferred_schooltypes',
        'app.partners',
        'app.locations',
        'app.schooltypes',
        'app.students',
        'app.subjects',
        'app.users',
        'app.preferred_classranges',
        'app.classranges',
        'app.preferred_subjects',
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
        $config = TableRegistry::exists('PreferredSchooltypes') ? [] : ['className' => 'App\Model\Table\PreferredSchooltypesTable'];
        $this->PreferredSchooltypes = TableRegistry::get('PreferredSchooltypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PreferredSchooltypes);

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
