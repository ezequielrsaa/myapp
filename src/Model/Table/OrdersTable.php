<?php
namespace App\Model\Table;

use App\Model\Entity\Order;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrdersTable extends Table
{

////////////////////////////////////////////////////////////////////////////////

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('orders');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Orderproducts', [
            'foreignKey' => 'order_id',
            'dependent' => true,
        ]);
    }

////////////////////////////////////////////////////////////////////////////////

    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->notBlank('first_name', 'First Name is required')
            ->add('first_name', [
                'rule1' => [
                    'rule' => ['minLength', 2],
                    'message' => 'First Name need to be at least 2 characters long',
                ],
                'rule2' => [
                    'rule' => ['maxLength', 20],
                    'message' => 'First Name need to be maximum 20 characters long',
                ]
            ]);

        $validator
            ->notBlank('last_name', 'Last Name is required')
            ->add('last_name', [
                'rule1' => [
                    'rule' => ['minLength', 2],
                    'message' => 'Last Name need to be at least 2 characters long',
                ],
                'rule2' => [
                    'rule' => ['maxLength', 20],
                    'message' => 'Last Name need to be maximum 20 characters long',
                ]
            ]);

        $validator
            ->notBlank('email', 'Email is required')
            ->add('email', [
                'rule1' => [
                    'rule' => 'email',
                    'message' => 'Please enter valid Email',
                ],
            ]);

        $validator
            ->notBlank('phone', 'Phone is required');

        $validator
            ->notEmpty('billing_address');

        $validator
            ->notEmpty('billing_address2');

        $validator
            ->notEmpty('billing_city');

        $validator
            ->notEmpty('billing_zip');

        $validator
            ->notEmpty('billing_state');

        $validator
            ->notEmpty('billing_country');

        $validator
            ->notEmpty('shipping_address');

        $validator
            ->notEmpty('shipping_address2');

        $validator
            ->notEmpty('shipping_city');

        $validator
            ->notEmpty('shipping_zip');

        $validator
            ->notEmpty('shipping_state');

        $validator
            ->notEmpty('shipping_country');

        $validator
            ->decimal('weight')
            ->allowEmpty('weight');

        $validator
            ->integer('order_item_count')
            ->allowEmpty('order_item_count');

        $validator
            ->decimal('subtotal')
            ->allowEmpty('subtotal');

        $validator
            ->decimal('tax')
            ->allowEmpty('tax');

        $validator
            ->decimal('shipping')
            ->allowEmpty('shipping');

        $validator
            ->decimal('total')
            ->allowEmpty('total');

        $validator
            ->allowEmpty('order_type');

        // $validator
        //     ->allowEmpty('creditcard_number');

        // $validator->notEmpty('creditcard_number', 'This field is required', function ($context) {
        //     return $context['data']['payment_method'] === 'credit_card';
        // });
        // $validator->allowEmpty('creditcard_number', function ($context) {
        //     return isset($context['data']['payment_method']) && ($context['data']['payment_method'] != 'credit_card');
        // });

        // $validator
        //     ->add('creditcard_number', [
        //         'cc' => [
        //             'rule' => 'cc',
        //             'message' => 'Please enter valid Credit Card',
        //             'on' => function ($context) {
        //                 return $context['data']['payment_method'] == 'credit_card';
        //             }
        //         ],
        //     ]);


        // $validator->add('creditcard_number', 'cc', [
        //     'rule' => 'cc',
        //     'message' => 'Please enter valid Credit Card',
        //     'on' => function ($context) {
        //         return ($context['data']['payment_method'] == 'credit_card');
        //     }
        // ]);

        $validator
            ->allowEmpty('authorization');

        $validator
            ->allowEmpty('transaction');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('ip_address');

        $validator
            ->allowEmpty('referer_cookie');

        return $validator;
    }

////////////////////////////////////////////////////////////////////////////////

    public function validationReview(Validator $validator)
    {
        $validator = $this->validationDefault($validator);

        $validator->allowEmpty('creditcard_number', function ($context) {
            return $context['data']['payment_method'] === 'cod';
        });

        $validator->add('creditcard_number', 'cc', [
            'rule' => 'cc',
            'message' => 'Please enter valid Credit Card',
            'on' => function ($context) {
                return $context['data']['payment_method'] === 'credit_card';
            }
        ]);

        $validator->notEmpty('creditcard_number', 'Credit Card is required', function ($context) {
            return $context['data']['payment_method'] === 'credit_card';
        });

        $validator->allowEmpty('creditcard_code', function ($context) {
            return $context['data']['payment_method'] === 'cod';
        });

        $validator->add('creditcard_code', 'custom', [
            'rule' => ['custom', '/^[0-9]{3,4}$/i'],
            'message' => 'Please enter valid CSC',
            'on' => function ($context) {
                return $context['data']['payment_method'] === 'credit_card';
            }
        ]);

        $validator->notEmpty('creditcard_code', 'CSC is required', function ($context) {
            return $context['data']['payment_method'] === 'credit_card';
        });

        $validator->notEmpty('creditcard_month', 'Month is required', function ($context) {
            return $context['data']['payment_method'] === 'credit_card';
        });

        $validator->notEmpty('creditcard_year', 'Year is required', function ($context) {
            return $context['data']['payment_method'] === 'credit_card';
        });

        return $validator;
    }

////////////////////////////////////////////////////////////////////////////////

    // public function buildRules(RulesChecker $rules)
    // {
    //     $rules->add($rules->isUnique(['email']));
    //     return $rules;
    // }

////////////////////////////////////////////////////////////////////////////////

}
