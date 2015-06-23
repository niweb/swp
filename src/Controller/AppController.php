<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * @return void
	 */
	public function initialize()
	{
		$this->loadComponent('Flash');
			
		// Lade Authentifikations-Komponente
		// Setze 'Mail' und 'Password' Daten
		// Mache 'Users' fürs einloggen etc verantworlich
		// Login-Seite zu finden unter /users/login
		$this->loadComponent('Auth', [
                    'authorize' => ['Controller'],
                    'authenticate' => [
                        'Form' => [
                            'fields' => [
                                'password' => 'password',
                                'username' => 'email',
                            ]
                        ]
                    ],
                    'loginAction' => [
                        'controller' => 'Users',
                        'action' => 'login'
                    ]
                ]);
	        	 
	        	$this->Auth->allow(['dislay']);
				
				$this->setVariables();
	}
	
	public function setVariables(){
            $authUser = $this->Auth->user();
            $this->set('authUser', $authUser);
			
            switch($authUser['type_id']){
                case(5):
                    $admin = $authUser;
                    $this->set('admin', $admin);
                    break;
                case(4):
                    $locationAdmin = $authUser;
                    $this->set('locationAdmin', $locationAdmin);
                    break;
                case(3):
                    $vermittler = $authUser;
                    $this->set('vermittler', $vermittler);
                    break;
                case(2):
                    $matchmaker = $authUser;
                    $this->set('matchmaker', $matchmaker);
                    break;
                default:
                    $this->loadModel('Partners');
                    $authPartner = $this->Partners->findByUserId($this->Auth->user('id'))->first();
                    $this->set('authPartner', $authPartner);
                    break;
            }
		
            /*
            
            if($authUser) {
			$this->loadModel('UserHasTypes');
			$authUserType = $this->UserHasTypes->findByUserId($this->Auth->user('id'))->order(['type_id' => 'DESC'])->first()['type_id'];
			$this->set('authUserType', $authUserType);
            
            if($authUserType == '5') {
            
                    $admin = $authUser;
                    $this->set('admin', $admin);
            } else if($authUserType == '4'){
                    $locationAdmin = $authUser;
                    $this->set('locationAdmin', $locationAdmin);
            } else if($authUserType == '3') {
                    $vermittler = $authUser;
                    $this->set('vermittler', $vermittler);
            } else if($authUserType == '2') {
                    $matchmaker = $authUser;
                    $this->set('matchmaker', $matchmaker);
            } else {
                    $this->loadModel('Partners');
                    $authPartner = $this->Partners->findByUserId($this->Auth->user('id'))->first();
                    $this->set('authPartner', $authPartner);
            }
             */
	}

	public function beforeFilter(Event $event){
            
	}
	
	public function isAuthorized($user){
		$this->loadModel('UserHasTypes');
		$type = $this->UserHasTypes->findByUserId($user['id'])->order(['type_id' => 'DESC'])->first()['type_id'];
		if($type == '5' || $type == '4') {
			return true;
		}
		
		//$this->Flash->error('Permission denied');
		return false;
	}
}
