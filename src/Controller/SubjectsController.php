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
            $subjects = $this->Subjects->find('all', ['conditions' => ['location_id' => $this->Auth->user('location_id')]]);
            
		$this->set('subjects', $this->paginate($subjects));
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
				$this->Flash->success(__('The subject has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The subject could not be saved. Please, try again.'));
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
				$this->Flash->success(__('The subject has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The subject could not be saved. Please, try again.'));
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
                    $studentSubjects = $this->StudentSubjects->find('all')->where(['OR' => ['subject1 =' => $id, 'subject2 =' => $id, 'subject3 =' => $id]]);
                    foreach($studentSubjects as $studentSubject){
                        if($studentSubject->subject1 == $id){
                            $studentSubject->subject1 = NULL;
                        }
                        if($studentSubject->subject2 == $id){
                            $studentSubject->subject2 = NULL;
                        }
                        if($studentSubject->subject3 == $id){
                            $studentSubject->subject3 = NULL;
                        }
                        $this->StudentSubjects->save($studentSubject);
                    }
                    
                    /*$delSubj[1] = $this->StudentSubjects->find('all')->where(['subject1 =' => $id]);
                    $delSubj[2] = $this->StudentSubjects->find('all')->where(['subject2 =' => $id]);
                    $delSubj[3] = $this->StudentSubjects->find('all')->where(['subject3 =' => $id]);
                    foreach($delSubj as $key => $studentSubjects){
                        foreach($studentSubjects as $studentSubject){
                            switch($key){
                                case(1): $studentSubject->subject1 = NULL; break;
                                case(2): $studentSubject->subject2 = NULL; break;
                                case(3): $studentSubject->subject3 = NULL; break;
                            }
                            $this->StudentSubjects->save($studentSubject);
                        }
                    }*/
                    
                    $this->Flash->success(__('The subject has been deleted.'));
		} else {
			$this->Flash->error(__('The subject could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}
}
