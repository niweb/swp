<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Classranges Controller
 *
 * @property \App\Model\Table\ClassrangesTable $Classranges
 */
class ClassrangesController extends AppController
{

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index()
	{
		$this->set('classranges', $this->paginate($this->Classranges));
		$this->set('_serialize', ['classranges']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Classrange id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$classrange = $this->Classranges->get($id, [
            'contain' => []
		]);
		$this->set('classrange', $classrange);
		$this->set('_serialize', ['classrange']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$classrange = $this->Classranges->newEntity();
		if ($this->request->is('post')) {
			$classrange = $this->Classranges->patchEntity($classrange, $this->request->data);
			if ($this->Classranges->save($classrange)) {
				$this->Flash->success('The classrange has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The classrange could not be saved. Please, try again.');
			}
		}
		$this->set(compact('classrange'));
		$this->set('_serialize', ['classrange']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Classrange id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$classrange = $this->Classranges->get($id, [
            'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$classrange = $this->Classranges->patchEntity($classrange, $this->request->data);
			if ($this->Classranges->save($classrange)) {
				$this->Flash->success('The classrange has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The classrange could not be saved. Please, try again.');
			}
		}
		$this->set(compact('classrange'));
		$this->set('_serialize', ['classrange']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Classrange id.
	 * @return void Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$classrange = $this->Classranges->get($id);
		if ($this->Classranges->delete($classrange)) {
                    $this->loadModel('PreferredClassranges');
                    $this->loadModel('StudentClassranges');
                    $this->PreferredClassranges->deleteAll(['classrange_id' => $id]);
                    $this->StudentClassranges->deleteAll(['classrange_id' => $id]);
                    
                    $this->Flash->success('The classrange has been deleted.');
		} else {
			$this->Flash->error('The classrange could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
