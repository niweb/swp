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
        $this->displayField('partner_id');
        $this->primaryKey('partner_id');
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');
            
        $validator
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');
            
        $validator
            ->add('age', 'valid', ['rule' => 'numeric'])
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
            ->requirePresence('telephone', 'create')
            ->notEmpty('telephone');
            
        $validator
            ->allowEmpty('mobile');
            
        $validator
            ->add('teach_time', 'valid', ['rule' => 'numeric'])
            ->requirePresence('teach_time', 'create')
            ->notEmpty('teach_time');
            
        $validator
            ->add('extra_time', 'valid', ['rule' => 'numeric'])
            ->requirePresence('extra_time', 'create')
            ->notEmpty('extra_time');
            
        $validator
            ->requirePresence('spend_time', 'create')
            ->notEmpty('spend_time');
            
        $validator
            ->requirePresence('experience', 'create')
            ->notEmpty('experience');
            
        $validator
            ->allowEmpty('preffered_gender');
            
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
}
