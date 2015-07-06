<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Subjects Controller
 *
 * @property \App\Model\Table\SubjectsTable $Subjects
 */
class SubjectsController extends AppController
{

	public function isAuthorized($user){
		$type = $user['type_id'];
		if(in_array($this->request->action, ['index', 'add'])){
			if($type > '3') {
				return true;
			}
		}
		
		if(in_array($this->request->action, ['view', 'edit', 'delete'])) {
			if($type > '3'){
				$subjectID = (int)$this->request->params['pass'][0];
				$subject = $this->Subjects->get($subjectID);
				if($subject['location_id'] == $user['location_id']){
					return true;
				}
			}
		}
		
		return parent::isAuthorized($user);
	}

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
		$this->set('subjects', $this->paginate($this->Subjects));
		$this->set('_serialize', ['subjects']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Subject id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$subject = $this->Subjects->get($id, [
            'contain' => ['Locations']
		]);
		$this->set('subject', $subject);
		$this->set('_serialize', ['subject']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$subject = $this->Subjects->newEntity();
		if ($this->request->is('post')) {
			$subject = $this->Subjects->patchEntity($subject, $this->request->data);
			$subject->location_id = $this->Auth->user('location_id');
			if ($this->Subjects->save($subject)) {
				$this->Flash->success('The subject has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The subject could not be saved. Please, try again.');
			}
		}
		$this->set(compact('subject'));
		$this->set('_serialize', ['subject']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Subject id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$subject = $this->Subjects->get($id, [
            'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$subject = $this->Subjects->patchEntity($subject, $this->request->data);
			if ($this->Subjects->save($subject)) {
				$this->Flash->success('The subject has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The subject could not be saved. Please, try again.');
			}
		}
		$this->set(compact('subject'));
		$this->set('_serialize', ['subject']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Subject id.
	 * @return void Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$subject = $this->Subjects->get($id);
		if ($this->Subjects->delete($subject)) {
                    $this->loadModel('PreferredSubjects');
                    $this->loadModel('StudentSubjects');
                    $this->PreferredSubjects->deleteAll(['subject_id' => $id]);
                    $this->StudentSubjects->deleteAll(['subject_id' => $id]);
                    
                    $this->Flash->success('The subject has been deleted.');
		} else {
			$this->Flash->error('The subject could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
