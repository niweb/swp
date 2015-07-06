<?php
namespace App\Model\Table;

use App\Model\Entity\Classrange;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classranges Model
 */
class ClassrangesTable extends Table
{

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		$this->table('classranges');
		$this->displayField('name');
		$this->primaryKey('id');
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
		->add('name', 'valid', ['rule' => 'numeric'])
		->requirePresence('name', 'create')
		->notEmpty('name');

		return $validator;
	}
}
