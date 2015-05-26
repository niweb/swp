<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartnersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartnersTable Test Case
 */
class PartnersTableTest extends TestCase
{

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = [
        'app.partners',
        'app.locations',
        'app.schooltypes',
        'app.students',
        'app.subjects',
        'app.users',
        'app.preferred_classranges',
        'app.preferred_schooltypes',
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
        	$config = TableRegistry::exists('Partners') ? [] : ['className' => 'App\Model\Table\PartnersTable'];
        	$this->Partners = TableRegistry::get('Partners', $config);
        }

        /**
         * tearDown method
         *
         * @return void
         */
        public function tearDown()
        {
        	unset($this->Partners);

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
