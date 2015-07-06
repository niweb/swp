<?php
namespace App\Test\TestCase\Controller;

use App\Controller\StatusHistorysController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\StatusHistorysController Test Case
 */
class StatusHistorysControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.status_historys',
        'app.partners',
        'app.users',
        'app.locations',
        'app.schooltypes',
        'app.students',
        'app.tandems',
        'app.student_status',
        'app.student_subjects',
        'app.subjects',
        'app.student_classranges',
        'app.classranges',
        'app.types',
        'app.status',
        'app.preferred_classranges',
        'app.preferred_schooltypes',
        'app.preferred_subjects',
        'app.statuses'
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
