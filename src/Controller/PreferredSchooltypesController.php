<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PreferredSchooltypes Controller
 *
 * @property \App\Model\Table\PreferredSchooltypesTable $PreferredSchooltypes
 */
class PreferredSchooltypesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Partners', 'Schooltypes']
        ];
        $this->set('preferredSchooltypes', $this->paginate($this->PreferredSchooltypes));
        $this->set('_serialize', ['preferredSchooltypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Preferred Schooltype id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $preferredSchooltype = $this->PreferredSchooltypes->get($id, [
            'contain' => ['Partners', 'Schooltypes']
        ]);
        $this->set('preferredSchooltype', $preferredSchooltype);
        $this->set('_serialize', ['preferredSchooltype']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $preferredSchooltype = $this->PreferredSchooltypes->newEntity();
        if ($this->request->is('post')) {
            $preferredSchooltype = $this->PreferredSchooltypes->patchEntity($preferredSchooltype, $this->request->data);
            if ($this->PreferredSchooltypes->save($preferredSchooltype)) {
                $this->Flash->success('The preferred schooltype has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The preferred schooltype could not be saved. Please, try again.');
            }
        }
        $partners = $this->PreferredSchooltypes->Partners->find('list', ['limit' => 200]);
        $schooltypes = $this->PreferredSchooltypes->Schooltypes->find('list', ['limit' => 200]);
        $this->set(compact('preferredSchooltype', 'partners', 'schooltypes'));
        $this->set('_serialize', ['preferredSchooltype']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Preferred Schooltype id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $preferredSchooltype = $this->PreferredSchooltypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $preferredSchooltype = $this->PreferredSchooltypes->patchEntity($preferredSchooltype, $this->request->data);
            if ($this->PreferredSchooltypes->save($preferredSchooltype)) {
                $this->Flash->success('The preferred schooltype has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The preferred schooltype could not be saved. Please, try again.');
            }
        }
        $partners = $this->PreferredSchooltypes->Partners->find('list', ['limit' => 200]);
        $schooltypes = $this->PreferredSchooltypes->Schooltypes->find('list', ['limit' => 200]);
        $this->set(compact('preferredSchooltype', 'partners', 'schooltypes'));
        $this->set('_serialize', ['preferredSchooltype']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Preferred Schooltype id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $preferredSchooltype = $this->PreferredSchooltypes->get($id);
        if ($this->PreferredSchooltypes->delete($preferredSchooltype)) {
            $this->Flash->success('The preferred schooltype has been deleted.');
        } else {
            $this->Flash->error('The preferred schooltype could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
