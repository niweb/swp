<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Event\Event;
use Cake\I18n\Time;

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

        $type = $user['type_id'];
        if($type == 5){
            return true;
        }

        if(in_array($this->request->action, ['view', 'edit'])){
            $partnerID = (int)$this->request->params['pass'][0];
            if($this->Partners->isTheSame($partnerID, $user['id'])){
                return true;
            }
        }
        if(in_array($this->request->action, ['index'])){
            if($type > '1') {
                return true;
            }
        }
        if(in_array($this->request->action, ['view'])){
            if($type > '1'){
                $location = $this->Auth->user('location_id');
                $partnerID = (int)$this->request->params['pass'][0];
                $partnerLocation = $this->Partners->get($partnerID)->location_id;
                if($location == $partnerLocation){
                        return true;
                }
            }
        }
        if(in_array($this->request->action, ['match'])){
            if($type > '1'){
                $location = $this->Auth->user('location_id');
                $partnerID = (int)$this->request->params['pass'][0];
                $partner = $this->Partners->get($partnerID);
                if($location == $partner->location_id && $partner->status_id < 7){
                        return true;
                }
            }
        }
        if(in_array($this->request->action, ['edit', 'deactivate', 'contact'])){
            if($type > '2'){
                $location = $this->Auth->user('location_id');
                $partnerID = (int)$this->request->params['pass'][0];
                $partnerLocation = $this->Partners->get($partnerID)->location_id;
                if($location == $partnerLocation){
                        return true;
                }
            }
        }
        if(in_array($this->request->action, ['status'])){
            if($type > '2'){
                $location = $this->Auth->user('location_id');
                $partnerID = (int)$this->request->params['pass'][0];
                $partner = $this->Partners->get($partnerID);
                if($location == $partner->location_id && $partner->status_id < 8){
                        return true;
                }
            }
        }
        if(in_array($this->request->action, ['add'])){
            if($type > '2'){
                return true;
            }
        }
        if(in_array($this->request->action, ['reactivate'])){
            if($type > '3'){
                $location = $this->Auth->user('location_id');
                $partnerID = (int)$this->request->params['pass'][0];
                $partnerLocation = $this->Partners->get($partnerID)->location_id;
                if($location == $partnerLocation){
                        return true;
                }
            }
        }
        if(in_array($this->request->action, ['delete'])){
            if($type > '3'){
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @param string|null $view welche paten werden angezeigt - 'all', 'verified', 'waiting', 'active', 'inactive'.
     * @return void
     */
    public function index($view=null)
    {
        /*$this->paginate = [
            'contain' => ['Locations']
        ];
        $this->set('partners', $this->paginate($this->Partners));
        $this->set('_serialize', ['partners']);

        $this->loadModel('Users');
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);*/

        switch($view){
            case 'all':
                //alle alle
                $condition = [];
                break;
            case 'verified':
                //alle ab verifiziert
                $condition = ['status_id >=' => 2];
                break;
            case 'waiting':
                //alle wartenden
                $condition = ['status_id =' => 5];
                break;
            case 'active':
                //alle wartenden und vermittelten
                $condition = ['status_id >=' => 5, 'status_id <=' => 6];
                break;
            case 'inactive':
                //alle aufgehört und abgelehnten
                $condition = ['status_id >=' => 7, 'status_id <=' => 8];
                break;
            default:
                if($this->Auth->user['type_id']<3){ //matchmaker
                    $view = 'waiting';
                    $condition = ['status_id =' => 5];
                } else {
                    $view = 'active';
                    $condition = ['status_id >=' => 5, 'status_id <=' => 6];
                }
        }

        $this->loadModel('UserHasTypes');
        $user = $this->Auth->user();
        $userType = $user['type_id'];

        if($userType > '1' && $userType < '5') { //matchmaker, vermittler & standortadmin
            $condition['Users.location_id ='] = $user['location_id'];
            $this->paginate = ['contain' => ['Locations', 'Users', 'Status'], 'order' => ['status_id' => 'asc'], 'sortWhitelist' => ['status_id', 'Users.first_name', 'Users.last_name', 'age', 'sex']];
            $partners = $this->Partners->find('all', ['limit' => 500, 'conditions' => $condition])->contain(['Users', 'Status']);
        } else {
            //unwichtig weil globadmin eigentlich nie paten sieht
            $this->paginate = ['contain' => ['Locations', 'Users', 'Status']];
            $partners = $this->Partners->find('all')->contain(['Users', 'Status']);
        }
        $this->set(compact('view'));
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
            'contain' => ['PreferredClassranges.Classranges', 'PreferredSchooltypes.Schooltypes', 'PreferredSubjects.Subjects', 'Tandems.Students', 'Status', 'Users']
        ]);

        $this->loadModel('StatusTexts');
        $statusText = $this->StatusTexts->findByStatusId($partner->status_id)->first();

        $this->loadModel('StatusHistorys');
        $statusHistory = $this->StatusHistorys->find('all',[
                    'order' => ['timestamp' => 'DESC'],
                    'contain' => ['Status']
            ])
                ->where(['partner_id' => $partner->id]);
        $statHis = $statusHistory->toArray();

        $this->set(compact('partner', 'statusText', 'statHis'));
        $this->set('_serialize', ['partner', 'statusText', 'statHis']);

        /*$this->loadModel('Users');
        $user = $this->Users->get($partner->user_id);

        $this->set('user', $user);
        $this->set('_serialize', ['user']); */
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /*$partner = $this->Partners->newEntity();
                    $user = $this->Auth->user();
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
        $this->set('_serialize', ['partner']);*/

        return $this->redirect(['action' => 'register']);
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
                    'contain' => ['Users', 'PreferredClassranges', 'PreferredSchooltypes', 'PreferredSubjects']
            ]);
            $this->loadModel('Users');
            if ($this->request->is(['patch', 'post', 'put'])) {
                    $partner = $this->Partners->patchEntity($partner, $this->request->data);
                    $user = $this->Users->get($partner->user_id);
                    $user->first_name = $this->request->data('user.first_name');
                    $user->last_name = $this->request->data('user.last_name');
                    if ($this->Partners->save($partner) && $this->Users->save($user)) {

                            $this->loadModel('PreferredClassranges');				
                            foreach(($this->request->data('preferredClassranges')) as $classrangeId => $checked) {
                                    $pClassrange = $this->PreferredClassranges->find()->where(['classrange_id' => $classrangeId, 'partner_id' => $partner->id])->first();
                                    if($checked == '1') {
                                            if($pClassrange == null){
                                                    $pClassrange = $this->PreferredClassranges->newEntity();
                                                    $pClassrange->partner_id = $partner->id;
                                                    $pClassrange->classrange_id = $classrangeId;
                                                    $this->PreferredClassranges->save($pClassrange);
                                            }
                                    } else if($pClassrange != null){
                                            $this->PreferredClassranges->delete($pClassrange);
                                    }
                            }

                            $this->loadModel('PreferredSchooltypes');
                            foreach(($this->request->data('preferredSchooltypes')) as $schooltypeId => $checked){
                                    $pSchooltype = $this->PreferredSchooltypes->find()->where(['schooltype_id' => $schooltypeId, 'partner_id' => $partner->id])->first();
                                    if($checked == '1'){
                                            if($pSchooltype == null) {
                                                    $pSchooltype = $this->PreferredSchooltypes->newEntity();
                                                    $pSchooltype->partner_id = $partner->id;
                                                    $pSchooltype->schooltype_id = $schooltypeId;
                                                    $this->PreferredSchooltypes->save($pSchooltype);
                                            }
                                    } else if($pSchooltype != null){
                                            $this->PreferredSchooltypes->delete($pSchooltype);
                                    }
                            }

                            $this->loadModel('PreferredSubjects');
                            foreach(($this->request->data('preferredSubjects')) as $subjectId => $gradeLimit){
                                    debug($gradeLimit);
                                    $pSubject = $this->PreferredSubjects->find()->where(['subject_id' => $subjectId, 'partner_id' => $partner->id])->first();
                                    if(($gradeLimit != 0) AND ($gradeLimit != null)){
                                            if($pSubject == null) {
                                                    $pSubject = $this->PreferredSubjects->newEntity();
                                                    $pSubject->partner_id = $partner->id;
                                                    $pSubject->subject_id = $subjectId;
                                                    $pSubject->maximum_class = $gradeLimit;
                                                    $this->PreferredSubjects->save($pSubject);
                                            } else {
                                                    $pSubject->maximum_class = $gradeLimit;
                                                    $this->PreferredSubjects->save($pSubject);
                                            }
                                    } else{
                                            if($pSubject != null){
                                                    $this->PreferredSubjects->delete($pSubject);
                                            }
                                    }
                            }

                            $this->Flash->success(__('The partner has been saved.'));
                            return $this->redirect(['action' => 'view', $partner->id]);
                    } else {
                            $this->Flash->error(__('The partner could not be saved. Please, try again.'));
                    }
            }

    $this->loadModel('Classranges');
    $classranges = $this->Classranges->find('all');

    $this->loadModel('Schooltypes');
    $schooltypes = $this->Schooltypes->find('all')
            ->where(['location_id =' => $this->Auth->user('location_id')]);

    $this->loadModel('Subjects');
    $subjects = $this->Subjects->find('all')
            ->where(['location_id =' => $this->Auth->user('location_id')]);

    $type = $this->Auth->user('type_id');
    $user = $this->Users->get($partner->user_id);
    $status = $this->Partners->Status->find('list', ['limit' => 200]);
    $checked = false;
    $tmpsubject = '';
    $this->set(compact('partner', 'user', 'status', 'type', 'classranges', 'schooltypes', 'subjects', 'checked', 'tmpsubject'));
    $this->set('_serialize', ['partner', 'user']);
    }

    /*public function deactivate($id = null){
            $this->request->allowMethod(['post', 'deactivate']);
            $partner = $this->Partners->get($id);

    }*/
	
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
            $userID = $partner->user_id;
            
            if(($partner->status_id > 1) AND ($partner->status_id < 7)){
                $this->Flash->error('Der Pate muss vor der Löschung erst deaktiviert werden.');
                $this->redirect($this->referer(['action' => 'index']));
            }
            
            if ($this->Partners->delete($partner)) {
                $this->loadModel('PreferredClassranges');
                $this->loadModel('PreferredSchooltypes');
                $this->loadModel('PreferredSubjects');
                $this->loadModel('StatusHistory');
                $this->loadModel('Users');
                $this->loadModel('Tandems');
                $this->PreferredClassranges->deleteAll(['partner_id' => $id]);
                $this->PreferredSchooltypes->deleteAll(['partner_id' => $id]);
                $this->PreferredSubjects->deleteAll(['partner_id' => $id]);
                $this->StatusHistorys->deleteAll(['partner_id' => $id]);
                $this->Users->deleteAll(['id' => $userID]);
                $this->Tandems->deleteAll(['partner_id' => $id]);

                $this->Flash->success('Pate wurde gelöscht');
            } else {
                $this->Flash->error('Pate konnte nicht gelöscht werden');
            }
            return $this->redirect(['action' => 'index', 'inactive']);
    }

    public function deactivate($id = null){
        $partner = $this->Partners->get($id,[
                'contain' => ['Tandems']
            ]);
        
        if($partner->status_id == 1){
            $this->Flash->error('Nicht verifizierte Paten können nicht deaktiviert werden.');
            return $this->redirect($this->referer(['action' => 'index']));
        }
        
        //alle tandems in denen der pate steckt werden ebenfalls deaktiviert
        $tandemsController = new TandemsController;
        foreach($partner->tandems as $tandem){
            $tandemsController->deactivate($tandem->id);
        }
        
        //setze status_id auf 'aufgehört'
        $this->setStatus($id,7);
        
        if($this->Partners->save($partner)){
            $this->Flash->success('Pate wurde erfolgreich deaktiviert.');
        } else {
            $this->Flash->error('Pate konnte nicht deaktiviert werden.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

    public function reactivate($id = null){
        $partner = $this->Partners->get($id);
        if($partner->status_id == 7){
            //wenn 'aufgehört' ist anzunehmen, dass er wieder warten möchte
            $this->setStatus($id,5);
        } else {
            //wenn abgelehnt, wissen wir nicht an welchem punkt der pate schon war
            // - deshalb wieder verifiziert
            $this->setStatus($id,2);
        }
        if($this->Partners->save($partner)){
            $this->Flash->success('Pate wurde erfolgreich reaktiviert.');
        } else {
            $this->Flash->error('Pate konnte nicht reaktiviert werden.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

    public function register($loc = null) /* location-id */
        {
            $partner = $this->Partners->newEntity();
            $userTable = TableRegistry::get('Users');
            $user = $userTable->newEntity();

            if ($this->request->is('post')) {

                //user-eintrag
                $user->first_name = $this->request->data('user.first_name');
                $user->last_name = $this->request->data('user.last_name');
                $user->email = $this->request->data('user.email');
                $user->password = $this->request->data('user.password');
                $user->type_id = 1;
                $user->location_id = $loc;
                $user->activation = rand(100000000,999999999);
                $userSaved = $userTable->save($user);

                //user must be checked if saved first b/c partner needs user->id
                if($userSaved){
                    //partner-eintrag
                    $partner = $this->Partners->patchEntity($partner, $this->request->data()/*, ['associated'=>'Users']*/);
                    $partner->user_id = $user->id;
                    $partner->location_id = $loc;
                    $partner->status_id = 1;        //initialized status_id -> achtung bei db-änderungen
                    $partnerSaved = $this->Partners->save($partner);
                    //userhastypes-eintrag
                    $userTypeTable = TableRegistry::get('UserHasTypes');
                    $userType = $userTypeTable->newEntity();
                    $userType->user_id = $user->id;
                    $userType->type_id = 1;
                    $userTypeSaved = $userTypeTable->save($userType);

                    if($partnerSaved){
                        //preferredclassranges-eintrag
                        $pClassrangesTable = TableRegistry::get('PreferredClassranges');
                        $allPClassrangesSaved = true;
                        foreach(($this->request->data('preferredClassranges')) as $classrangeId => $checked){
                            if($checked == '1'){
                                $pClassrange = $pClassrangesTable->newEntity();
                                $pClassrange->partner_id = $partner->id;
                                $pClassrange->classrange_id = $classrangeId;
                                $pClassrangeSaved = $pClassrangesTable->save($pClassrange);
                                if ($allPClassrangesSaved) { $allPClassrangesSaved = $pClassrangeSaved ? true : false; }
                            }
                        }

                        //preferredschooltypes-eintrag
                        $pSchooltypesTable = TableRegistry::get('PreferredSchooltypes');
                        $allPSchooltypesSaved = true;
                        foreach(($this->request->data('preferredSchooltypes')) as $schooltypeId => $checked){
                            if($checked == '1'){
                                $pSchooltype = $pSchooltypesTable->newEntity();
                                $pSchooltype->partner_id = $partner->id;
                                $pSchooltype->schooltype_id = $schooltypeId;
                                $pSchooltypeSaved = $pSchooltypesTable->save($pSchooltype);
                                if ($allPSchooltypesSaved) { $allPSchooltypesSaved = $pSchooltypeSaved ? true : false; }
                            }
                        }

                        //preferredsubjects-eintrag
                        $pSubjectsTable = TableRegistry::get('PreferredSubjects');
                        $allPSubjectsSaved = true;
                        foreach(($this->request->data('preferredSubjects')) as $subjectId => $gradeLimit){
                            if(($gradeLimit != 0) AND ($gradeLimit != null)){
                                $pSubject = $pSubjectsTable->newEntity();
                                $pSubject->partner_id = $partner->id;
                                $pSubject->subject_id = $subjectId;
                                $pSubject->maximum_class = $gradeLimit;
                                $pSubjectSaved = $pSubjectsTable->save($pSubject);
                                if($allPSubjectsSaved) { $allPSubjectsSaved = $pSubjectSaved ? true : false; }
                            }
                        }

                        $allPreferencesSaved = $allPClassrangesSaved AND $allPSchooltypesSaved AND $allPSubjectsSaved;

                        //add preferredSubjects: überprüfung ob maximum_class empty oder 0
                        if ($allPreferencesSaved) {
                            //everything saved? then send activationMail
                            $userController = new UsersController;
                            $userController->sendActivationMail($user->id);
                            if(isset($authUser)){
                                $this->Flash->success('Der Pate wurde registriert und erhält nun eine Aktivierungsmail.');
                                return $this->redirect($this->request->referer());
                            }
                            $this->Flash->success('Deine Informationen wurden gespeichert. Danke!');
                            return $this->redirect(['controller'=>'Users','action' => 'login']);
                        } else {
                            //otherwise delete everything!
                            $this->loadModel('PreferredClassranges');
                            $this->loadModel('PreferredSchooltypes');
                            $this->loadModel('PreferredSubjects');
                            $this->Partners->delete($partner);
                            $this->PreferredClassranges->deleteAll(['partner_id' => $partner['id']]);
                            $this->PreferredSchooltypes->deleteAll(['partner_id' => $partner['id']]);
                            $this->PreferredSubjects->deleteAll(['partner_id' => $partner['id']]);

                            $this->Flash->error('Es ist leider ein Fehler aufgetreten. Bitte überprüfe deine Eingaben und probiere es gleich noch einmal.');
                        }
                    }else {

                        $userTable->delete($user);
                        $this->Partners->delete($partner);
                        $userTypeTable->delete($userType);

                        $this->Flash->error('Es ist leider etwas schief gelaufen. Vermutlich wurden im Formular ungültige Angaben gemacht. Bitte kontrolliere dies. Wenn dem nicht so ist und das Problem dennoch weiterhin besteht kontaktiere uns bitte!');
                    }
                }else {
                    $this->Flash->error('Es ist leider etwas schief gelaufen. Vermutlich bist du bereits unter dieser Email-Adresse bei uns registriert. Bitte versuche es gleich noch einmal. Wenn dem nicht so ist und das Problem dennoch weiterhin besteht kontaktiere uns bitte!');
                }
            } 

        //set variables for view
        
        $this->loadModel('Locations');
        $all_locations = $this->Locations->find('all')->toArray();
        $location_name = $this->Locations->findById($loc)->first()['name'];
        
        $this->loadModel('Classranges');
        $classranges = $this->Classranges->find('all');
        
        $this->loadModel('Schooltypes');
        $schooltypes = $this->Schooltypes->find('all')
                ->where(['location_id =' => $loc]);
        
        $this->loadModel('Subjects');
        $subjects = $this->Subjects->find('all')
                ->where(['location_id =' => $loc]);
        
        $this->set(compact('partner', 'all_locations', 'location_name', 'classranges', 'schooltypes', 'subjects'));
        $this->set('_serialize', ['partner']);
    }

    
    public function match($partnerId = null, $studentId = null){
        if($partnerId == null){
            //wenn partner id = null, dann noch nicht im matching
            //also redirect zu index, damit matcher paten auswählen kann
            $this->redirect(['action' => 'index']);
        }
        else if($studentId == null){
            //wenn partnerId != null, aber studentid == null, so wurde schon ein pate
            //ausgewählt, aber noch kein passender schüler dazu
            //nur hier werden Daten im view gebraucht, die werden hier gesetzt
            
            $partner = $this->Partners->get($partnerId, [
                'contain' => ['Users', 'PreferredClassranges.Classranges', 'PreferredSchooltypes.Schooltypes', 'PreferredSubjects.Subjects', 'Status']
                ]);
            $this->loadModel('Students');
            $students = $this->Students
                    ->find('all', [
                        'contain' => ['StudentSubjects.Subjects', 'StudentClassranges.Classranges', 'Schooltypes', 'StudentStatus'],
                        'conditions' => ['student_status_id =' => 1]
                        ])
                    ->where(['Students.location_id =' => $partner['location_id']]);
            
            //matchingkriterien des partners auslesen
            $preferredGender = $partner->preferred_gender;
            
            $prefClassranges = $partner->preferred_classranges;
            foreach($prefClassranges as $clrange){
                $preferredClassranges[] = $clrange['classrange_id'];
            }
            
            $prefSchooltypes = $partner->preferred_schooltypes;
            foreach($prefSchooltypes as $type){
                $preferredSchooltypes[] = $type['schooltype_id'];
            }
            
            $prefSubjects = $partner->preferred_subjects;
            foreach($prefSubjects as $subj){
                $preferredSubjects[] = ['id' => $subj['subject_id'], 'max_grade' => $subj['maximum_class']];
            }
            //matching für jeden schüler einzeln
            foreach($students as $student){
                //für jeden schüler eine matchpoint-zahl ausrechnen, die angibt,
                //wie gut ein schüler zum paten passt
                $match = [
                    'points' => 0,
                    'maxpoints' => 0,
                    'percentage' => 0.0,
                    'gender' => false,
                    'classrange' => false,
                    'schooltype' => false,
                    'subjects' => false,
                    ];
                
                //gender == preferredgender?
                $studentGender = $student->sex;
                if($preferredGender == '' OR $preferredGender == $studentGender) {
                    $match['points']++;
                    $match['gender'] = true;
                }
                
                $match['maxpoints']++;
                
                //classrange is in preferred_classranges?
                $studentClassrange = $student->student_classrange->classrange;
                if (in_array($studentClassrange['id'],$preferredClassranges)){
                    $match['points']++;
                    $match['classrange'] = true;
                }
                
                $match['maxpoints']++;
                
                //schooltype is in preferred_schooltypes?
                $studentSchooltype = $student['schooltype_id'];
                if (in_array($studentSchooltype,$preferredSchooltypes)){
                    $match['points']++;
                    $match['schooltype'] = true;
                }
                
                $match['maxpoints']++;
                
                $studentSubjects = [$student->student_subject->subject1, $student->student_subject->subject2, $student->student_subject->subject3];
                $checkedSubjects = [];
                foreach($studentSubjects as $subj){
                    //alle 3 Fächer nacheinander abgleichen
                    if(!in_array($subj,$checkedSubjects)){
                        //checkedSubjects enthält alle bereits enthaltenen Fächer
                        //kann raus, wenn in Student subject1/2/3 nicht gleich aber null sein darf
                        //verhindert zuviele matchpoints
                        
                        //für jedes student_subject  wird jetzt überprüft ob
                        //es ein passendes preferred_subject des paten gibt,
                        //das der pate auch in der klassenstufe des schülers
                        //unterrichten könnte (max_grade)
                        foreach($preferredSubjects as $prefSubj){
                            if(($subj == $prefSubj['id']) AND ($studentClassrange['name'] <= $prefSubj['max_grade'])){
                                $match['points']++;
                                $match['subjects'] = true;
                            }
                        }
                        $match['maxpoints']++;
                    }
                
                /* es werden eh nur wartende schüler angezeigt
                if($student->student_status_id == 1){
                    $match['points']++;
                }
                $match['maxpoints']++;*/
                    
                $match['percentage'] = $match['points']/$match['maxpoints'];
                
                }
                
                
                //$studentStatus = $student->student_status->name;
                $match_results[$student['id']] = $match;
		$this->set(compact('student'));
		$this->set('_serialize', ['student']);
                
            }
            
            /* subjects - da ein student keine richigen subject verweise hat,
             * werden hier alle möglichen subjects in ein array gepackt,
             * damit diese schön in der view ausgegeben werden können
             * [ID => NAME]
             */
            $this->loadModel('Subjects');
            $subjects = $this->Subjects->find('all')
                    ->where(['location_id =' => $partner['location_id']]);
            $subject_list = [];
            foreach($subjects as $subj){
                $subject_list[$subj['id']] = $subj['name'];
            }
            
            
            $ranges = [['perfect match', 1.1, 0.9], ['great match', 0.9, 0.6], ['average match', 0.6, 0.3], ['bad match',0.3,0.0]];
            $this->set(compact('partner', 'match_results', 'ranges', 'subject_list', 'students', $this->paginate($students)));
            $this->set('_serialize', ['partner'], ['students']);
            
            
        }
        else{
            //wenn partner und schüler id gesetzt, so soll ein neues tandem kreiert werden
            $partner = $this->Partners->get($partnerId, [
                'contain' => ['Users']
            ]);
            $partnerName = h($partner->user->first_name . ' ' . $partner->user->last_name);
            
            //$partner->status_id=6;
            $this->setStatus($partnerId,6);
            $partner->status_text = null;
            $this->Partners->save($partner);
            
            $this->loadModel('Students');
            $studentTable = TableRegistry::get('Students');
            $student = $this->Students->get($studentId);
            $studentName = h($student->first_name . ' ' . $student->last_name);
            
            $student->student_status_id=2;
            $studentTable->save($student);

            $tandemTable = TableRegistry::get('Tandems');
            $tandem = $tandemTable->newEntity();
            $tandem->partner_id = $partnerId;
            $tandem->student_id = $studentId;
            $tandem->activated = Time::now();
            $tandemTable->save($tandem);
            
            $this->Flash->success(h($partnerName . ' und ' . $studentName . ' sind nun ein Tandem!'));
            $this->redirect(['controller' => 'Tandems', 'action' => 'index', ['sort' => 'activated', 'direction' => 'desc']]);
        }
    }
	
    //status-änderungsfunktion für den user mit user interface ->
    //nicht zu verwechseln mit setStatus, die nur für interne änderungen
    //gebraucht wird (wie auch hier)
    public function status($id = null) {
        $partner = $this->Partners->get($id, ['contain' => ['Users']]);
        $this->loadModel('Tandems');
		
        if($this->request->is(['patch', 'post', 'put'])){
            $tandems_count = $this->Tandems->find()->where(['partner_id' => $partner->id, 'deactivated IS NULL'])->count();
            if($this->request->data('status_id') == 6 && $tandems_count == 0) {
                $this->Flash->error('Ungültige Operation');
            } else {

                if($this->setStatus($id, $this->request->data('status_id'))) {
                        $this->Flash->success('Status aktualisiert');
                        return $this->redirect(['action' => 'index']);
                } else {
                        $this->Flash->success('Fehler bei der Status Aktualisierung');
                }
            }
        }
		
        //falls aus irgendwelchen gründen solche operationen passieren
        //hier die rückfallbedingung
        if($partner['status_id'] == 1){ //noch nicht verifiziert
            $message = 'Der Pate muss erst seine Email-Adresse bestätigen bevor sein Status verändert werden kann!';
            $this->Flash->error($message);
            return $this->redirect($this->request->referer());
        } elseif($partner['status_id'] == 6){
            $message = 'Der Pate ist inaktiv. Ein Admin muss ihn erst wieder aktivieren, bevor sein Status wieder verändert werden kann.';
        } elseif($partner['status_id'] > 6){ //aufgehört oder abgelehnt
            $message = 'Der Pate ist bereits vermittelt. Der Status kann erst wieder verändert werden, wenn diese Patenschaft beendet ist.';
        }

        if(isset($message)){
            $this->Flash->error($message);
            return $this->redirect($this->request->referer());
        } else {
            //status darf nicht auf 'angemeldet' und 'aufgehört' geändert werden
            //für aufgehört muss deaktiviert werden
            $status = $this->Partners->Status->find('list', [
                'limit' => 200,
                'conditions' => [
                    'OR' => [['id >' => 1, 'id <' => 6], ['id =' => 8]]
                    ]
                ]);
            $this->set(compact('partner', 'status'));
            $this->set('_serialize', ['partner', 'status']);
        }
    }
    
    //interne funktion um den status eines paten zu ändern
    public function setStatus($partner_id = null, $status_id = null){
        if($partner_id == NULL or $status_id == NULL){
            $this->Flash->error('Ungültige Operation');
            return $this->redirect($this->referer(['action' => 'index']));
        }
        //update statusHistory
        $this->loadModel('StatusHistorys');
        $newStatHist = $this->StatusHistorys->newEntity();//$statHistTable->newEntity();
        $newStatHist->partner_id = $partner_id;
        $newStatHist->status_id = $status_id;
        $newStatHist->timestamp = Time::now();
        //falls die anfrage übers formular (partners/status/$id) geht...
        $newStatHist->text = $this->request->data('status_text');
        
        //update waiting data
        $partner = $this->Partners->get($partner_id);
        $partner->status_id = $status_id;
        if($status_id == 5){
            $partner->waiting = Time::now();
        } else {
            $partner->waiting = NULL;
        }
	
        $this->Partners->patchEntity($partner, $this->request->data);
        
        if(($this->StatusHistorys->save($newStatHist)) and ($this->Partners->save($partner))){
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
	
	public function contact($id = null){
		$partner = $this->Partners->get($id, ['contain' => 'Users']);
		
		if($this->request->is(['patch', 'post', 'put'])){
			$partner = $this->Partners->patchEntity($partner, $this->request->data);
			if($this->Partners->save($partner)){
				$this->Flash->success('Kontaktperson wurde aktualisiert!');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('Fehler beim speichern der Kontaktperson.');
			}
		}
		
		$this->set(compact('partner'));
		$this->set('_serialize', ['partner']);
	}  
}
