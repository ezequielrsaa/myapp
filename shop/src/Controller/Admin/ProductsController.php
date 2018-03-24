<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class ProductsController extends AppController
{

////////////////////////////////////////////////////////////////////////////////

    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories'],
            'order' => [
                'Products.name' => 'ASC'
            ],
            'limit' => 150
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
        $this->set('_serialize', ['products']);

        $categories1 = $this->Products->Categories->find('list', [
            'order' => [
                'Categories.name' => 'ASC',
            ]
        ])->toArray();
        foreach ($categories1 as $key => $value) {
            $categories[] = [
                'value' => $key,
                'text' => $value,
            ];
        }
        $this->set(compact('categories'));

    }

////////////////////////////////////////////////////////////////////////////////

    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'Productoptions']
        ]);

        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
        $this->set('_serialize', ['product']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
        $this->set('_serialize', ['product']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////////////////////////

}
