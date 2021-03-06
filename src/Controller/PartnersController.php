<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
		if ($this->request->is(['patch', 'post', 'put'])) {
			$partner = $this->Partners->patchEntity($partner, $this->request->data);
			if ($this->Partners->save($partner)) {
				$this->Flash->success('The partner has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The partner could not be saved. Please, try again.');
			}
		}
		
		$this->loadModel('Users');
		$user = $this->Users->get($partner->user_id);
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

	public function register($register_id = null, $location_id = null)
	{
		//TODO partnerprofil wird nur angelegt, wenn user auf submit drueckt!
		$partner = $this->Partners->newEntity();
		$userTable = TableRegistry::get('Users');
		if ($this->request->is('post')) {
			$partner = $this->Partners->patchEntity($partner, $this->request->data);
			$partner->user_id = $register_id;
			$partner->location_id = $location_id;
			$user = $userTable->get($register_id);
			$user->first_name = $this->request->data('name');
			$user->last_name = $this->request->data('lastname');
			if ($this->Partners->save($partner) && $userTable->save($user)) {
				$this->Flash->success('Deine Informationen wurden gespeichert. Danke!');
				//hier nachher aufs userprofil umleiten!
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('Es ist leider etwas schief gelaufen. Bitte versuche es gleich noch einmal.');
			}
		}
		$locations = $this->Partners->Locations->find('list', ['limit' => 10]);
		$this->set(compact('partner', 'locations'));
		$this->set('_serialize', ['partner']);
	}

}
