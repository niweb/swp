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
                    $type = $user['type_id'];
                    if($type > '1'){
                        return true;
                    }
		}
		if(in_array($this->request->action, ['edit', 'view'])){
                    $type = $user['type_id'];
                    if ($type == '5'){
                        return true;
                    }
                    elseif($type > '1'){
                        $studentID = (int)$this->request->params['pass'][0];
                        $studentLocation = $this->Students->get($studentID)->location_id;
                        if($user['location_id'] == $studentLocation){
                            return true;
                        }
                    }
		}
                if(in_array($this->request->action, ['delete', 'deactivate', 'reactivate', 'status'])){
                    $type = $user['type_id'];
                    if ($type == '5'){
                        return true;
                    }
                    if($type > '2'){
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
	public function index($view = null)
	{
        $user = $this->Auth->user();
        $type = $user['type_id'];
		
		switch($view){
                    case 'all':
                        $condition = [];
                        break;
                    case 'waiting': 
                        $condition = ['student_status_id =' => 1];
                        break;
                    case 'active': 
                        $condition = ['student_status_id <' => 3];
                        break;
                    case 'deactive':
                        $condition = ['student_status_id =' => 3];
                        break;
                    default:
                        if($type < 3):  $condition = ['student_status_id =' => 1];
                        else:           $condition = ['student_status_id <' => 3];
                        endif; break;
		}
		
		if ($this->request->is('post')) {
			$search = $this->request->data('search');
			$field = $this->request->data('field');

			switch($field){
				case 0: 
					$column = 'first_name';
					break;
				case 1:
					$column = 'last_name';
					break;
				case 2:
					$column = 'sex';
					if($search == 'männlich' || $search == 'mann'){ $search = 'm'; }
					if($search == 'weiblich' || $search == 'w' || $search == 'frau'){ $search = 'f'; }
					break;
				case 3:
					$column = 'street';
					break;
				case 4:
					$column = 'postcode';
					break;
				case 5:
					$column = 'city';
					break;
				case 6:
					$column = 'student_status_id';
					if($search == 'wartend'){ $search = '1'; }
					if($search == 'vermittelt'){ $search = '2'; }
					if($search == 'aufgehört'){ $search = '3'; }
					break;
			}
			
			if($search != ''){
				$condition[$column] = $search;
			}
        }
	
		if($type < '5'){
				$this->paginate = [
					'contain' => ['Locations', 'StudentStatus']
				];
				$condition['location_id'] = $user['location_id'];
				$students = $this->Students->find('all', ['conditions' => $condition, 'contain' => ['Locations', 'StudentStatus']]);
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
                    'contain' => ['Tandems.Partners.Users', 'StudentStatus', 'Schooltypes']
		]);
		$this->loadModel('StudentSubjects');
		$this->loadModel('StudentClassranges');
		$this->loadModel('Classranges');
		$this->loadModel('Subjects');
		$subject = $this->StudentSubjects->findByStudentId($id)->contain('Subjects')->first();
		if($subject['subject1'] != NULL){
			$subject1 = $this->Subjects->get($subject['subject1']);
                }
                if($subject['subject2'] != NULL){
			$subject2 = $this->Subjects->get($subject['subject2']);
                }
		if($subject['subject3'] != NULL){
			$subject3 = $this->Subjects->get($subject['subject3']);
                }
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
			$student->student_status_id = 1;
			$student->waiting = time();
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
					return $this->redirect(['action' => 'index', 'active']);
				} else {
					$this->Student->delete($student);
					$this->Flash->error(__('The student could not be saved. Please, try again.'));
				}
			} else {
				$this->Flash->error(__('The student could not be saved. Please, try again.'));
			}
		}
		$this->loadModel('Subjects');
		$this->loadModel('Classranges');
		$schooltypes = $this->Students->Schooltypes->find('list');
		$subjects = $this->Subjects->find('list');
		$classranges = $this->Classranges->find('list');
		$this->set(compact('student', 'subjects', 'classranges', 'schooltypes'));
		//$this->set('student', $student);
		$this->set('_serialize', ['student', 'subjects', 'classranges', 'schooltypes']);
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
                    'contain' => ['StudentSubjects.Subjects', 'StudentClassranges.Classranges']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$student = $this->Students->patchEntity($student, $this->request->data);
                        
                        //edit subjects in student_subjects table
                        $this->loadModel('StudentSubjects');
                        $student_subjects = $this->StudentSubjects
                                ->find('all', [
                                    'conditions' => ['student_id =' => $id]
                                ])
                                ->first();
                        
                        $student_subjects->subject1 = $this->request->data['subject1'];
                        $student_subjects->subject2 = $this->request->data['subject2'];
                        $student_subjects->subject3 = $this->request->data['subject3'];
                        
                        //edit classrange in StudentSubjects table
                        $this->loadModel('StudentClassranges');
                        $student_classrange = $this->StudentClassranges
                                ->find('all', [
                                    'conditions' => ['student_id =' => $student->id]
                                ])
                                ->first();
                        $student_classrange->classrange_id = $this->request->data['classranges'];
                        
                        $student_saved = ($this->Students->save($student));
                        $subjects_saved = ($this->StudentSubjects->save($student_subjects));
                        $classrange_saved = ($this->StudentClassranges->save($student_classrange));
                        
                        //save everything
			if ($student_saved and $subjects_saved and $classrange_saved) {
				$this->Flash->success(__('The student has been saved.'));
				return $this->redirect(['action' => 'index', 'active']);
			} else {
				$this->Flash->error(__('The student could not be saved. Please, try again.'));
			}
		}
                
		$this->loadModel('StudentStatus');
		$this->loadModel('Subjects');
		$this->loadModel('Classranges');
                
		$schooltypes = $this->Students->Schooltypes->find('list');
		$status = $this->StudentStatus->find('list');
		$subjects = $this->Subjects->find('list');
		$classranges = $this->Classranges->find('list');
                
                $default_classrange = $this->Students->StudentClassranges->find('all', ['conditions' => ['student_id =' => $student->id]])->first();
                $default_schooltype = $this->Students->Schooltypes->find('all', ['conditions' => ['id = ' => $student->schooltype_id]])->first();
                $default_subject[1] = $this->Subjects->find('all', ['conditions' => ['id = ' => $student->student_subject->subject1]])->first();
                $default_subject[2] = $this->Subjects->find('all', ['conditions' => ['id = ' => $student->student_subject->subject2]])->first();
                $default_subject[3] = $this->Subjects->find('all', ['conditions' => ['id = ' => $student->student_subject->subject3]])->first();
                
		$this->set(compact('student', 'status', 'subjects', 'classranges', 'schooltypes', 'default_classrange', 'default_schooltype','default_subject'));
		$this->set('_serialize', ['student', 'status', 'subjects', 'classranges', 'schooltypes']);
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
				$this->Flash->success(__('The student has been deleted.'));
			} else {
				$this->Flash->error(__('The student could not be deleted. Please, try again.'));
			}
		} else {
			$this->Flash->error(__('The student could not be deleted. Please, try again.'));
		}
		return $this->redirect($this->referer(['action' => 'index']));
	}
	
	public function deactivate($id = null) {
            $student = $this->Students->get($id,[
                'contain' => ['Tandems']
            ]);
        
            //alle tandems in denen der schüler steckt werden ebenfalls deaktiviert
            $tandemsController = new TandemsController;
            foreach($student->tandems as $tandem){
                $tandemsController->deactivate($tandem->id);
            }

            $student->student_status_id = 3;
            if($this->Students->save($student)){
                    $this->Flash->success('Der Schüler wurde deaktiviert.');
            } else {
                    $this->Flash->error('Konnte Schüler nicht deaktivieren.');
            }
            return $this->redirect(['action' => 'index', 'active']);
	}
	
	public function reactivate($id = null) {
		$student = $this->Students->get($id);
		$student->student_status_id = 1;
		if($this->Students->save($student)){
			$this->Flash->success('Der Schüler wurde reaktiviert.');
		} else {
			$this->Flash->error('Konnte Schüler nicht reaktivieren.');
		}
		return $this->redirect(['action' => 'index', 'deactive']);
	}
	
	public function status($id = null) {
		$student = $this->Students->get($id);
		$this->loadModel('Tandems');
		if($this->request->is(['patch', 'post', 'put'])) {
			$tandems_count = $this->Tandems->find()->where(['student_id' => $student->id, 'deactivated IS NULL'])->count();
			$status = $this->request->data('student_status_id');
			
			if($tandems_count == 0 && $status == 2) {
				$this->Flash->error('Schüler ist in keiner Patenschaft. Kann nicht auf vermittelt gestellt werden.');
			} else if($tandems_count != 0 && $status != 2){
				$this->Flash->error('Schüler ist zurzeit in einer Patenschaft. Deaktivieren sie diese vorher!');
			} else {
				if($status == 1) {
					$student->waiting = time();
				} else {
					$student->waiting = null;
				}
				$student = $this->Students->patchEntity($student, $this->request->data);
				if($this->Students->save($student)) {
					$this->Flash->success('Status wurde aktualisiert');
					$this->redirect(['action' => 'index', 'active']);
				} else {
					$this->Flash->error('Konnte Status nicht aktualisieren');
				}
			}
		}
		
		$status = $this->Students->StudentStatus->find('list', ['limit' => 200]);
		$this->set(compact('student', 'status'));
		$this->set('_serialize', ['student', 'status']);
	}
}
