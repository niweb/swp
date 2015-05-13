<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Partners Controller
 *
 * @property \App\Model\Table\PartnersTable $Partners
 */
class PartnersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Partners', 'Users', 'Students']
        ];
        $this->set('partners', $this->paginate($this->Partners));
        $this->set('_serialize', ['partners']);
    }

    /**
     * View method
     *
     * @param string|null $id Partner id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $partner = $this->Partners->get($id, [
            'contain' => ['Partners', 'Users', 'Students']
        ]);
        $this->set('partner', $partner);
        $this->set('_serialize', ['partner']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $partner = $this->Partners->newEntity();
        if ($this->request->is('post')) {
            $partner = $this->Partners->patchEntity($partner, $this->request->data);
            if ($this->Partners->save($partner)) {
                $this->Flash->success('The partner has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The partner could not be saved. Please, try again.');
            }
        }
        $partners = $this->Partners->Partners->find('list', ['limit' => 200]);
        $users = $this->Partners->Users->find('list', ['limit' => 200]);
        $students = $this->Partners->Students->find('list', ['limit' => 200]);
        $this->set(compact('partner', 'partners', 'users', 'students'));
        $this->set('_serialize', ['partner']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Partner id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $partner = $this->Partners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $partner = $this->Partners->patchEntity($partner, $this->request->data);
            if ($this->Partners->save($partner)) {
                $this->Flash->success('The partner has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The partner could not be saved. Please, try again.');
            }
        }
        $partners = $this->Partners->Partners->find('list', ['limit' => 200]);
        $users = $this->Partners->Users->find('list', ['limit' => 200]);
        $students = $this->Partners->Students->find('list', ['limit' => 200]);
        $this->set(compact('partner', 'partners', 'users', 'students'));
        $this->set('_serialize', ['partner']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Partner id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $partner = $this->Partners->get($id);
        if ($this->Partners->delete($partner)) {
            $this->Flash->success('The partner has been deleted.');
        } else {
            $this->Flash->error('The partner could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
