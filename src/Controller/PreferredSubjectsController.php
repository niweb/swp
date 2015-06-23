<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PreferredSubjects Controller
 *
 * @property \App\Model\Table\PreferredSubjectsTable $PreferredSubjects
 */
class PreferredSubjectsController extends AppController
{

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index()
	{
		$this->paginate = [
            'contain' => ['Subjects', 'Partners']
		];
		$this->set('preferredSubjects', $this->paginate($this->PreferredSubjects));
		$this->set('_serialize', ['preferredSubjects']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Preferred Subject id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$preferredSubject = $this->PreferredSubjects->get($id, [
            'contain' => ['Subjects', 'Partners']
		]);
		$this->set('preferredSubject', $preferredSubject);
		$this->set('_serialize', ['preferredSubject']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$preferredSubject = $this->PreferredSubjects->newEntity();
		if ($this->request->is('post')) {
			$preferredSubject = $this->PreferredSubjects->patchEntity($preferredSubject, $this->request->data);
			if ($this->PreferredSubjects->save($preferredSubject)) {
				$this->Flash->success('The preferred subject has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The preferred subject could not be saved. Please, try again.');
			}
		}
		$subjects = $this->PreferredSubjects->Subjects->find('list', ['limit' => 200]);
		$partners = $this->PreferredSubjects->Partners->find('list', ['limit' => 200]);
		$this->set(compact('preferredSubject', 'subjects', 'partners'));
		$this->set('_serialize', ['preferredSubject']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Preferred Subject id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null, $partner_id = null)
	{
		$preferredSubject = $this->PreferredSubjects->get($id, [
            'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$preferredSubject = $this->PreferredSubjects->patchEntity($preferredSubject, $this->request->data);
			$preferredSubject->partner_id = $partner_id;
			if ($this->PreferredSubjects->save($preferredSubject)) {
				$this->Flash->success('The preferred subject has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The preferred subject could not be saved. Please, try again.');
			}
		}
		$subjects = $this->PreferredSubjects->Subjects->find('list', ['limit' => 200]);
		$partners = $this->PreferredSubjects->Partners->find('list', ['limit' => 200]);
		$this->set(compact('preferredSubject', 'subjects', 'partners'));
		$this->set('_serialize', ['preferredSubject']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Preferred Subject id.
	 * @return void Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$preferredSubject = $this->PreferredSubjects->get($id);
		if ($this->PreferredSubjects->delete($preferredSubject)) {
			$this->Flash->success('The preferred subject has been deleted.');
		} else {
			$this->Flash->error('The preferred subject could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
