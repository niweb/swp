<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreferredClassrangesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PreferredClassrangesTable Test Case
 */
class PreferredClassrangesTableTest extends TestCase
{

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = [
        'app.preferred_classranges',
        'app.partners',
        'app.locations',
        'app.schooltypes',
        'app.students',
        'app.subjects',
        'app.users',
        'app.preferred_schooltypes',
        'app.preferred_subjects',
        'app.tandems',
        'app.classranges'
        ];

        /**
         * setUp method
         *
         * @return void
         */
        public function setUp()
        {
        	parent::setUp();
        	$config = TableRegistry::exists('PreferredClassranges') ? [] : ['className' => 'App\Model\Table\PreferredClassrangesTable'];
        	$this->PreferredClassranges = TableRegistry::get('PreferredClassranges', $config);
        }

        /**
         * tearDown method
         *
         * @return void
         */
        public function tearDown()
        {
        	unset($this->PreferredClassranges);

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
