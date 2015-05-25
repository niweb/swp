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
				//link ist nur fuer localhost bestimmt. wenn das projekt auf richtigem server lauft, so bitte hier den link aendern
				$link = 'http://localhost/schuelerpaten/users/activate/'.$user->id.'/'.$user->activation;
				$email = new Email('default');
				$email	->from(['noreply@schuelerpaten.de' => 'Schülerpaten'])
						->to($user->email)
						->subject('Aktivierungslink fuer deine Registrierung bei Schülerpaten')
						->send("Hallo ".$user->first_name."!<br><br>
            					Vielen Dank für deine Registrierung bei Schülerpaten!
            					Um deine Registrierung bei Schülerpaten abzuschliessen klicke bitte auf den folgenden Aktivierungslink:<br>
            					<a href='".$link."'>".$link."</a><br>
            					Sollte dieser nicht als Link erscheinen, so kannst du ihn auch in die Adresszeile deines Browsers kopieren.<br>
            					Nach der Aktivierung kannst du dich auf unserem Portal mit deiner Email-Adresse und dem von dir gewählten Passwort einloggen um deine Informationen ueber dich einzusehen oder zu ändern, deinen Vermittlungsstatus ansehen oder deine Registrierung rückgaengig machen.<br><br>
            					Mit freundlichen Grüßen,<br>
            					Dein Schülerpaten-Team");
				$this->Flash->success('Der Nutzer wurde gespeichert. Es wurde eine Aktivierungsmail an '.$user->email.' gesendet.');
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
				$this->Auth->setUser($user);
				$partner = $this->Partners->findByUserId($this->Auth->user('id'))->first();
				return $this->redirect($this->Auth->redirectUrl(['controller' => 'Partners', 'action' => 'view', $partner->id]));
			}
			$this->Flash->error('Die E-Mail-Adresse oder das Passwort ist leider nicht richtig.');
		}
	}

	public function logout()
	{
		$this->Flash->success('Du bist jetzt ausgeloggt.');
		return $this->redirect($this->Auth->logout());
	}

	public function register()
	{
		//registrierungsfunktion nur fuer paten!!!
		//vermittler/matchmaker/admins muessen sich ueber /users/add
		//von jemand anderem registrieren lassen
		//schueler muessen dies ueber students/add tun lassen

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
				//link ist nur fuer localhost bestimmt. wenn das projekt auf richtigem server lauft, so bitte hier den link aendern
				$link = 'http://localhost/schuelerpaten/users/activate/'.$user->id.'/'.$user->activation;
				//TODO Email funktioniert noch nicht
				$email = new Email('default');
				$email	->from(['noreply@schuelerpaten.de' => 'Schülerpaten'])
						->to($user->email)
						->subject('Aktivierungslink fuer deine Registrierung bei Schülerpaten')
						->send("Hallo ".$user->first_name."!\n\n
            					Vielen Dank für deine Registrierung bei Schülerpaten!
            					Um deine Registrierung bei Schülerpaten abzuschliessen klicke bitte auf den folgenden Aktivierungslink:\n
            					<a href='".$link."'>".$link."</a>\n
            					Sollte dieser nicht als Link erscheinen, so kannst du ihn auch in die Adresszeile deines Browsers kopieren.\n
            					Nach der Aktivierung kannst du dich auf unserem Portal mit deiner Email-Adresse und dem von dir gewählten Passwort einloggen um deine Informationen ueber dich einzusehen oder zu ändern, deinen Vermittlungsstatus ansehen oder deine Registrierung rückgaengig machen.\n\n
            					Mit freundlichen Grüßen,\n
            					Dein Schülerpaten-Team");
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
