<?php
namespace App\Model\Table;

use App\Model\Entity\Orderproduct;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrderproductsTable extends Table
{

////////////////////////////////////////////////////////////////////////////////

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('orderproducts');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id'
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id'
        ]);
    }

////////////////////////////////////////////////////////////////////////////////

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->integer('quantity')
            ->allowEmpty('quantity');

        $validator
            ->decimal('weight')
            ->allowEmpty('weight');

        $validator
            ->decimal('price')
            ->allowEmpty('price');

        $validator
            ->decimal('subtotal')
            ->allowEmpty('subtotal');

        $validator
            ->allowEmpty('productmod_name');

        return $validator;
    }

////////////////////////////////////////////////////////////////////////////////

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        return $rules;
    }

////////////////////////////////////////////////////////////////////////////////

}
