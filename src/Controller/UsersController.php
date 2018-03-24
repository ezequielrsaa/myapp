<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
// use Cake\Auth\DefaultPasswordHasher;


class UsersController extends AppController {

////////////////////////////////////////////////////////////////////////////////

    public function login()
    {
        // $passwordHasher = new DefaultPasswordHasher();
        // echo $passwordHasher->hash('admin');
        // $this->loadComponent('Auth');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {

                $u = $this->Users->newEntity();
                $u->id = $user['id'];
                $u->login_count = $user['login_count'] + 1;
                $u->login_last = date('Y-m-d H:i:s');
                $this->Users->save($u);

                $this->Auth->setUser($user);

                if ($user['role'] == 'user') {
                    return $this->redirect([
                        'controller' => 'users',
                        'action' => 'index',
                        'prefix' => 'user',
                    ]);
                }

                if ($user['role'] == 'admin') {
                    return $this->redirect([
                        'controller' => 'users',
                        'action' => 'index',
                        'prefix' => 'admin',
                    ]);
                }

            } else {
                $this->Flash->error('Username or password is incorrect', 'default', [], 'auth');
            }
        }
        $title_for_layout = 'Sign in';
        $description = 'Sign in';
        $keywords = '';
        $this->set(compact('title_for_layout', 'description', 'keywords'));
    }

////////////////////////////////////////////////////////////////////////////////

    public function logout()
    {
        $this->Flash->success('Good-Bye');
        return $this->redirect($this->Auth->logout());
    }

////////////////////////////////////////////////////////////////////////////////

}
