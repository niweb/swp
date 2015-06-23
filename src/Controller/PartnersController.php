<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Event\Event;

/**
 * Partners Controller
 *
 * @property \App\Model\Table\PartnersTable $Partners
 */
class PartnersController extends AppController
{

	public function beforeFilter(Event $event){
            parent::beforeFilter($event);
            $this->Auth->allow('register');
	}

	public function isAuthorized($user) {
            if(in_array($this->request->action, ['view', 'edit'])){
                $partnerID = (int)$this->request->params['pass'][0];
                if($this->Partners->isTheSame($partnerID, $user['id'])){
                    return true;
                }
            }
            if(in_array($this->request->action, ['index'])){
                $this->loadModel('UserHasTypes');
                $type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
                if($type > '1') {
                    return true;
		}
            }
            if(in_array($this->request->action, ['view', 'match'])){
                $this->loadModel('UserHasTypes');
                $type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
                if($type > '1'){
					$location = $this->Auth->user('location_id');
					$partnerID = (int)$this->request->params['pass'][0];
					$partnerLocation = $this->Partners->get($partnerID)->location_id;
					if($location == $partnerLocation){
						return true;
					}
                }
            }
			if(in_array($this->request->action, ['edit', 'delete', 'status'])){
                $this->loadModel('UserHasTypes');
                $type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
                if($type > '2'){
					$location = $this->Auth->user('location_id');
					$partnerID = (int)$this->request->params['pass'][0];
					$partnerLocation = $this->Partners->get($partnerID)->location_id;
					if($location == $partnerLocation){
						return true;
					}
                }
            }
			if(in_array($this->request->action, ['add'])){
                $this->loadModel('UserHasTypes');
                $type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
                if($type > '2'){
					return true;
                }
            }
			
            return parent::isAuthorized($user);
	}

	/**
	 * Index method
	 *
         * @param string|null $view welche paten werden angezeigt - 'all', 'verified', 'waiting', 'active', 'inactive'.
	 * @return void
	 */
	public function index($view=null)
	{
            /*$this->paginate = [
                'contain' => ['Locations']
            ];
            $this->set('partners', $this->paginate($this->Partners));
            $this->set('_serialize', ['partners']);

            $this->loadModel('Users');
            $this->set('users', $this->paginate($this->Users));
            $this->set('_serialize', ['users']);*/
            
            switch($view){
                case 'all':
                    //alle alle
                    $condition = [];
                    break;
                case 'verified':
                    //alle ab verifiziert
                    $condition = ['status_id >=' => 2];
                    break;
                case 'waiting':
                    //alle wartenden
                    $condition = ['status_id =' => 5];
                    break;
                case 'active':
                    //alle wartenden und vermittelten
                    $condition = ['status_id >=' => 5, 'status_id <=' => 6];
                    break;
                case 'inactive':
                    //alle aufgehört und abgelehnten
                    $condition = ['status_id >=' => 7, 'status_id <=' => 8];
                    break;
                default:
                    //keiner
                    $condition = ['status_id <' => 0];
            }

            $this->loadModel('UserHasTypes');
            $user = $this->Auth->user();
            $userType = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];

            if($userType > '1' && $userType < '5') {
                $condition['Users.location_id ='] = $user['location_id'];
                $this->paginate = ['contain' => ['Locations', 'Users', 'Status']];
                $partners = $this->Partners->find('all', ['limit' => 500, 'conditions' => $condition])->contain(['Users', 'Status']);
                $this->set('partners', $this->paginate($partners));
                $this->set('_serialize', ['partners']);
            } else {
                //unwichtig weil globadmin eigentlich nie paten sieht
                $this->paginate = ['contain' => ['Locations', 'Users', 'Status']];
                $partners = $this->Partners->find('all')->contain(['Users']);
                $this->set('partners', $this->paginate($partners));
                $this->set('_serialize', ['partners']);
            }
	}

	/**
	 * View method
	 *
	 * @param string|null $id Partner id.
	 * @return void
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function view($id = null)
	{
            $partner = $this->Partners->get($id, [
                'contain' => ['PreferredClassranges.Classranges', 'PreferredSchooltypes.Schooltypes', 'PreferredSubjects.Subjects', 'Tandems.Students', 'Status', 'Users']
            ]);
            $this->set('partner', $partner);
            $this->set('_serialize', ['partner']);

            /*$this->loadModel('Users');
            $user = $this->Users->get($partner->user_id);
            
            $this->set('user', $user);
            $this->set('_serialize', ['user']); */
	}

	/**
	 * Add method
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
            /*$partner = $this->Partners->newEntity();
			$user = $this->Auth->user();
            if ($this->request->is('post')) {
                $partner = $this->Partners->patchEntity($partner, $this->request->data);
                if ($this->Partners->save($partner)) {
                    $this->Flash->success('The partner has been saved.');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('The partner could not be saved. Please, try again.');
                }
            }
            $locations = $this->Partners->Locations->find('list', ['limit' => 200]);
            $this->set(compact('partner', 'locations'));
            $this->set('_serialize', ['partner']);*/
            
            return $this->redirect(['action' => 'register']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Partner id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
            $partner = $this->Partners->get($id, [
                'contain' => []
            ]);
            $this->loadModel('Users');
            if ($this->request->is(['patch', 'post', 'put'])) {
                $partner = $this->Partners->patchEntity($partner, $this->request->data);
                $user = $this->Users->get($partner->user_id);
                $user->first_name = $this->request->data('user.first_name');
                $user->last_name = $this->request->data('user.last_name');
                if ($this->Partners->save($partner) && $this->Users->save($user)) {
                    $this->Flash->success('The partner has been saved.');
                    return $this->redirect(['action' => 'view', $partner->id]);
                } else {
                    $this->Flash->error('The partner could not be saved. Please, try again.');
                }
            }
            $this->loadModel('UserHasTypes');
            $type = $this->UserHasTypes->findByUserId($this->Auth->user('id'))->first()['type_id'];
            $user = $this->Users->get($partner->user_id);
            $locations = $this->Partners->Locations->find('list', ['limit' => 200]);
            $status = $this->Partners->Status->find('list', ['limit' => 200]);
            $this->set(compact('partner', 'locations', 'user', 'status', 'type'));
            $this->set('_serialize', ['partner', 'user']);
	}

	/*public function deactivate($id = null){
		$this->request->allowMethod(['post', 'deactivate']);
		$partner = $this->Partners->get($id);
		
	}*/
	
	/**
	 * Delete method
	 *
	 * @param string|null $id Partner id.
	 * @return void Redirects to index.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function delete($id = null)
	{	
		$this->request->allowMethod(['post', 'delete']);
		$partner = $this->Partners->get($id);
		if ($this->Partners->delete($partner)) {
			$this->loadModel('PreferredClassranges');
			$this->loadModel('PreferredSchooltypes');
			$this->loadModel('PreferredSubjects');
			$this->PreferredClassranges->deleteAll(['partner_id' => $id]);
			$this->PreferredSchooltypes->deleteAll(['partner_id' => $id]);
			$this->PreferredSubjects->deleteAll(['partner_id' => $id]);
			
			$this->Flash->success('Pate wurde gelöscht');
		} else {
			$this->Flash->error('Pate konnte nicht gelöscht werden');
		}
		return $this->redirect(['action' => 'index']);
	}

public function register($loc = null) /* location-id */
    {
        $partner = $this->Partners->newEntity();
        $userTable = TableRegistry::get('Users');
        $user = $userTable->newEntity();

        if ($this->request->is('post')) {
            
            //user-eintrag
            $user->first_name = $this->request->data('user.first_name');
            $user->last_name = $this->request->data('user.last_name');
            $user->email = $this->request->data('user.email');
            $user->password = $this->request->data('user.password');
            $user->type_id = 1;
            $user->location_id = $loc;
            $user->activation = rand(100000000,999999999);
            $userSaved = $userTable->save($user);
            
            //user must be checked if saved first b/c partner needs user->id
            if($userSaved){
                //partner-eintrag
                $partner = $this->Partners->patchEntity($partner, $this->request->data()/*, ['associated'=>'Users']*/);
                $partner->user_id = $user->id;
                $partner->location_id = $loc;
                $partner->status_id = 1;            //initialized status_id -> achtung bei db-änderungen
                $partnerSaved = $this->Partners->save($partner);

                //userhastypes-eintrag
                $userTypeTable = TableRegistry::get('UserHasTypes');
                $userType = $userTypeTable->newEntity();
                $userType->user_id = $user->id;
                $userType->type_id = 1;
                $userTypeSaved = $userTypeTable->save($userType);

                if($partnerSaved AND $userSaved){
                    //preferredclassranges-eintrag
                    $pClassrangesTable = TableRegistry::get('PreferredClassranges');
                    $allPClassrangesSaved = true;
                    foreach(($this->request->data('preferredClassranges')) as $classrangeId => $checked){
                        if($checked == '1'){
                            $pClassrange = $pClassrangesTable->newEntity();
                            $pClassrange->partner_id = $partner->id;
                            $pClassrange->classrange_id = $classrangeId;
                            $pClassrangeSaved = $pClassrangesTable->save($pClassrange);
                            $allPClassrangesSaved = $pClassrangeSaved ? true : false;
                        }
                    }

                    //preferredschooltypes-eintrag
                    $pSchooltypesTable = TableRegistry::get('PreferredSchooltypes');
                    $allPSchooltypesSaved = true;
                    foreach(($this->request->data('preferredSchooltypes')) as $schooltypeId => $checked){
                        if($checked == '1'){
                            $pSchooltype = $pSchooltypesTable->newEntity();
                            $pSchooltype->partner_id = $partner->id;
                            $pSchooltype->schooltype_id = $schooltypeId;
                            $pSchooltypeSaved = $pSchooltypesTable->save($pSchooltype);
                            $allPSchooltypesSaved = $pSchooltypeSaved ? true : false;
                        }
                    }

                    //preferredsubjects-eintrag
                    $pSubjectsTable = TableRegistry::get('PreferredSubjects');
                    $allPSubjectsSaved = true;
                    foreach(($this->request->data('preferredSubjects')) as $subjectId => $gradeLimit){
                        if(($gradeLimit != 0) AND ($gradeLimit != null)){
                            $pSubject = $pSubjectsTable->newEntity();
                            $pSubject->partner_id = $partner->id;
                            $pSubject->subject_id = $subjectId;
                            $pSubject->maximum_class = $gradeLimit;
                            $pSubjectSaved = $pSubjectsTable->save($pSubject);
                            $allPSubjectsSaved = $pSubjectSaved ? true : false;
                        }
                    }

                    $allPreferencesSaved = $allPClassrangesSaved AND $allPSchooltypesSaved AND $allPSubjectsSaved;

                    //add preferredSubjects: überprüfung ob maximum_class empty oder 0
                    if ($allPreferencesSaved) {
                        //everything saved? then send activationMail
                        $userController = new UsersController;
                        $userController->sendActivationMail($user->id);
                        $this->Flash->success('Deine Informationen wurden gespeichert. Danke!');
                        return $this->redirect(['controller'=>'Users','action' => 'login']);
                    } else {
                        //otherwise delete everything!
                        $this->loadModel('PreferredClassranges');
                        $this->loadModel('PreferredSchooltypes');
                        $this->loadModel('PreferredSubjects');
						$this->Partners->delete($partner);
                        $this->PreferredClassranges->deleteAll(['partner_id' => $partner['id']]);
                        $this->PreferredSchooltypes->deleteAll(['partner_id' => $partner['id']]);
                        $this->PreferredSubjects->deleteAll(['partner_id' => $partner['id']]);

                        $this->Flash->error('Es ist leider ein Fehler aufgetreten. Bitte überprüfe deine Eingaben und probiere es gleich noch einmal.');
                    }
                }else {

                    $userTable->delete($user);
                    $this->Partners->delete($partner);
                    $userTypeTable->delete($userType);

                    $this->Flash->error('Es ist leider etwas schief gelaufen. Bitte versuche es gleich noch einmal. (User konnte nicht gespeichert werden)');
                }
            }else {
                $this->Flash->error('Es ist leider etwas schief gelaufen. Bitte versuche es gleich noch einmal. (User konnte nicht gespeichert werden)');
            }
        } 

        //set variables for view
        
        $this->loadModel('Locations');
        $location_name = $this->Locations->findById($loc)->first()['name'];
        
        $this->loadModel('Classranges');
        $classranges = $this->Classranges->find('all');
        
        $this->loadModel('Schooltypes');
        $schooltypes = $this->Schooltypes->find('all')
                ->where(['location_id =' => $loc]);
        
        $this->loadModel('Subjects');
        $subjects = $this->Subjects->find('all')
                ->where(['location_id =' => $loc]);
        
        $this->set(compact('partner', 'location_name', 'classranges', 'schooltypes', 'subjects'));
        $this->set('_serialize', ['partner']);
    }

    
    public function match($partnerId = null, $studentId = null){
        if($partnerId == null){
            //wenn partner id = null, dann noch nicht im matching
            //also redirect zu index, damit matcher paten auswählen kann
            $this->redirect(['action' => 'index']);
        }
        else if($studentId == null){
            //wenn partnerId != null, aber studentid == 0, so wurde schon ein pate
            //ausgewählt, aber noch kein passender schüler dazu
            //nur hier werden Daten im view gebraucht, die werden hier gesetzt
            
            $partner = $this->Partners->get($partnerId, [
                'contain' => ['Users']
                ]);
            $this->loadModel('Students');
            $students = $this->Students->find('all')
                    ->where(['location_id =' => $partner->location_id]);

            $this->set(compact('partner', 'students',$this->paginate($students)));
            $this->set('_serialize', ['partner'], ['students']);
            
            
        }
        else{
            //wenn partner und schüler id gesetzt, so soll ein neues tandem kreiert werden
            $partner = $this->Partners->get($partnerId, [
                'contain' => ['Users']
            ]);
            $partnerName = h($partner->user->first_name . ' ' . $partner->user->last_name);
            
            $this->loadModel('Students');
            $student = $this->Students->get($studentId);
            $studentName = h($student->first_name . ' ' . $student->last_name);
            
            $tandemTable = TableRegistry::get('Tandems');
            $tandem = $tandemTable->newEntity();
            $tandem->partner_id = $partnerId;
            $tandem->student_id = $studentId;
            $tandemTable->save($tandem);
            
            $this->Flash->success(h($partnerName . ' und ' . $studentName . ' sind nun ein Tandem!'));
            $this->redirect(['controller' => 'Tandems', 'action' => 'index', ['sort' => 'activated', 'direction' => 'desc']]);
        }
    }
	
	public function status($id = null) {
		$partner = $this->Partners->get($id, ['contain' => ['Users']]);
		if($this->request->is(['patch', 'post', 'put'])){
			$partner = $this->Partners->patchEntity($partner, $this->request->data);
			if($this->Partners->save($partner)){
				$this->Flash->success('Status aktualisiert');
				$this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('Fehler beim speichern des Paten.');
			}
		}
		$status = $this->Partners->Status->find('list', ['limit' => 200]);
		$this->set(compact('partner', 'status'));
		$this->set('_serialize', ['partner', 'status']);
	}

  
}
