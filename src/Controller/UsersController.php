<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Types', 'Locations']
        ];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Types', 'Locations']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->activation = rand(100000000,999999999);					//generate activation-key
            if ($this->Users->save($user)) {
            	$this->sendActivationMail($user->first_name, $user->email, $user->id, $user->activation);
                $this->Flash->success('Der Nutzer wurde gespeichert. Es wurde eine Aktivierungsmail an '.$user->email.' gesendet.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Der Nutzer konnte nicht gespeichert werden. Bitte probiere es später erneut.');
            }
        }
        $types = $this->Users->Types->find('list', ['limit' => 200]);
        $locations = $this->Users->Locations->find('list', ['limit' => 200]);
        $this->set(compact('user', 'types', 'locations'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $types = $this->Users->Types->find('list', ['limit' => 200]);
        $locations = $this->Users->Locations->find('list', ['limit' => 200]);
        $this->set(compact('user', 'types', 'locations'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function login()
	{
		$this->loadModel('Partners');
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			
			if ($user) {
				if($user->activation == NULL){
					//nur einloggen, wenn user aktiviert
					$this->Auth->setUser($user);
					return $this->redirect($this->Auth->redirectUrl());
					
					/* redirect to partner-profile
					$partner = $this->Partners->findByUserId($this->Auth->user('id')->first())
					return $this->redirect($this->Auth->redirectUrl(['controller' => 'Partners', 'action' => 'view', $partner->id]));*/
				} else {
					$this->Flash->error('Deine Email-Adresse ist noch nicht aktiviert worden. Du musst zuerst auf den Link klicken, den wir dir zugesandt haben bevor du dich einloggen kannst.');
				}
			} else {
				$this->Flash->error('Die Email-Adresse oder das Passwort ist leider nicht richtig.');
			}
		}
	}

	public function logout()
	{
		$this->Flash->success('Du bist jetzt ausgeloggt.');
		return $this->redirect($this->Auth->logout());
	}
    
    
    /**
     * Send activation mail method
     *
     * @param string $name User name.
     * @param string $email User Email.
     * @param string $id User id.
     * @param string $key User activation (key).
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    private function sendActivationMail($name, $email, $id, $key){
    	//deliver-method
    	/*$from = 'Schülerpaten <noreply@schuelerpaten.de>';
    	$to = $email;
    	$subject = 'Aktivierungslink fuer deine Registrierung bei Schülerpaten';
    	$link = 'http://localhost/schuelerpaten/users/activate/'.$id.'/'.$key;
    	$msg = "Hallo ".$name."!
            	Vielen Dank für deine Registrierung bei Schülerpaten!
            	Um deine Registrierung bei Schülerpaten abzuschliessen klicke bitte auf den folgenden Aktivierungslink:
            	<a href='".$link."'>".$link."</a>
            	Sollte dieser nicht als Link erscheinen, so kannst du ihn auch in die Adresszeile deines Browsers kopieren.
            	Nach der Aktivierung kannst du dich auf unserem Portal mit deiner Email-Adresse und dem von dir gewählten Passwort einloggen um deine Informationen ueber dich einzusehen oder zu ändern, deinen Vermittlungsstatus ansehen oder deine Registrierung rückgängig machen.
            	Mit freundlichen Grüßen,
            	Dein Schülerpaten-Team";
    	
    	Email::deliver($to, $subject, $msg, ['from' => $from]);*/
    	
    	//"true" mail-method
    	
		$email = new Email('default');
		$email	->from(['noreply@schuelerpaten.de' => 'Schülerpaten'])
				->to($email)
				->subject('Aktivierungslink fuer deine Registrierung bei Schülerpaten')
				->send("Hallo ".$name."!
            			Vielen Dank für deine Registrierung bei Schülerpaten!
            			Um deine Registrierung bei Schülerpaten abzuschliessen klicke bitte auf den folgenden Aktivierungslink:
            			<a href='".$link."'>".$link."</a>
            			Sollte dieser nicht als Link erscheinen, so kannst du ihn auch in die Adresszeile deines Browsers kopieren.
            			Nach der Aktivierung kannst du dich auf unserem Portal mit deiner Email-Adresse und dem von dir gewählten Passwort einloggen um deine Informationen ueber dich einzusehen oder zu ändern, deinen Vermittlungsstatus ansehen oder deine Registrierung rückgängig machen.
            			Mit freundlichen Grüßen,
            			Dein Schülerpaten-Team");
    }
    
    public function register(){
		//registrierungsfunktion nur fuer paten!!!
		//vermittler/matchmaker/admins muessen sich ueber /users/add
		//von jemand anderem registrieren lassen
		//schueler muessen dies ueber students/add tun lassen

    	//ninas version
		/*$user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            //user erstellen & activation-key generieren
			$user = $this->Users->patchEntity($user, $this->request->data);
			$user->activation = rand(100000000,999999999);
			
			//wenn $user-eintrag gespeichert...
			if ($this->Users->save($user)) {
				
				// user_has_types-Tabelle Eintrag für 'user ist ein pate' machen
				$userHasTypesTable = TableRegistry::get('User_Has_Types');		
				$userHasType = $userHasTypesTable->newEntity();
				$userHasType = $userHasTypesTable->newEntity([
					'user_id' => $user->id,
					'type_id' => 0,			//type_id von Typ "Pate" - unbedingt bei typenaenderung mit aendern!
				]);
				
				//wenn $'user ist ein pate'-eintrag gespeichert... 
				if($userHasTypesTable->save($userHasType)){
					
					//eintrag in partner tabelle erstellen
					$partnersTable = TableRegistry::get('Partners');
					$partner = $partnersTable->newEntity();
					$partner = $partnersTable->newEntity([
						'location_id' => $user->location_id,
						'user_id' => $user->id,
						'status_id' => 0,
					]);
					//debug($partner, true, false);
					//wenn partner-eintrag gespeichert...
					if($partnersTable->save($partner)){
						//Email mit bestaetigungslink verschicken
						$this->sendActivationMail($user->first_name, $user->email, $user->id, $user->activation);
						
						//ALLES LIEF GUT!! zur (einmaligen) paten-info-edit seite (alternativ vielleicht erst registrierungsmail??)
						$this->Flash->success('Es wurde eine Aktivierungsmail an '.$user->email.' gesendet. Bitte folge dem dort enthaltenen Link um deine Registrierung abzuschliessen.
		            						Gib am besten jetzt gleich ein paar Information an, damit wir dich mit Schülern die deine Hilfe brauchen verbinden können!');
						return $this->redirect(['controller' => 'Partners', 'action' => 'register', $user->id, $this->request->data('location_id')]);
					} //end of save-partner-if
					$this->Flash->error('partner konnte nicht gespeichert werden'); //zurück zur user-registry
					return $this->redirect(['controller' => 'Users', 'action' => 'register', $user->id, $this->request->data('location_id')]);
				} //end of save-user_has_types-if
			} //end of save-user-if
			
			//falls irgendwas schief gelaufen ist...
			//$this->Flash->error('Bei deiner Registrierung ist wohl ein Fehler unterlaufen. Bitte probiere es gleich noch einmal.');
			//return $this->redirect(['controller' => 'Partners', 'action' => 'register', $user->id, $this->request->data('location_id')]);
		} //end of method=post-if
		
		// wenn method != post, dann formular "vorbereiten"
		$locations = $this->Users->Locations->find('list', ['limit' => 10]);
		$this->set(compact('user', 'locations'));
		$this->set('_serialize', ['user']);*/
    	
    	
    	$user = $this->Users->newEntity();
		$userTypeTable = TableRegistry::get('UserHasTypes');
		$userType = $userTypeTable->newEntity();
		if ($this->request->is('post')) {
 			$user = $this->Users->patchEntity($user, $this->request->data);
 			$user->type_id = 1;												//type_id von Typ "Pate" -
 			//unbedingt bei typenaenderung mit aendern!
 			$user->activation = rand(100000000,999999999);					//generate activation-key
			$this->Flash->success($user->id);
			$userType->user_id = $user->id;
			$userType->type_id = 1;
 			if ($this->Users->save($user)) {
				$userType->user_id = $user->id;
                        	$userType->type_id = 1;
				if($userTypeTable->save($userType)){
 				
				$this->sendActivationMail($user->first_name, $user->email, $user->id, $user->activation);
					
 				$this->Flash->success('Es wurde eine Aktivierungsmail an '.$user->email.' gesendet. Bitte folge dem dort enthaltenen Link um deine Registrierung abzuschliessen.\n
             						Gib am besten jetzt gleich ein paar Information an, damit wir dich mit Schülern die deine Hilfe brauchen verbinden können!');
 				return $this->redirect(['controller' => 'Partners', 'action' => 'register', $user->id, $this->request->data('location_id')]);
			} else {
				$this->Flash->error('Bei deiner Registrierung ist wohl ein Fehler unterlaufen. Bitte probiere es gleich noch einmal.');
			}
 			}
 			else {
 				$this->Flash->error('Bei deiner Registrierung ist wohl ein Fehler unterlaufen. Bitte probiere es gleich noch einmal.');
 			}
 		}
 		$locations = $this->Users->Locations->find('list', ['limit' => 10]);
 		$this->set(compact('user', 'locations'));
 		$this->set('_serialize', ['user']);
 	}
    	
 	public function activate($id = null, $key = null)
 	{
 		if(!$user = $this->Users->get($id)){
 			//nutzer existiert nicht
 			$this->Flash->error('Der Nutzer mit id '. $id. ' existiert nicht');
 			return $this->redirect(['action' => 'index']);	
 		}
 		if ($user->activation == NULL) {
 			//nutzer ist bereits aktiviert
 			$this->Flash->success('Deine Email-Adresse wurde bereits bestätigt. Du kannst dich jetzt einloggen.');
 			return $this->redirect(['action' => 'login']);
 		}
 		if ($user->activation == $key){
 			//nutzer aktivierung
 			$user->activation = NULL;
 			if($this->Users->save($user)){
 				$this->Flash->success('Deine Email-Adresse wurde erfolgreich bestätigt. Du kannst dich jetzt einloggen.');
 				return $this->redirect(['action' => 'login']);
 			}
 		}
 		
 		//aktivierungs-key stimmt nicht mit info aus DB ueberein oder user konnte nicht gespeichert werden
 		$this->Flash->error('Bei der Bestätigung deiner Email-Adresse ist leider etwas schief gelaufen. Bitte versuche es später erneut.');
 		return $this->redirect(['action' => 'index']);
 	}
    
}
