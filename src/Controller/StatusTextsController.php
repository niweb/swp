<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StatusTexts Controller
 *
 * @property \App\Model\Table\StatusTextsTable $StatusTexts
 */
class StatusTextsController extends AppController
{

	public function isAuthorized($user) {
		$type = $user['type_id'];
		if(in_array($this->request->action, ['index'])){
			if($type > '3') {
				return true;
			}
		}
		
		if(in_array($this->request->action, ['view', 'edit'])){
			if($type > '3'){
				$statusTextID = (int)$this->request->params['pass'][0];
				$statusText = $this->StatusTexts->get($statusTextID);
				if($statusText['location_id'] == $user['location_id']){
					return true;
				}
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
        $this->paginate = [
            'contain' => ['Status']
        ];
		
		$status = $this->StatusTexts->find('all', ['conditions' => ['location_id' => $this->Auth->user('location_id')]]);
        $this->set('statusTexts', $this->paginate($status));
        $this->set('_serialize', ['statusTexts']);
    }

    /**
     * View method
     *
     * @param string|null $id Status Text id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statusText = $this->StatusTexts->get($id, [
            'contain' => ['Locations', 'Status']
        ]);
        $this->set('statusText', $statusText);
        $this->set('_serialize', ['statusText']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $statusText = $this->StatusTexts->newEntity();
        if ($this->request->is('post')) {
            $statusText = $this->StatusTexts->patchEntity($statusText, $this->request->data);
			$statusText->location_id = $this->Auth->user('location_id');
            if ($this->StatusTexts->save($statusText)) {
                $this->Flash->success('The status text has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The status text could not be saved. Please, try again.');
            }
        }
        $status = $this->StatusTexts->Status->find('list', ['limit' => 200]);
        $this->set(compact('statusText', 'status'));
        $this->set('_serialize', ['statusText']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Status Text id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $statusText = $this->StatusTexts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $statusText = $this->StatusTexts->patchEntity($statusText, $this->request->data);
            if ($this->StatusTexts->save($statusText)) {
                $this->Flash->success('The status text has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The status text could not be saved. Please, try again.');
            }
        }
        $status = $this->StatusTexts->Status->find('list', ['limit' => 200]);
        $this->set(compact('statusText', 'status'));
        $this->set('_serialize', ['statusText']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Status Text id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statusText = $this->StatusTexts->get($id);
        if ($this->StatusTexts->delete($statusText)) {
            $this->Flash->success('The status text has been deleted.');
        } else {
            $this->Flash->error('The status text could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
