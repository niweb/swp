<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Tandems Controller
 *
 * @property \App\Model\Table\TandemsTable $Tandems
 */
class TandemsController extends AppController
{

	public function isAuthorized($user){
	
		$type = $user['type_id'];
		if(in_array($this->request->action, ['index', 'view', 'add', 'edit', 'delete', 'deactivate'])){
			if($type > '1'){
				return true;
			}
		}
		
		if(in_array($this->request->action, ['reactivate'])){
			if($type > '3'){
				return true;
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
			'contain' => ['Partners.Users', 'Students']
		];	
		$location = $this->Auth->user('location_id');
		$query = $this->Tandems->find()->contain(['Partners.Users'])->where(['Partners.location_id' => $location]);
		$this->set('tandems', $this->paginate($query));
		$this->set('_serialize', ['tandems']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Tandem id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
            $tandem = $this->Tandems->get($id, [
                'contain' => ['Partners.Users', 'Students']
            ]);
            $this->set('tandem', $tandem);
            $this->set('_serialize', ['tandem']);
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	/*public function add()
	{
		$tandem = $this->Tandems->newEntity();
		if ($this->request->is('post')) {
			$tandem = $this->Tandems->patchEntity($tandem, $this->request->data);
			if ($this->Tandems->save($tandem)) {
				$this->Flash->success('The tandem has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The tandem could not be saved. Please, try again.');
			}
		}
		$location = $this->Auth->user('location_id');
		$partners = $this->Tandems->Partners->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'user.first_name'])->contain(['Users'])->where(['Partners.location_id' => $location]);
		$students = $this->Tandems->Students->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'first_name'])->where(['Students.location_id' => $location]);
		$this->set(compact('tandem', 'partners', 'students'));
		$this->set('_serialize', ['tandem']);
	}*/

	/**
	 * Edit method
	 *
	 * @param string|null $id Tandem id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$tandem = $this->Tandems->get($id, [
            'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$tandem = $this->Tandems->patchEntity($tandem, $this->request->data);
			if ($this->Tandems->save($tandem)) {
				$this->Flash->success('The tandem has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The tandem could not be saved. Please, try again.');
			}
		}
		$partners = $this->Tandems->Partners->find('list', ['limit' => 200]);
		$students = $this->Tandems->Students->find('list', ['limit' => 200]);
		$this->set(compact('tandem', 'partners', 'students'));
		$this->set('_serialize', ['tandem']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Tandem id.
	 * @return void Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$tandem = $this->Tandems->get($id);
		if ($this->Tandems->delete($tandem)) {
			$this->Flash->success('The tandem has been deleted.');
		} else {
			$this->Flash->error('The tandem could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
	
	public function deactivate($id = null){
		
		$this->loadModel('Students');
		$tandem = $this->Tandems->get($id);
		$studentID = $tandem->student_id;
		$studentsCount = $this->Tandems->find()->where(['student_id' => $studentID, 'deactivated IS NULL'])->count();
		if($studentsCount == 1){
	        $student = $this->Students->get($studentID);
	        $student->student_status_id = '3'; 
	        $this->Students->save($student);
		}
		$this->loadModel('Partners');
		$partnerID = $tandem->partner_id;
		//$deactivated = $tandem->deactivated;
		$partnersCount = $this->Tandems->find()->where(['partner_id' => $partnerID, 'deactivated IS NULL'])->count();
		if($partnersCount == 1){
			$partner = $this->Partners->get($partnerID);
			$partner->status_id = '7'; 
			$this->Partners->save($partner);
		}
		
		$time = time();
		$tandem->deactivated = $time;
		if($this->Tandems->save($tandem)){
			$this->Flash->success('Tandem deaktiviert!');
		} else {
			$this->Flash->error('Tandem konnte nicht deaktiviert werden');
		}
		return $this->redirect(['action' => 'index']);
	}
	
        
    public function reactivate($id = null){
		$tandem = $this->Tandems->get($id);
		$time = time();
		$tandem->deactivated = null;
		$this->loadModel('Students');
		$student_id=$tandem->student_id;
		$student = $this->Students->get($student_id);
        $student->student_status_id='2'; 
        $this->Students->save($student);
        $this->loadModel('Partners');
        $partner_id=$tandem->partner_id;
		$partner = $this->Partners->get($partner_id);
        $partner->status_id='6'; 
	    $this->Partners->save($partner);
		
		if($this->Tandems->save($tandem)){
			$this->Flash->success('Tandem wieder aktiviert!');
		} else {
			$this->Flash->error('Tandem konnte nicht wieder aktiviert werden');
		}
		return $this->redirect(['action' => 'index']);
	}
        
}
