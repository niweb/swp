<?php
namespace App\Model\Table;

use App\Model\Entity\Student;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 */
class StudentsTable extends Table
{

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
            $this->table('students');
            $this->displayField('first_name');
            $this->primaryKey('id');
            $this->belongsTo('Locations', [
                'foreignKey' => 'location_id'
            ]);
            $this->hasMany('Tandems', [
                'foreignKey' => 'student_id'
            ]);
            $this->belongsTo('StudentStatus', [
                'foreignKey' => 'student_status_id'
            ]);
            $this->hasOne('StudentSubjects', [
                'foreignKey' => 'student_id'
            ]);
            $this->hasOne('StudentClassranges', [
                'foreignKey' => 'student_id'
            ]);
			$this->belongsTo('Schooltypes', [
                'foreignKey' => 'schooltype_id'
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
		->requirePresence('first_name', 'create')
		->notEmpty('name');

		$validator
		->requirePresence('last_name', 'create')
		->notEmpty('lastname');
		
		$validator
		->requirePresence('sex', 'create')
		->notEmpty('sex');
		
		$validator
		->requirePresence('street', 'create')
		->notEmpty('street');
		
		$validator
		->requirePresence('house_number', 'create')
		->notEmpty('house_number');
		
		$validator
		->allowEmpty('house_number_addition');
		
		$validator
		->requirePresence('postcode', 'create')
		->notEmpty('postcode');

		$validator
		->requirePresence('city', 'create')
		->notEmpty('city');

		$validator
		->requirePresence('mobile', 'create')
		->notEmpty('mobile');

		$validator
		->allowEmpty('telephone');

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
		$rules->add($rules->existsIn(['location_id'], 'Locations'));
		$rules->add($rules->existsIn(['schooltype_id'], 'Schooltypes'));
		return $rules;
	}
}
