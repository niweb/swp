<?php
namespace App\Model\Table;

use App\Model\Entity\PreferredSubject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PreferredSubjects Model
 */
class PreferredSubjectsTable extends Table
{

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		$this->table('preferred_subjects');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id'
            ]);
            $this->belongsTo('Partners', [
            'foreignKey' => 'partner_id'
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
		->add('maximum_class', 'valid', ['rule' => 'numeric'])
		->allowEmpty('maximum_class');

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
		$rules->add($rules->existsIn(['subject_id'], 'Subjects'));
		$rules->add($rules->existsIn(['partner_id'], 'Partners'));
		return $rules;
	}
}
