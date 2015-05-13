<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Types Controller
 *
 * @property \App\Model\Table\TypesTable $Types
 */
class TypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Types']
        ];
        $this->set('types', $this->paginate($this->Types));
        $this->set('_serialize', ['types']);
    }

    /**
     * View method
     *
     * @param string|null $id Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $type = $this->Types->get($id, [
            'contain' => ['Types']
        ]);
        $this->set('type', $type);
        $this->set('_serialize', ['type']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $type = $this->Types->newEntity();
        if ($this->request->is('post')) {
            $type = $this->Types->patchEntity($type, $this->request->data);
            if ($this->Types->save($type)) {
                $this->Flash->success('The type has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The type could not be saved. Please, try again.');
            }
        }
        $types = $this->Types->Types->find('list', ['limit' => 200]);
        $this->set(compact('type', 'types'));
        $this->set('_serialize', ['type']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $type = $this->Types->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $type = $this->Types->patchEntity($type, $this->request->data);
            if ($this->Types->save($type)) {
                $this->Flash->success('The type has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The type could not be saved. Please, try again.');
            }
        }
        $types = $this->Types->Types->find('list', ['limit' => 200]);
        $this->set(compact('type', 'types'));
        $this->set('_serialize', ['type']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $type = $this->Types->get($id);
        if ($this->Types->delete($type)) {
            $this->Flash->success('The type has been deleted.');
        } else {
            $this->Flash->error('The type could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
