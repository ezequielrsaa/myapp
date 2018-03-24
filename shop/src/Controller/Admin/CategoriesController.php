<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class CategoriesController extends AppController
{

////////////////////////////////////////////////////////////////////////////////

    public function index()
    {

        $this->paginate = [
            'order' => [
                'Categories.name' => 'ASC',
            ],
            'limit' => 50
        ];
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////////////////////////

}
