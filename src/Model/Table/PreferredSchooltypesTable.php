<?php
namespace App\Model\Table;

use App\Model\Entity\PreferredSchooltype;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PreferredSchooltypes Model
 */
class PreferredSchooltypesTable extends Table
{

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		$this->table('preferred_schooltypes');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->belongsTo('Partners', [
            'foreignKey' => 'partner_id'
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
		$rules->add($rules->existsIn(['partner_id'], 'Partners'));
		$rules->add($rules->existsIn(['schooltype_id'], 'Schooltypes'));
		return $rules;
	}
}
