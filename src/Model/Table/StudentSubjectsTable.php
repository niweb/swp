<?php
namespace App\Model\Table;

use App\Model\Entity\StudentSubject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentSubjects Model
 */
class StudentSubjectsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('student_subjects');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject1'
        ]);
		$this->belongsTo('Subjects', [
            'foreignKey' => 'subject2'
        ]);
		$this->belongsTo('Subjects', [
            'foreignKey' => 'subject3'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
		
		$validator	
			->add('subject1', 'custom', ['rule' => ['!equalTo', 'subject2']])
			->requirePresence('subject1', 'create')
			->notEmpty('subject1');
		
		$validator	
			->add('subject2', 'custom', ['rule' => ['!equalTo', 'subject3']])
			->allowEmpty('subject2');
		
		$validator	
			->add('subject3', 'custom', ['rule' => ['!equalTo', 'subject1']])
			->allowEmpty('subject3');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
        return $rules;
    }
	
	public function notEqual($value, $context) {
		$compare = $context['data'][0];
		echo $compare;
		if($value != $compare){
			return true;
		}
		return false;
	}
}
