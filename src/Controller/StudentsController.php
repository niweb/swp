<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 */
class StudentsController extends AppController
{

	public function isAuthorized($user){
		if(in_array($this->request->action, ['index', 'add'])){
			$this->loadModel('UserHasTypes');
			$type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
			if($type > '1' && $type < '4'){
					return true;
			}
		}
		if(in_array($this->request->action, ['edit', 'view', 'delete'])){
			$this->loadModel('UserHasTypes');
			$type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
			if($type > '1' && $type < '4'){
				$studentID = (int)$this->request->params['pass'][0];
				$studentLocation = $this->Students->get($studentID)->location_id;
				if($user['location_id'] == $studentLocation){
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
		$this->loadModel('UserHasTypes');
        $user = $this->Auth->user();
        $type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
	
		if($type < '5'){
			$this->paginate = [
            'contain' => ['Locations', 'StudentStatus']
			];
			$students = $this->Students->findByLocationId($user['location_id']);
			$this->set('students', $this->paginate($students));
			$this->set('_serialize', ['students']);
		} else {
			$this->paginate = [
				'contain' => ['Locations']
			];
			$this->set('students', $this->paginate($this->Students));
			$this->set('_serialize', ['students']);
		}
	}

	/**
	 * View method
	 *
	 * @param string|null $id Student id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$student = $this->Students->get($id, [
            'contain' => ['Tandems.Partners.Users', 'StudentStatus']
		]);
		$this->loadModel('StudentSubjects');
		$this->loadModel('StudentClassranges');
		$this->loadModel('Classranges');
		$this->loadModel('Subjects');
		$subject = $this->StudentSubjects->findByStudentId($id)->contain('Subjects')->first();
		$subject1 = $this->Subjects->get($subject['subject1']);
		$subject2 = $this->Subjects->get($subject['subject2']);
		$subject3 = $this->Subjects->get($subject['subject3']);
		$classrange = $this->StudentClassranges->findByStudentId($id)->contain('Classranges')->first();
		$this->set(compact('student', 'subject1', 'subject2', 'subject3', 'classrange'));
		$this->set('_serialize', ['student', 'subject1', 'subject2', 'subject3', 'classrange']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$student = $this->Students->newEntity();
		$user = $this->Auth->user();
		$this->loadModel('StudentSubjects');
		$this->loadModel('StudentClassranges');
		if ($this->request->is('post')) {
			$student = $this->Students->patchEntity($student, $this->request->data);
			$student->location_id = $user['location_id'];
			if ($this->Students->save($student)) {
				$subject1 = $this->request->data('subject1');
				$subject2 = $this->request->data('subject2');
				$subject3 = $this->request->data('subject3');
				/*if($subject1 == $subject2) {
					$this->Students->invalidate('subject2', "Fächer müssen unterschiedlich sein");
					return;
				} 
				if($subject1 == $subject3 || $subject2 == $subject3){
					$this->Students->invalidate('subject3', "Fächer müssen unterschiedlich sein");
					return;
				}*/
				$classrange = $this->StudentClassranges->newEntity();
				$classrange->student_id = $student->id;
				$classrange->classrange_id = $this->request->data('classranges');
				
				$subject = $this->StudentSubjects->newEntity();
				$subject->student_id = $student->id;
				$subject->subject1 = $subject1;
				$subject->subject2 = $subject2;
				$subject->subject3 = $subject3;
				
				if($this->StudentClassranges->save($classrange) && $this->StudentSubjects->save($subject)){
					$this->Flash->success('The student has been saved.');
					return $this->redirect(['action' => 'index']);
				} else {
					$this->Student->delete($student);
					$this->Flash->error('The student could not be saved. Please, try again.');
				}
			} else {
				$this->Flash->error('The student could not be saved. Please, try again.');
			}
		}
		$this->loadModel('Subjects');
		$this->loadModel('Classranges');
		$subjects = $this->Subjects->find('list');
		$classranges = $this->Classranges->find('list');
		$this->set(compact('student', 'subjects', 'classranges'));
		//$this->set('student', $student);
		$this->set('_serialize', ['student', 'subjects', 'classranges']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Student id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$student = $this->Students->get($id, [
            'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$student = $this->Students->patchEntity($student, $this->request->data);
			if ($this->Students->save($student)) {
				$this->Flash->success('The student has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The student could not be saved. Please, try again.');
			}
		}
		$this->loadModel('StudentStatus');
		$this->loadModel('Subjects');
		$this->loadModel('Classranges');
		$status = $this->StudentStatus->find('list');
		$subjects = $this->Subjects->find('list');
		$classranges = $this->Classranges->find('list');
		$this->set(compact('student', 'status', 'subjects', 'classranges'));
		$this->set('_serialize', ['student', 'status', 'subjects', 'classranges']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Student id.
	 * @return void Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$this->loadModel('StudentSubjects');
		$this->loadModel('StudentClassranges');
		$student = $this->Students->get($id);
		$subject = $this->StudentSubjects->findByStudentId($student->id)->first();
		$classrange = $this->StudentClassranges->findByStudentId($student->id)->first();
		if($this->StudentSubjects->delete($subject) && $this->StudentClassranges->delete($classrange)){
			if ($this->Students->delete($student)) {
				$this->Flash->success('The student has been deleted.');
			} else {
				$this->Flash->error('The student could not be deleted. Please, try again.');
			}
		} else {
			$this->Flash->error('The student could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
