<?php
namespace App\Controller;

use App\Controller\AppController;

class CategoriesController extends AppController
{

////////////////////////////////////////////////////////////////////////////////

    public function index()
    {
        $categories = $this->Categories->find('all', [
            'order' => [
                'Categories.sort' => 'ASC',
                'Categories.name' => 'ASC',
            ],
            'conditions' => [
                'Categories.active' => 1,
            ]
        ]);

        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function view($slug = null)
    {
        $categories = $this->Categories->find('all', [
            'order' => [
                'Categories.sort' => 'ASC',
                'Categories.name' => 'ASC',
            ],
            'conditions' => [
                'Categories.active' => 1,
            ]
        ]);
        $this->set(compact('categories'));

        $category = $this->Categories->find('all', [
            'conditions' => [
                'Categories.slug' => $slug,
                'Categories.active' => 1,
            ]
        ])->first();
        if(empty($category)) {
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('category'));

        $products = $this->Categories->Products->find('all', [
            'order' => [
                'Products.name' => 'ASC',
            ],
            'conditions' => [
                'Products.category_id' => $category->id,
                'Products.active' => 1,
            ]
        ]);
        $this->set(compact('products'));
    }

////////////////////////////////////////////////////////////////////////////////

}
