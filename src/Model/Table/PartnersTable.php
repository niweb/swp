<?php
namespace App\Model\Table;

use App\Model\Entity\Partner;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Partners Model
 */
class PartnersTable extends Table
{

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
            $this->table('partners');
            $this->displayField('first_name');
            $this->primaryKey('id');
            $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
            ]);
            $this->belongsTo('Locations', [
            'foreignKey' => 'location_id'
            ]);
            $this->belongsTo('Status', [
            'foreignKey' => 'status_id'
            ]);
            $this->hasMany('PreferredClassranges', [
            'foreignKey' => 'partner_id'
            ]);
            $this->hasMany('PreferredSchooltypes', [
            'foreignKey' => 'partner_id'
            ]);
            $this->hasMany('PreferredSubjects', [
            'foreignKey' => 'partner_id'
            ]);
            $this->hasMany('Tandems', [
            'foreignKey' => 'partner_id'
            ]);
            $this->hasMany('StatusHistory', [
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
                ->add('age', 'valid', ['rule' => 'numeric'])
		->add('age', 'validValue', [
                    'rule' => ['range',18,120],
                    'message' => 'Du musst mindestens 18 jahre alt sein',
                    ])
		->requirePresence('age', 'create')
		->notEmpty('age');

		$validator
		->requirePresence('sex', 'create')
		->notEmpty('sex');

		$validator
		->allowEmpty('degree_course');

		$validator
		->allowEmpty('job');

		$validator
		->add('street', 'string',['rule' => 'alphaNumeric'])
		->requirePresence('street', 'create')
		->notEmpty('street');

		$validator
		->add('house_number', 'valid', ['rule' => 'numeric', 'message' => 'Hausnummer muss eine Zahl sein'])
		->requirePresence('house_number', 'create')
		->notEmpty('house_number');

		$validator
		->allowEmpty('house_number_addition');

		$validator
		->add('postcode', 'valid', ['rule' => 'numeric', 'message' => 'Postleitzahl muss eine Zahl sein'])
		->add('postcode', 'postLength', ['rule' => ['lengthBetween', 5, 5], 'message' => 'Postleitzahl muss 5-stellig sein'])
		->requirePresence('postcode', 'create')
		->notEmpty('postcode');

		$validator
		->requirePresence('city', 'create')
		->notEmpty('city');

		$validator
		->add('mobile', 'valid', ['rule' => 'numeric', 'message' => 'Die Nummer muss eine Zahl sein'])
		->requirePresence('mobile', 'create')
		->notEmpty('mobile');

		$validator
		->allowEmpty('telephone');

		$validator
		->add('teach_time', 'valid', ['rule' => 'numeric'])
		->add('teach_time', 'validValue', [
                    'rule' => ['range',90,10080],
                    'message' => 'Du musst mindestens 90 Minuten Zeit in der Woche haben.',
                    ])
		->requirePresence('teach_time', 'create')
		->notEmpty('teach_time');

		$validator
		->add('extra_time', 'range', ['rule' => ['range', 0, 10080], 'message' => 'Ungültiger Wert'])
		->requirePresence('extra_time', 'create')
		->notEmpty('extra_time');

		$validator
		->add('spend_time', 'range', ['rule' => ['range', 0, 10080], 'message' => 'Ungültiger Wert'])
		->requirePresence('spend_time', 'create')
		->notEmpty('spend_time');

		$validator
		->requirePresence('experience', 'create')
		->notEmpty('experience');

		$validator
		->allowEmpty('preferred_gender');

		$validator
		->allowEmpty('support_wish');

		$validator
		->requirePresence('reason_for_decision', 'create')
		->notEmpty('reason_for_decision');

		$validator
		->allowEmpty('additional_informations');

		$validator
		->requirePresence('reason_for_schuelerpaten', 'create')
		->notEmpty('reason_for_schuelerpaten');
		
		$validator
		->allowEmpty('lat');
		
		$validator
		->allowEmpty('lng');
		
		$validator
		->requirePresence('status_id', 'create')
		->notEmpty('status_id');
		
		$validator
		->allowEmpty('status_text');
		
		$validator
		->allowEmpty('waiting');
		
		$validator
		->allowEmpty('contact');

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
		return $rules;
	}
	
	public function isTheSame($partnerID, $userID){
		return $this->exists(['id' => $partnerID, 'user_id' => $userID]);
	}
}
