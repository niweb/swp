<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StudentSubjects Controller
 *
 * @property \App\Model\Table\StudentSubjectsTable $StudentSubjects
 */
class StudentSubjectsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Subjects']
        ];
        $this->set('studentSubjects', $this->paginate($this->StudentSubjects));
        $this->set('_serialize', ['studentSubjects']);
    }

    /**
     * View method
     *
     * @param string|null $id Student Subject id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentSubject = $this->StudentSubjects->get($id, [
            'contain' => ['Students', 'Subjects']
        ]);
        $this->set('studentSubject', $studentSubject);
        $this->set('_serialize', ['studentSubject']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentSubject = $this->StudentSubjects->newEntity();
        if ($this->request->is('post')) {
            $studentSubject = $this->StudentSubjects->patchEntity($studentSubject, $this->request->data);
            if ($this->StudentSubjects->save($studentSubject)) {
                $this->Flash->success('The student subject has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The student subject could not be saved. Please, try again.');
            }
        }
        $students = $this->StudentSubjects->Students->find('list', ['limit' => 200]);
        $subjects = $this->StudentSubjects->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('studentSubject', 'students', 'subjects'));
        $this->set('_serialize', ['studentSubject']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Subject id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentSubject = $this->StudentSubjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentSubject = $this->StudentSubjects->patchEntity($studentSubject, $this->request->data);
            if ($this->StudentSubjects->save($studentSubject)) {
                $this->Flash->success('The student subject has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The student subject could not be saved. Please, try again.');
            }
        }
        $students = $this->StudentSubjects->Students->find('list', ['limit' => 200]);
        $subjects = $this->StudentSubjects->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('studentSubject', 'students', 'subjects'));
        $this->set('_serialize', ['studentSubject']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Subject id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentSubject = $this->StudentSubjects->get($id);
        if ($this->StudentSubjects->delete($studentSubject)) {
            $this->Flash->success('The student subject has been deleted.');
        } else {
            $this->Flash->error('The student subject could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
