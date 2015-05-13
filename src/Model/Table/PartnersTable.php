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
        $this->belongsTo('Partners', [
        	'className' => 'Partners',
            'foreignKey' => 'partner_id',
            'joinType' => 'INNER'
        ]);
        
        //Associations between the Tables
        $this->belongsTo('Users', [
        	'className' => 'UsersPartners',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
        	'className' => 'StudentsPartners',
            'foreignKey' => 'student_id',
        	'joinType' => 'INNER'
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
            ->requirePresence('vorname', 'create')
            ->notEmpty('vorname');
            
        $validator
            ->requirePresence('nachname', 'create')
            ->notEmpty('nachname');
            
        $validator
            ->requirePresence('telefon', 'create')
            ->notEmpty('telefon');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        return $rules;
    }
}
