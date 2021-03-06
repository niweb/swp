<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Schooltypes Controller
 *
 * @property \App\Model\Table\SchooltypesTable $Schooltypes
 */
class SchooltypesController extends AppController
{

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index()
	{
		$this->paginate = [
            'contain' => ['Locations']
		];
		$this->set('schooltypes', $this->paginate($this->Schooltypes));
		$this->set('_serialize', ['schooltypes']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Schooltype id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$schooltype = $this->Schooltypes->get($id, [
            'contain' => ['Locations']
		]);
		$this->set('schooltype', $schooltype);
		$this->set('_serialize', ['schooltype']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$schooltype = $this->Schooltypes->newEntity();
		if ($this->request->is('post')) {
			$schooltype = $this->Schooltypes->patchEntity($schooltype, $this->request->data);
			if ($this->Schooltypes->save($schooltype)) {
				$this->Flash->success('The schooltype has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The schooltype could not be saved. Please, try again.');
			}
		}
		$locations = $this->Schooltypes->Locations->find('list', ['limit' => 200]);
		$this->set(compact('schooltype', 'locations'));
		$this->set('_serialize', ['schooltype']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Schooltype id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$schooltype = $this->Schooltypes->get($id, [
            'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$schooltype = $this->Schooltypes->patchEntity($schooltype, $this->request->data);
			if ($this->Schooltypes->save($schooltype)) {
				$this->Flash->success('The schooltype has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The schooltype could not be saved. Please, try again.');
			}
		}
		$locations = $this->Schooltypes->Locations->find('list', ['limit' => 200]);
		$this->set(compact('schooltype', 'locations'));
		$this->set('_serialize', ['schooltype']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Schooltype id.
	 * @return void Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$schooltype = $this->Schooltypes->get($id);
		if ($this->Schooltypes->delete($schooltype)) {
			$this->Flash->success('The schooltype has been deleted.');
		} else {
			$this->Flash->error('The schooltype could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
