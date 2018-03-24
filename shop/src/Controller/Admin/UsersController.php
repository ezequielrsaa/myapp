<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class UsersController extends AppController {

////////////////////////////////////////////////////////////////////////////////

    public function dashboard() {
    }

////////////////////////////////////////////////////////////////////////////////

    public function index() {

        $this->set('users', $this->paginate());

    }

////////////////////////////////////////////////////////////////////////////////

    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set(compact('user'));

        // $logins = $this->Users->Logins->find('all', [
        //     'conditions' => [
        //         'Logins.user_id' => $user->id
        //     ],
        //     'order' => [
        //         'Logins.created' => 'DESC'
        //     ],
        //     'limit' => 20,
        // ]);
        // $this->set(compact('logins'));

    }

////////////////////////////////////////////////////////////////////////////////

    public function add() {
        $user = $this->Users->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set(compact('user'));
    }

////////////////////////////////////////////////////////////////////////////////

    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set(compact('user'));
    }

////////////////////////////////////////////////////////////////////////////////

    public function password($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set(compact('user'));
    }

////////////////////////////////////////////////////////////////////////////////

    public function delete($id = null) {
        $user = $this->Users->get($id);
        $this->request->allowMethod('post', 'delete');
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////////////////////////

}
