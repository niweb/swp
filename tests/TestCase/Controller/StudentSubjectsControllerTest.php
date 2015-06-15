<?php
namespace App\Test\TestCase\Controller;

use App\Controller\StudentSubjectsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\StudentSubjectsController Test Case
 */
class StudentSubjectsControllerTest extends IntegrationTestCase
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
