<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PreferredSubjectsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PreferredSubjectsController Test Case
 */
class PreferredSubjectsControllerTest extends IntegrationTestCase
{

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = [
        'app.preferred_subjects',
        'app.subjects',
        'app.partners',
        'app.locations',
        'app.schooltypes',
        'app.students',
        'app.users',
        'app.preferred_classranges',
        'app.classranges',
        'app.preferred_schooltypes',
        'app.tandems'
        ];

        /**
         * Test index method
         *
         * @return void
         */
        public function testIndex()
        {
        	$this->markTestIncomplete('Not implemented yet.');
        }

        /**
         * Test view method
         *
         * @return void
         */
        public function testView()
        {
        	$this->markTestIncomplete('Not implemented yet.');
        }

        /**
         * Test add method
         *
         * @return void
         */
        public function testAdd()
        {
        	$this->markTestIncomplete('Not implemented yet.');
        }

        /**
         * Test edit method
         *
         * @return void
         */
        public function testEdit()
        {
        	$this->markTestIncomplete('Not implemented yet.');
        }

        /**
         * Test delete method
         *
         * @return void
         */
        public function testDelete()
        {
        	$this->markTestIncomplete('Not implemented yet.');
        }
}
