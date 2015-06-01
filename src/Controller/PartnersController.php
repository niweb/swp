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
            if(in_array($this->request->action, ['index', 'add', 'view', 'edit', 'delete'])){
                $this->loadModel('UserHasTypes');
                $type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
                if($type == '3'){
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
            /*$this->paginate = [
                'contain' => ['Locations']
            ];
            $this->set('partners', $this->paginate($this->Partners));
            $this->set('_serialize', ['partners']);

            $this->loadModel('Users');
            $this->set('users', $this->paginate($this->Users));
            $this->set('_serialize', ['users']);*/

            $this->loadModel('UserHasTypes');
            $user = $this->Auth->user();
            $userType = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];

            if($userType == '4') {
                $this->paginate = ['contain' => ['Locations']];
                $partners = $this->Partners->findByLocationId($user['location_id'])->contain(['Users']);
                $this->set('partners', $this->paginate($partners));
                $this->set('_serialize', ['partners']);
            } else {
                $this->paginate = ['contain' => ['Locations']];
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
            $user = $this->Users->get($partner->user_id);
            $locations = $this->Partners->Locations->find('list', ['limit' => 200]);
            $this->set(compact('partner', 'locations', 'user'));
            $this->set('_serialize', ['partner', 'user']);
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
            if ($this->Partners->delete($partner)) {
                $this->Flash->success('Du bist jetzt kein Schuelerpate mehr. Wenn du deine Meinung aenderst bist du wieder willkommen.');
            } else {
                $this->Flash->error('The partner could not be deleted. Please, try again.');
            $this->request->allowMethod(['post', 'delete']);
            $partner = $this->Partners->get($id);
            }
            return $this->redirect(['action' => 'index']);
	}

public function register()
    {
        $partner = $this->Partners->newEntity();
        $userTable = TableRegistry::get('Users');
        $user = $userTable->newEntity();
        $userTypeTable = TableRegistry::get('UserHasTypes');
        $userType = $userTypeTable->newEntity();
        if ($this->request->is('post')) {
            $user->first_name = $this->request->data('user.first_name');
            $user->last_name = $this->request->data('user.last_name');
            $user->email = $this->request->data('user.email');
            $user->password = $this->request->data('user.password');
            $user->location_id = $this->request->data('user.location_id');
            $user->activation = rand(100000000,999999999);
            if($userTable->save($user)){
                $this->Flash->success('User gespeichert');
                $partner = $this->Partners->patchEntity($partner, $this->request->data, ['associated'=>'Users']);
                $partner->user_id = $user->id;
                $partner->location_id = $user->location_id;
                $userType->user_id = $user->id;
                $userType->type_id = 1;
                debug($partner);
                debug($userType);
                if (($this->Partners->save($partner)) && ($userTypeTable->save($userType))) {
                    $userController = new UsersController;
                    $userController->sendActivationMail($user->id);
                    $this->Flash->success('Deine Informationen wurden gespeichert. Danke!');
                    return $this->redirect(['controller'=>'Users','action' => 'login']);
                } else {
                    $userTable->delete($user);
                    $userTypeTable->delete($userType);
                    $this->Flash->error('Es ist leider etwas schief gelaufen. Bitte versuche es gleich noch einmal. (Partner oder UserTypes konnten nicht gespeichert werden)');
                }
            } else {
                $this->Flash->error('Es ist leider etwas schief gelaufen. Bitte versuche es gleich noch einmal. (User konnte nicht gespeichert werden)');
            }
        }

        $locations = $this->Partners->Locations->find('list', ['limit' => 10]);
        $this->set(compact('partner', 'locations'));
        $this->set('_serialize', ['partner']);
    }

}
