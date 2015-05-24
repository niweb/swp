<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClassrangesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClassrangesTable Test Case
 */
class ClassrangesTableTest extends TestCase
{

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = [
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
        	$config = TableRegistry::exists('Classranges') ? [] : ['className' => 'App\Model\Table\ClassrangesTable'];
        	$this->Classranges = TableRegistry::get('Classranges', $config);
        }

        /**
         * tearDown method
         *
         * @return void
         */
        public function tearDown()
        {
        	unset($this->Classranges);

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
}
