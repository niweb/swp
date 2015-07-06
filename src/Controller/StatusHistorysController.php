<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StatusHistorys Controller
 *
 * @property \App\Model\Table\StatusHistorysTable $StatusHistorys
 */
class StatusHistorysController extends AppController
{

	public function isAuthorized($user){
		$type = $user['type_id'];
		
		if(in_array($this->request->action, ['add'])){
			if($type > '2'){
				$this->loadModel('Partners');
				$partnerID = (int)$this->request->params['pass'][0];
				$partner = $this->Partners->get($partnerID);
				if($partner->location_id == $user['location_id']){
					return true;
				}
			}
		}
                
                elseif(in_array($this->request->action, ['setNote'])){
                    if($type > '2'){
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
        $this->paginate = [
            'contain' => ['Partners', 'Status']
        ];
        $this->set('statusHistorys', $this->paginate($this->StatusHistorys));
        $this->set('_serialize', ['statusHistorys']);
    }

    /**
     * View method
     *
     * @param string|null $id Status History id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statusHistory = $this->StatusHistorys->get($id, [
            'contain' => ['Partners', 'Status']
        ]);
        $this->set('statusHistory', $statusHistory);
        $this->set('_serialize', ['statusHistory']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($partnerID = null)
    {
        $statusHistory = $this->StatusHistorys->newEntity();
        if ($this->request->is('post')) {
            $statusHistory->partner_id = $partnerID;
            $statusHistory->timestamp = time();
            $statusHistory = $this->StatusHistorys->patchEntity($statusHistory, $this->request->data);
            if ($this->StatusHistorys->save($statusHistory)) {
                $this->Flash->success('The status history has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The status history could not be saved. Please, try again.');
            }
        }
		
		$currStatus = $this->StatusHistorys->find('all', ['order' => ['timestamp' => 'DESC']])->where(['partner_id' => $partnerID])->first();
		
        $status = $this->StatusHistorys->Status->find('list', ['limit' => 200]);
        $this->set(compact('statusHistory', 'partners', 'status', 'currStatus'));
        $this->set('_serialize', ['statusHistory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Status History id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $statusHistory = $this->StatusHistorys->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $statusHistory = $this->StatusHistorys->patchEntity($statusHistory, $this->request->data);
            if ($this->StatusHistorys->save($statusHistory)) {
                $this->Flash->success('The status history has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The status history could not be saved. Please, try again.');
            }
        }
        $partners = $this->StatusHistorys->Partners->find('list', ['limit' => 200]);
        $statuses = $this->StatusHistorys->Status->find('list', ['limit' => 200]);
        $this->set(compact('statusHistory', 'partners', 'statuses'));
        $this->set('_serialize', ['statusHistory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Status History id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statusHistory = $this->StatusHistorys->get($id);
        if ($this->StatusHistorys->delete($statusHistory)) {
            $this->Flash->success('The status history has been deleted.');
        } else {
            $this->Flash->error('The status history could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function setNote($id = null)
    {
        $statusHistory = $this->StatusHistorys->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $statusHistory = $this->StatusHistorys->get($id);
            $statusHistory->text = $this->request->data['text'];
            if ($this->StatusHistorys->save($statusHistory)) {
                $this->Flash->success('The status note has been saved.');
                return $this->redirect(['controller'=>'Partners','action' => 'view', $statusHistory->partner_id]);
            } else {
                $this->Flash->error('The status note could not be saved. Please, try again.');
            }
        }
        $this->set(compact('statusHistory'));
        $this->set('_serialize', ['statusHistory']);
    }
}
