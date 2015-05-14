<?php
namespace App\Model\Table;

use App\Model\Entity\Location;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Locations Model
 */
class LocationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('locations');
        $this->displayField('name');
        $this->primaryKey('location_id');
        $this->hasMany('Partners', [
            'foreignKey' => 'location_id'
        ]);
        $this->hasMany('Schooltypes', [
            'foreignKey' => 'location_id'
        ]);
        $this->hasMany('Students', [
            'foreignKey' => 'location_id'
        ]);
        $this->hasMany('Subjects', [
            'foreignKey' => 'location_id'
        ]);
        $this->hasMany('Users', [
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
