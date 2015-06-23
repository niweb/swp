<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PreferredClassranges Controller
 *
 * @property \App\Model\Table\PreferredClassrangesTable $PreferredClassranges
 */
class PreferredClassrangesController extends AppController
{

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index()
	{
		$this->paginate = [
            'contain' => ['Partners', 'Classranges']
		];
		$this->set('preferredClassranges', $this->paginate($this->PreferredClassranges));
		$this->set('_serialize', ['preferredClassranges']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Preferred Classrange id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$preferredClassrange = $this->PreferredClassranges->get($id, [
            'contain' => ['Partners', 'Classranges']
		]);
		$this->set('preferredClassrange', $preferredClassrange);
		$this->set('_serialize', ['preferredClassrange']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$preferredClassrange = $this->PreferredClassranges->newEntity();
		if ($this->request->is('post')) {
			$preferredClassrange = $this->PreferredClassranges->patchEntity($preferredClassrange, $this->request->data);
			if ($this->PreferredClassranges->save($preferredClassrange)) {
				$this->Flash->success('The preferred classrange has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The preferred classrange could not be saved. Please, try again.');
			}
		}
		$partners = $this->PreferredClassranges->Partners->find('list', ['limit' => 200]);
		$classranges = $this->PreferredClassranges->Classranges->find('list', ['limit' => 200]);
		$this->set(compact('preferredClassrange', 'partners', 'classranges'));
		$this->set('_serialize', ['preferredClassrange']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Preferred Classrange id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null, $partner_id = null)
	{
		$preferredClassrange = $this->PreferredClassranges->get($id, [
            'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$preferredClassrange = $this->PreferredClassranges->patchEntity($preferredClassrange, $this->request->data);
			$preferredClassrange->partner_id = $partner_id;
			if ($this->PreferredClassranges->save($preferredClassrange)) {
				$this->Flash->success('The preferred classrange has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The preferred classrange could not be saved. Please, try again.');
			}
		}
		$partners = $this->PreferredClassranges->Partners->find('list', ['limit' => 200]);
		$classranges = $this->PreferredClassranges->Classranges->find('list', ['limit' => 200]);
		$this->set(compact('preferredClassrange', 'partners', 'classranges'));
		$this->set('_serialize', ['preferredClassrange']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Preferred Classrange id.
	 * @return void Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$preferredClassrange = $this->PreferredClassranges->get($id);
		if ($this->PreferredClassranges->delete($preferredClassrange)) {
			$this->Flash->success('The preferred classrange has been deleted.');
		} else {
			$this->Flash->error('The preferred classrange could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
