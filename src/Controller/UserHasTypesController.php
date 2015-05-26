<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserHasTypes Controller
 *
 * @property \App\Model\Table\UserHasTypesTable $UserHasTypes
 */
class UserHasTypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Types']
        ];
        $this->set('userHasTypes', $this->paginate($this->UserHasTypes));
        $this->set('_serialize', ['userHasTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id User Has Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userHasType = $this->UserHasTypes->get($id, [
            'contain' => ['Users', 'Types']
        ]);
        $this->set('userHasType', $userHasType);
        $this->set('_serialize', ['userHasType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userHasType = $this->UserHasTypes->newEntity();
        if ($this->request->is('post')) {
            $userHasType = $this->UserHasTypes->patchEntity($userHasType, $this->request->data);
            if ($this->UserHasTypes->save($userHasType)) {
                $this->Flash->success('The user has type has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user has type could not be saved. Please, try again.');
            }
        }
        $users = $this->UserHasTypes->Users->find('list', ['limit' => 200]);
        $types = $this->UserHasTypes->Types->find('list', ['limit' => 200]);
        $this->set(compact('userHasType', 'users', 'types'));
        $this->set('_serialize', ['userHasType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Has Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userHasType = $this->UserHasTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userHasType = $this->UserHasTypes->patchEntity($userHasType, $this->request->data);
            if ($this->UserHasTypes->save($userHasType)) {
                $this->Flash->success('The user has type has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user has type could not be saved. Please, try again.');
            }
        }
        $users = $this->UserHasTypes->Users->find('list', ['limit' => 200]);
        $types = $this->UserHasTypes->Types->find('list', ['limit' => 200]);
        $this->set(compact('userHasType', 'users', 'types'));
        $this->set('_serialize', ['userHasType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Has Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userHasType = $this->UserHasTypes->get($id);
        if ($this->UserHasTypes->delete($userHasType)) {
            $this->Flash->success('The user has type has been deleted.');
        } else {
            $this->Flash->error('The user has type could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
