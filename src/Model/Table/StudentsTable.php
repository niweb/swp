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
        $this->displayField('student_id');
        $this->primaryKey('student_id');
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
        
        /*
        //Associations between the Tables
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Partners', [
            'foreignKey' => 'partner_id',
            'joinType' => 'INNER'
        ]);
        */
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
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        return $rules;
    }
}
