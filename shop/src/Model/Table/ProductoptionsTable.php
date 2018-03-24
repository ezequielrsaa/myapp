<?php
namespace App\Model\Table;

use App\Model\Entity\Productoption;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProductoptionsTable extends Table
{

////////////////////////////////////////////////////////////////////////////////

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('productoptions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);
    }

////////////////////////////////////////////////////////////////////////////////

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->notBlank('name');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->integer('active')
            ->allowEmpty('active');

        return $validator;
    }

////////////////////////////////////////////////////////////////////////////////

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        return $rules;
    }

////////////////////////////////////////////////////////////////////////////////

}
