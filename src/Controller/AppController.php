<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
// use Cake\ORM\Table;
// use Cake\ORM\TableRegistry;

class AppController extends Controller {

////////////////////////////////////////////////////////////////////////////////

    public function initialize()
    {
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Cookie');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'users',
                'action' => 'login',
                'prefix' => false,
            ],
            'authError' => 'Did you really think you are allowed to see that?',
            'unauthorizedRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email'],
                    'scope' => ['Users.active' => 1],
                ]
            ],
            'authorize' => ['Controller']
        ]);
    }

////////////////////////////////////////////////////////////////////////////////

    protected $secureActions = [
        // 'cart',
        'address',
        'review',
        
    ];

////////////////////////////////////////////////////////////////////////////////

    public function beforeFilter(Event $event)
    {

        // if (in_array($this->request->params['action'], $this->secureActions) && !isset($_SERVER['HTTPS'])) {
        //     $this->protocol('https');
        // }

        // if (!in_array($this->request->params['action'], $this->secureActions) && isset($_SERVER['HTTPS'])) {
        //     $this->protocol('http');
        // }

        $authuser = $this->Auth->user();
        $this->set(compact('authuser'));
        //$this->redirect($this->Auth->unauthorizedRedirect);
        //   if(!$this->Auth->identify()){
        //         $this->Auth->deny();
        //         $this->Auth->allow(['login']);
        //         $this->redirect($this->Auth->unauthorizedRedirect);
        //   }

        if(isset($this->request->params['prefix']) && ($this->request->params['prefix'] == 'admin')) {
            $this->viewBuilder()->layout('admin');
        } elseif(isset($this->request->params['prefix']) && ($this->request->params['prefix'] == 'user')) {
            $this->viewBuilder()->layout('user');
        } else {
            $this->Auth->allow();
            if(!$this->request->session()->check('referer')) {
                $this->request->session()->write('referer', env('HTTP_REFERER'));
            }
        }

        Time::setToStringFormat('YYYY-MM-dd HH:mm:ss');

        if(!$this->Cookie->read('referer_cookie')) {
            $this->Cookie->write('referer_cookie', env('HTTP_REFERER'));
        }

        if(!$this->request->session()->read('referer_session')) {
            $this->request->session()->write('referer_session', env('HTTP_REFERER'));
        }

        if(!$this->Cookie->read('request_uri')) {
            $this->Cookie->write('request_uri', $this->request->here());
        }

    }

////////////////////////////////////////////////////////////////////////////////

    // public function protocol($protocol = 'http') {
    //     return $this->redirect($protocol . '://' . $_SERVER['SERVER_NAME'] . $this->request->here, 301);
    // }

////////////////////////////////////////////////////////////////////////////////

    public function isAuthorized($user)
    {
        if (($this->request->params['prefix'] === 'admin') && ($user['role'] != 'admin')) {
            echo '<a href="/users/logout">Logout</a><br />';
            die('Invalid request for '. $user['role'] . ' user.');
        }
        if (($this->request->params['prefix'] === 'user') && ($user['role'] != 'user')) {
            echo '<a href="/users/logout">Logout</a><br />';
            die('Invalid request for '. $user['role'] . ' user.');
        }
        return true;
    }

////////////////////////////////////////////////////////////////////////////////

    public function toggle($field = null, $id = null)
    {

        $model = $this->modelClass;

        if ($this->$model && $field && $id) {
            $expression = new \Cake\Database\Expression\QueryExpression($field . ' = 1 - '. $field);
            $this->$model->updateAll([$expression], ['id' => $id]);
        }

        $this->autoRender = false;

        if (!$this->request->is('ajax')) {
            return $this->redirect($this->referer());
        }

    }

////////////////////////////////////////////////////////////////////////////////

    public function editable()
    {

        $data = [
            $this->request->data['name'] => trim($this->request->data['value']),
        ];

        $results = \Cake\ORM\TableRegistry::get($this->modelClass);
        $result = $results->get($this->request->data['pk']);
        $results->patchEntity($result, $data);
        $results->save($result);

        $this->autoRender = false;

        if (!$this->request->is('ajax')) {
            return $this->redirect($this->referer());
        }

    }

////////////////////////////////////////////////////////////////////////////////

}
