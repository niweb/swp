<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StudentClassranges Controller
 *
 * @property \App\Model\Table\StudentClassrangesTable $StudentClassranges
 */
class StudentClassrangesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Classranges']
        ];
        $this->set('studentClassranges', $this->paginate($this->StudentClassranges));
        $this->set('_serialize', ['studentClassranges']);
    }

    /**
     * View method
     *
     * @param string|null $id Student Classrange id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentClassrange = $this->StudentClassranges->get($id, [
            'contain' => ['Students', 'Classranges']
        ]);
        $this->set('studentClassrange', $studentClassrange);
        $this->set('_serialize', ['studentClassrange']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentClassrange = $this->StudentClassranges->newEntity();
        if ($this->request->is('post')) {
            $studentClassrange = $this->StudentClassranges->patchEntity($studentClassrange, $this->request->data);
            if ($this->StudentClassranges->save($studentClassrange)) {
                $this->Flash->success('The student classrange has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The student classrange could not be saved. Please, try again.');
            }
        }
        $students = $this->StudentClassranges->Students->find('list', ['limit' => 200]);
        $classranges = $this->StudentClassranges->Classranges->find('list', ['limit' => 200]);
        $this->set(compact('studentClassrange', 'students', 'classranges'));
        $this->set('_serialize', ['studentClassrange']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Classrange id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentClassrange = $this->StudentClassranges->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentClassrange = $this->StudentClassranges->patchEntity($studentClassrange, $this->request->data);
            if ($this->StudentClassranges->save($studentClassrange)) {
                $this->Flash->success('The student classrange has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The student classrange could not be saved. Please, try again.');
            }
        }
        $students = $this->StudentClassranges->Students->find('list', ['limit' => 200]);
        $classranges = $this->StudentClassranges->Classranges->find('list', ['limit' => 200]);
        $this->set(compact('studentClassrange', 'students', 'classranges'));
        $this->set('_serialize', ['studentClassrange']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Classrange id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentClassrange = $this->StudentClassranges->get($id);
        if ($this->StudentClassranges->delete($studentClassrange)) {
            $this->Flash->success('The student classrange has been deleted.');
        } else {
            $this->Flash->error('The student classrange could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
