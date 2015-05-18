<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
	    if ($this->request->is('post')) {
	        $user = $this->Auth->identify();
	        if ($user) {
	            $this->Auth->setUser($user);
	            return $this->redirect($this->Auth->redirectUrl());
	        }
	        $this->Flash->error('Die E-Mail-Adresse oder das Passwort ist leider nicht richtig.');
	    }
	}
	
	public function logout()
	{
	    $this->Flash->success('You are now logged out.');
	    return $this->redirect($this->Auth->logout());
	}
	
	public function beforeFilter(\Cake\Event\Event $event)
	{
	    $this->Auth->allow('register');
	}
	
	public function register()
	{
		//registrierungsfunktion nur fuer paten!!!
		//vermittler/matchmaker/admins muessen sich ueber /users/add
		//von jemand anderem registrieren lassen
		
		$user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $user->type_id = 1;
            if ($this->Users->save($user)) {
            	//dazu gehoeriges partner-profil erstellen
                $partner = TableRegistry::get('Partners')->newEntity([
                	'user_id' => $user->id
                ]);
                $this->Flash->success('Du bist jetzt ein registrierter Schuelerpate! Gib am besten gleich ein paar Information an, damit wir dich mit Schuelern die deine Hilfe brauchen verbinden koennen!');
			    return $this->redirect(['controller' => 'Partners', 'action' => 'register', 'register_id' => $user->id]);
                }
            } else {
                $this->Flash->error('Bei deiner Registrierung ist wohl ein Fehler unterlaufen. Bitte probiere es gleich noch einmal.');
            }
        }
        $locations = $this->Users->Locations->find('list', ['limit' => 10]);
        $this->set(compact('user', 'locations'));
        $this->set('_serialize', ['user']);
	}
	
}
