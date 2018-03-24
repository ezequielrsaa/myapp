<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class OrdersController extends AppController
{


////////////////////////////////////////////////////////////////////////////////

    public function index()
    {
        $this->paginate = [
            'limit' => 100
        ];
        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Orderproducts']
        ]);

        $this->set(compact('order'));
        $this->set('_serialize', ['order']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function add()
    {
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('order'));
        $this->set('_serialize', ['order']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('order'));
        $this->set('_serialize', ['order']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////////////////////////

}
