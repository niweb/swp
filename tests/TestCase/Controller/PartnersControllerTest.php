<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PartnersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PartnersController Test Case
 */
class PartnersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.partners',
        'app.users',
        'app.locations',
        'app.schooltypes',
        'app.students',
        'app.tandems',
        'app.subjects',
        'app.user_has_types',
        'app.preferred_classranges',
        'app.classranges',
        'app.preferred_schooltypes',
        'app.preferred_subjects'
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
