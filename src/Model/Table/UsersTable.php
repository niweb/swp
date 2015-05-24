<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table
{

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		$this->table('users');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Types', [
            'foreignKey' => 'type_id'
            ]);
            $this->belongsTo('Locations', [
            'foreignKey' => 'location_id'
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
		->add('email', 'valid', ['rule' => 'email'])
		->requirePresence('email', 'create')
		->notEmpty('email');

		$validator
		->requirePresence('password', 'create')
		->notEmpty('password');

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
		$rules->add($rules->isUnique(['email']));
		$rules->add($rules->existsIn(['type_id'], 'Types'));
		$rules->add($rules->existsIn(['location_id'], 'Locations'));
		return $rules;
	}
}
