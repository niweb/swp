<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StudentStatus Controller
 *
 * @property \App\Model\Table\StudentStatusTable $StudentStatus
 */
class StudentStatusController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('studentStatus', $this->paginate($this->StudentStatus));
        $this->set('_serialize', ['studentStatus']);
    }

    /**
     * View method
     *
     * @param string|null $id Student Status id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentStatus = $this->StudentStatus->get($id, [
            'contain' => []
        ]);
        $this->set('studentStatus', $studentStatus);
        $this->set('_serialize', ['studentStatus']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentStatus = $this->StudentStatus->newEntity();
        if ($this->request->is('post')) {
            $studentStatus = $this->StudentStatus->patchEntity($studentStatus, $this->request->data);
            if ($this->StudentStatus->save($studentStatus)) {
                $this->Flash->success('The student status has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The student status could not be saved. Please, try again.');
            }
        }
        $this->set(compact('studentStatus'));
        $this->set('_serialize', ['studentStatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Status id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentStatus = $this->StudentStatus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentStatus = $this->StudentStatus->patchEntity($studentStatus, $this->request->data);
            if ($this->StudentStatus->save($studentStatus)) {
                $this->Flash->success('The student status has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The student status could not be saved. Please, try again.');
            }
        }
        $this->set(compact('studentStatus'));
        $this->set('_serialize', ['studentStatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Status id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentStatus = $this->StudentStatus->get($id);
        if ($this->StudentStatus->delete($studentStatus)) {
            $this->Flash->success('The student status has been deleted.');
        } else {
            $this->Flash->error('The student status could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
