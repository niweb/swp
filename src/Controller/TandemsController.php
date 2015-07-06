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
			if($type > '2'){
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
	public function index($view = null)
	{	
        $this->paginate = [
			'sortWhitelist' => ['Students.first_name', 'Users.first_name', 'activated', 'deactivated'],
            'contain' => ['Students', 'Partners.Users']
        ];	
        
        switch($view){
                case 'active':
                    $condition = ['deactivated IS NULL'];
                    $active = true;
                    break;
                case 'inactive': 
                    $condition = ['deactivated IS NOT NULL'];
                    $active = false;
                    break;
                default: 
                    //default is active
                    $condition = ['deactivated IS NULL'];
                    $active = true;
                    break;
        }

        if($this->Auth->user('type_id') < 5){
            //wenn user kein admin ist, dann nur die tandems
            //von seiner location anzeigen
            $location = $this->Auth->user('location_id');
            $condition['Partners.location_id'] = $location;
        }
        
        $query = $this->Tandems->find()->contain(['Partners.Users'])->where($condition);
        $this->set('tandems', $this->paginate($query));
        $this->set(compact('active'));
        $this->set('_serialize', ['tandems']);
        
        /*$query_active_tandems = $this->Tandems->find()
                ->contain(['Partners.Users'])
                ->where(['Partners.location_id' => $location, 'deactivated =' => NULL])
                ->order(['activated' => 'DESC']);
        
        $query_inactive_tandems = $this->Tandems->find()
                ->contain(['Partners.Users'])
                ->where(['Partners.location_id' => $location, 'deactivated !=' => NULL])
                ->order(['deactivated' => 'DESC']);
        
        $this->set('active_tandems', $this->paginate($query_active_tandems));
        $this->set('inactive_tandems', $this->paginate($query_inactive_tandems));
        $this->set('_serialize', ['active_tandems', 'inactive_tandems']);*/
        
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
            $tandem = $this->Tandems->get($id);
            
            //schüler der mit tandem assoziiert ist...
            $studentID = $tandem->student_id;
            
            //... wird auf weitere tandems überprüft
            $studentsTandems = $this->Tandems->find('list')->where(['student_id =' => $studentID, 'deactivated IS NULL']);
            $studentsCount = count($studentsTandems);
            if($studentsCount == 1){
                //wenn das das einzige ist, setze schüler wieder auf wartend
                $this->loadModel('Students');
                $student = $this->Students->get($studentID);
                $student->student_status_id = '3'; //aufgehört
                $student->waiting = Time::now();
                $this->Students->save($student);
            }
            
            //genauso der Pate...
            $partnerID = $tandem->partner_id;
           
            $partnersTandems = $this->Tandems->find('list')->where(['partner_id' => $partnerID, 'deactivated IS NULL']);
            $partnersCount = count($partnersTandems);
            if($partnersCount == 1){
                
                $partnersController = new PartnersController;
                $partnersController->setStatus($partnerID, 7);
                
            }

            $tandem->deactivated = Time::now();
            
            if($this->Tandems->save($tandem)){
                    $this->Flash->success('Tandem deaktiviert!');
            } else {
                    $this->Flash->error('Tandem konnte nicht deaktiviert werden');
            }
            
            return $this->redirect($this->request->referer());
	}
	
        
    public function reactivate($id = null){
        $tandem = $this->Tandems->get($id);
        $tandem->deactivated = null;
        
        $this->loadModel('Students');
        $student_id=$tandem->student_id;
        $student = $this->Students->get($student_id);
        $student->student_status_id='2'; //(wieder) auf vermittlet setzen
		$student->waiting = null;
        $studentSaved = $this->Students->save($student);
        
        $this->loadModel('Partners');
        $partner_id = $tandem->partner_id;
        $partner = $this->Partners->get($partner_id);
        $partner->status_id='6'; //(wieder) auf vermittlet setzen
		$partner->waiting = null;
        $partnerSaved = $this->Partners->save($partner);

        if($studentSaved and $partnerSaved and $this->Tandems->save($tandem)){
            $this->Flash->success('Tandem wieder aktiviert!');
        } else {
            $this->Flash->error('Tandem konnte nicht wieder aktiviert werden');
        }
        return $this->redirect($this->request->referer());
    }
        
}
