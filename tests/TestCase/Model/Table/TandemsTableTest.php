<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TandemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TandemsTable Test Case
 */
class TandemsTableTest extends TestCase
{

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = [
        'app.tandems',
        'app.partners',
        'app.locations',
        'app.schooltypes',
        'app.students',
        'app.subjects',
        'app.users',
        'app.preferred_classranges',
        'app.classranges',
        'app.preferred_schooltypes',
        'app.preferred_subjects'
        ];

        /**
         * setUp method
         *
         * @return void
         */
        public function setUp()
        {
        	parent::setUp();
        	$config = TableRegistry::exists('Tandems') ? [] : ['className' => 'App\Model\Table\TandemsTable'];
        	$this->Tandems = TableRegistry::get('Tandems', $config);
        }

        /**
         * tearDown method
         *
         * @return void
         */
        public function tearDown()
        {
        	unset($this->Tandems);

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
