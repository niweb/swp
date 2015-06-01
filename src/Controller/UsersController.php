<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function isAuthorized($user){
        if(in_array($this->request->action, ['index','add'])){
            $this->loadModel('UserHasTypes');
            $type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
            if($type > '3'){
                    return true;
            }
        }
        if(in_array($this->request->action, ['edit', 'view'])){
            $actionId = (int)$this->request->params['pass'][0];
            if($this->Users->isTheSame($actionId, $user['id'])){
                return true;
            } else {
                $this->loadModel('UserHasTypes');
                $type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];
                if ($type = 5) {
                    return true;
                }
                elseif ($type = 4) {
                    $actionUser = $this->Users->get($id);
                    if($this->Users->isTheSame($actionUser['location_id'], $user['location_id'])){
                        return true;
                    }
                }
            }
        }
        return parent::isAuthorized($user);
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['logout', 'activate']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadModel('UserHasTypes');
        $user = $this->Auth->user();
        $userType = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];

        if($userType == '4'){
            $this->paginate = ['contain' => ['Locations']];
            $users = $this->Users->findByLocationId($user['location_id']);
            $this->set('users', $this->paginate($users));
            $this->set('_serialize', ['users']);
        } else {
            $this->paginate = ['contain' => ['Locations']];
            $this->set('users', $this->paginate($this->Users));
            $this->set('_serialize', ['users']);
        }
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
            'contain' => ['Locations']
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
            $this->loadModel('UserHasTypes');
            $user = $this->Users->newEntity();
            $userType = $this->UserHasTypes->newEntity();
            if ($this->request->is('post')) {
                    $user = $this->Users->patchEntity($user, $this->request->data);
                    $user->activation = NULL;
                    if ($this->Users->save($user)) {
                            $userType->user_id = $user->id;
                            $userType->type_id = $this->request->data['type_id'];
                            if($this->UserHasTypes->save($userType)) {
                                    $this->Flash->success('New Matchmaker created.');
                                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                            } else {
                                    $this->Users->delete($user);
                                    $this->Flash->error('The user could not be saved. Please, try again.');
                            }
                    } else {
                            $this->Flash->error('The user could not be saved. Please, try again.');
                    }
            }
            $this->loadModel('UserHasTypes');
            $type = $this->UserHasTypes->findByUserId($this->Auth->user('id'))->first()['type_id'];
            switch($type){
                case(4):
                    $typeConditions = ['id <' => '4', 'id !=' => '1']; //standortadmin darf keine standort admins oder global admins erstellen
                    $locationConditions = ['id =' => $this->Auth->user('location_id')]; //und auch nur
                    break;
                case(5):
                    $typeConditions = ['id <=' => '5', 'id !=' => '1']; //globaladmin darf alles erstellen
                    $locationConditions = ['id !=' => '-200']; //wert der nie erreicht wird
                    break;
                default: //auffangbedingung
                    $typeConditions = ['id <' => '0', 'id !=' => '1'];
                    $locationConditions = ['id <' => '0'];
                    break;
            }
            $this->loadModel('Types');
            $types = $this->Types->find('list', ['limit' => 200, 'empty' => false, 'conditions' => $typeConditions]);
            $locations = $this->Users->Locations->find('list', ['limit' => 200, 'empty' => false, 'conditions' => $locationConditions]);
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
        $types = $this->Users->Types->find('list', ['condition' => ['id' => '2', 'id' => '3']]);
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
            $this->loadModel('UserHasTypes');
            //get request
            if ($this->request->is('post')) {
                    $user = $this->Auth->identify();
                    if ($user) {
                            $this->Auth->setUser($user);
                            $type = $this->UserHasTypes->findByUserId($user['id'])->first()['type_id'];

                            /* unschön
                            if($type == '5' || $type == '4'){
                                    return $this->redirect($this->Auth->redirectUrl(['controller' => 'Users', 'action' => 'index']));
                            }*/				
                            if($this->Auth->user('activation') == NULL) {
                                $partner = $this->Partners->findByUserId($this->Auth->user('id'))->first();
                                if ($partner != null) { //user is partner
                                    return $this->redirect($this->Auth->redirectUrl(['controller' => 'Partners', 'action' => 'view', $partner->id]));
                                } else {        //user is no partner
                                                                            if($type <= 3) {
                                                                                    return $this->redirect($this->Auth->redirectUrl(['controller' => 'Students', 'action' => 'index']));
                                                                            }
                                    return $this->redirect($this->Auth->redirectUrl(['controller' => 'Users', 'action' => 'index']));
                                }
                            }
                            else {
                                $this->Flash->error('Der Account wurde noch nicht aktiviert! '
                                    . 'Bitte kontrolliere dein Email-Postfach und ggf. auch deinen Spam-Ordner.');
                                $this->Auth->logout();
                                //set $lastUserId, damit bestätigungsmail bei nächstem versuch versandt werden kann
                                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                            }
                    }
                    $this->Flash->error('Die E-Mail-Adresse oder das Passwort ist leider nicht richtig.');
            }
    }

    public function logout()
    {
            $this->Flash->success('Du bist jetzt ausgeloggt.');
            return $this->redirect($this->Auth->logout());
    }


    public function sendActivationMail($id=null)
    {
        $user = $this->Users->get($id);
        $link = 'http://52.28.79.204/users/activate/'.$id.'/'.$user->activation;
        $email = new Email('default');
        $email->from(['noreply@schuelerpaten.de' => 'Schülerpaten'])
            ->to($user->email)
            ->subject('Aktivierungslink für deine Registrierung bei Schülerpaten')
            ->emailFormat('html')
            ->template('activationMail')
            ->viewVars(['name' => $user->first_name, 'link' => $link])
            ->send();
        return;
    }

    public function sendActivationMailAgain($mail=null)
    {
        $user = $this->Users->findByEmail($mail)->first();
        if ($this->request->is('post')) {
            if ($user != null) {
                sendActivationMail($user['id']);
                $this->Flash->success('Die Bestätigungsmail mit dem Aktivierngslink wurde erneut an '.$mail.' gesendet.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Diese Email-Adresse ist nicht bei uns registriert.');
            }
        }
    }

    public function activate($id = null, $key = null)
    {
        $user = $this->Users->get($id);
        if(!$user){
                //nutzer existiert nicht
                $this->Flash->error('Der Nutzer mit id '. $id. ' existiert nicht');
                return $this->redirect(['action' => 'login']);	
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
