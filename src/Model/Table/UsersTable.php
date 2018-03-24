<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

////////////////////////////////////////////////////////////////////////////////

    public function initialize(array $config)
    {
        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }

////////////////////////////////////////////////////////////////////////////////

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            // ->allowEmpty('role')
            // ->allowEmpty('first_name')
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
            ])
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
            ])
            ->notBlank('password', 'Password is required')
            ->add('password', [
                'rule1' => [
                    'rule' => ['minLength', 2],
                    'message' => 'Password need to be at least 2 characters long',
                ],
                'rule2' => [
                    'rule' => ['maxLength', 20],
                    'message' => 'Password need to be maximum 20 characters long',
                ]
            ])
            // ->allowEmpty('phone')
            ->notBlank('phone', 'Phone is required')
            ->notBlank('email', 'Email is required')
            ->add('email', [
                'rule1' => [
                    'rule' => 'email',
                    'message' => 'Please enter valid Email',
                ],
                'rule2' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Email already in use',
                ]
            ])
            ->allowEmpty('uuid')
            ->add('active', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('active')
            ->add('login_count', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('login_count')
            ->add('login_last', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('login_last');

        return $validator;
    }

////////////////////////////////////////////////////////////////////////////////

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }

////////////////////////////////////////////////////////////////////////////////

}
