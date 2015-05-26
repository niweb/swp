<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;

/**
 * Partners Controller
 *
 * @property \App\Model\Table\PartnersTable $Partners
 */
class PartnersController extends AppController
{

	/**
	 * Index method
	 *
	 * @return void
	 */
	public function index()
	{
		/*$this->paginate = [
            'contain' => ['Locations']
		];
		$this->set('partners', $this->paginate($this->Partners));
		$this->set('_serialize', ['partners']);
		
		$this->loadModel('Users');
		$this->set('users', $this->paginate($this->Users));
		$this->set('_serialize', ['users']);*/

		$this->paginate = ['contain' => ['Locations']];
		$partners = $this->Partners->find('all')->contain(['Users']);
		$this->set('partners', $this->paginate($partners));
		$this->set('_serialize', ['partners']);
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
            'contain' => ['Locations', 'PreferredClassranges', 'PreferredSchooltypes', 'PreferredSubjects', 'Tandems']
		]);
		$this->set('partner', $partner);
		$this->set('_serialize', ['partner']);

		$this->loadModel('Users');
		$user = $this->Users->get($partner->user_id);
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
		$partner = $this->Partners->newEntity();
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
		$this->set('_serialize', ['partner']);
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
		$userTable = TableRegistry::get('Users');
		if ($this->request->is(['patch', 'post', 'put'])) {
			$partner = $this->Partners->patchEntity($partner, $this->request->data);
			$user = $userTable->get($partner->user_id);
			$user->first_name = $this->request->data('user.first_name');
			$user->last_name = $this->request->data('user.last_name');
			if ($this->Partners->save($partner) && $userTable->save($user)) {
				$this->Flash->success('The partner has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The partner could not be saved. Please, try again.');
			}
		}
		$user = $userTable->get($partner->user_id);
		$locations = $this->Partners->Locations->find('list', ['limit' => 200]);
		$this->set(compact('partner', 'locations', 'user'));
		$this->set('_serialize', ['partner']);
	}

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
			$this->Flash->success('Du bist jetzt kein Schuelerpate mehr. Wenn du deine Meinung aenderst bist du wieder willkommen.');
		} else {
			$this->Flash->error('The partner could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}

public function register()
	{
		//TODO partnerprofil wird nur angelegt, wenn user auf submit drueckt!
		$partner = $this->Partners->newEntity();
		$userTable = TableRegistry::get('Users');
		$user = $userTable->newEntity();
		$userTypeTable = TableRegistry::get('UserHasTypes');
		$userType = $userTypeTable->newEntity();
		if ($this->request->is('post')) {
			$user->set(
		['first_name'=>$this->request->data('user.first_name'),
		 'last_name'=>$this->request->data('user.last_name'),
		 'email'=>$this->request->data('user.email'),
		 'password'=>$this->request->data('user.password'),
		 'location_id'=>$this->request->data('user.location_id')]);
			$user->activation = rand(100000000,999999999);
			if($userTable->save($user)){
				$this->Flash->success('User gespeichert');
				$partner = $this->Partners->patchEntity($partner, $this->request->data, ['associated'=>'Users']);
				$partner->user_id = $user->id;
				$partner->location_id = $user->location_id;
				$userType->user_id = $user->id;
				$userType->type_id = 1;
				if ($this->Partners->save($partner) && $userTypeTable->save($userType)) {
					$link = 'http://localhost/swp/users/activate/'.$user->id.'/'.$user->activation;
					$email = new Email('default');
					$email	->from(['noreply@schuelerpaten.de' => 'Schülerpaten'])
					->to($user->email)
					->subject('Aktivierungslink fuer deine Registrierung bei Schülerpaten')
					->send("Hallo ".$user->first_name."!\n\n
            					Vielen Dank für deine Registrierung bei Schülerpaten!
            					Um deine Registrierung bei Schülerpaten abzuschliessen klicke bitte auf den folgenden Aktivierungslink:\n
            					<a href=\"".$link."\">".$link."</a>\n
            					Sollte dieser nicht als Link erscheinen, so kannst du ihn auch in die Adresszeile deines Browsers kopieren.\n
            					Nach der Aktivierung kannst du dich auf unserem Portal mit deiner Email-Adresse und dem von dir gewählten Passwort einloggen um deine Informationen ueber dich einzusehen oder zu ändern, deinen Vermittlungsstatus ansehen oder deine Registrierung rückgaengig machen.\n\n
            					Mit freundlichen Grüßen,\n
            					Dein Schülerpaten-Team");
					$this->Flash->success('Deine Informationen wurden gespeichert. Danke!');
					//hier nachher aufs userprofil umleiten!
					return $this->redirect(['action' => 'view', $partner->id]);
				} else {
					$userTable->delete($user);
					$this->Flash->error('Es ist leider etwas schief gelaufen. Bitte versuche es gleich noch einmal.');
				}
			} else {
				$this->Flash->error('Es ist leider etwas schief gelaufen. Bitte versuche es gleich noch einmal.');
			}
		}
		$locations = $this->Partners->Locations->find('list', ['limit' => 10]);
		$this->set(compact('partner', 'locations'));
		$this->set('_serialize', ['partner']);
	}

}
