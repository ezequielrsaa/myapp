<?php
namespace App\Controller;

use App\Controller\AppController;

class ProductsController extends AppController
{

////////////////////////////////////////////////////////////////////////////////

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Cart');        
		//$this->loadComponent('Search', ['actions'=>'index','lookup']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function sitemap()
    {
        $products = $this->Products->find('all', [
            'order' => [
                'Products.name' => 'ASC'
            ],
            'fields' => [
                'Products.slug'
            ],
            'conditions' => [
                'Products.active' => 1,
            ]
        ]);
        $this->set(compact('products'));

        $this->response->type('xml');
        $this->viewBuilder()->layout(false);
    }

////////////////////////////////////////////////////////////////////////////////

    public function index()
    {
        $q = $this->request->getQuery('q');
		$this->paginate = [
        'contain' => ['Categories'],
        'order' => [
            'Products.name' => 'ASC',
        ],
        'conditions' => [
            'Products.active' => 1,
        ],
        'limit' => 100
        ];
        if(empty($q)){

            $products = $this->paginate($this->Products);
            $this->set(compact('products'));
        }else{
            $products = $this->Products->find('all', [
                'contain' => ['Categories'],
                'conditions' => [
                    //'Products.name LIKE' => '%' . $this->request->query('q') . '%',
                    'Products.name LIKE' => '%'.$q.'%',
                    'Products.active' => 1,
                ]
            ]);
            
            if(empty($products)) {
                return $this->redirect(['action' => 'index']);
            }else{
            $products = $this->paginate($products);
            $this->set(compact('products'));
            //$this->set('_serialize', ['products']);
            }
        }
    }

////////////////////////////////////////////////////////////////////////////////

    public function view($slug = null)
    {

        $product = $this->Products->find('all', [
            'contain' => ['Categories'],
            'conditions' => [
                'Products.slug' => $slug,
                'Products.active' => 1,
            ]
        ])->first();
        if(empty($product)) {
            return $this->redirect(['action' => 'index']);
        }

        $productoptions = $this->Products->Productoptions->find('all', [
            'fields' => [
                'id',
                'name',
                'price',
                'weight',
            ],
            'conditions' => [
                'Productoptions.product_id' => $product->id,
                'Productoptions.name NOT LIKE' => '%Please Select%',
            ],
            'order' => [
                'Productoptions.name' => 'ASC',
            ],
        ])->all();

        $productoptionlists = [];
        foreach($productoptions as $productoption):
            $price = sprintf('%01.2f', $productoption->price);
            $productoption->newprice = (float) $price;
            $productoptionlists[$productoption->id] = $productoption->name . ' - ' . '$' . $price;
        endforeach;

        $this->set(compact('product', 'productoptions', 'productoptionlists'));
    }

////////////////////////////////////////////////////////////////////////////////

  public function add()
    {
/*
        $cantidad = (!empty ($this->request->data['cantidad'])) ? $this->request->data['cantidad'] : 0 ;
            $id = $this->request->data['id'];
            $quantity = (!empty($cantidad)) ? $cantidad : 1;
            $productoptionId = isset($this->request->data['productoptionlist']) ? $this->request->data['productoptionlist'] : 0;
*/
        if ($this->request->is('ajax') && $this->request->is('post')) {
            $status['msg']="OK";
            $status['products']= Array();
            //$this->request->session()->read('Shop');
            //dd($this->request->data('carro'));
            $productos = (!empty($this->request->data('carro'))) ? $this->request->data('carro') : array();
            foreach ($productos as $key => $prod) {
                $productoptionId = isset($this->request->data['productoptionlist']) ? $this->request->data['productoptionlist'] : 0;
                $product = $this->Products->get(intval($prod['id']), [
                'contain' => []
                ]);
                if(!empty($product)) {
                    $this->Cart->add($prod['id'],intval( $prod['cant']), $productoptionId); 
                    $status['products'][$prod['id']] = $prod['cant'];
                }else{
                    $status['msg_error']="Error";
                
                }
            }
            $status['cart'] = ($this->request->session()->read('Shop')) ? $this->request->session()->read('Shop') : null  ;
            $this->response->body(json_encode($status));
            return $this->response;
          }else{
              return $this->redirect(['action' => 'index']);
          }
    }

////////////////////////////////////////////////////////////////////////////////

    public function remove($id = null) {
        $product = $this->Cart->remove($id);
        if(!empty($product)) {
            // $this->Flash->error($product['name'] . ' was removed from your shopping cart');
        }
        return $this->redirect(['action' => 'cart']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function cart()
    {
        $shop = $this->Cart->getcart();
        $this->set(compact('shop'));
    }

////////////////////////////////////////////////////////////////////////////////

    public function cartupdate() {
        if ($this->request->is('post')) {
            foreach($this->request->data as $key => $value) {
                $a = explode('-', $key);
                $b = explode('_', $a[1]);
                $this->Cart->add($b[0], $value, $b[1]);
                $this->Cart->cart();
            }
        }
        return $this->redirect(['action' => 'cart']);
    }

////////////////////////////////////////////////////////////////////////////////

    public function itemupdate() {
        if ($this->request->is('ajax')) {
            $id = $this->request->data['id'];
            $quantity = isset($this->request->data['quantity']) ? $this->request->data['quantity'] : 1;
            if(isset($this->request->data['mods']) && ($this->request->data['mods'] > 0)) {
                $productmodId = $this->request->data['mods'];
            } else {
                $productmodId = 0;
            }
            $product = $this->Cart->add($id, $quantity, $productmodId);
        }
        $cart = $this->Cart->getcart();
        echo json_encode($cart);
        die;
    }

////////////////////////////////////////////////////////////////////////////////

    public function clear()
    {
        $this->Cart->clear();
        $this->Flash->success('The shopping cart is cleared');
        return $this->redirect(['action' => 'index']);
    }

////////////////////////////////////////////////////////////////////////////////
	public function search()
	{
        $q = $this->request->data('q');
        var_dump($q);die;
		//$query = $this->Posts
        //->find('search',['search' => $this->request->query])
        //->contain(['Users','Categories'])
        //->where(['Posts.status' => 1]);
		/*$query = $this->find('all')
        ->where(['name LIKE' => '%' . $this->request->query('q') . '%'])
        ->orWhere(['description LIKE' => '%' . $this->request->query('q') . '%']);

        $this->set(compact('products', $this->paginate($query)));*/
		
		/*$query = $this->Products->find('search', ['search' => $this->request->query]);
        $vari = $this->request->getQuery('q');
        if ($vari != "") {
            $posts= $this->paginate($query);

            $this->set(compact('products'));
            $this->set('_serialize', ['products']);
        }*/
		$products = $this->Products->find('all', [
            //'contain' => ['Categories'],
            'conditions' => [
                //'Products.name LIKE' => '%' . $this->request->query('q') . '%',
				'Products.name LIKE' => '%Burton%',
               // 'Products.active' => 1,
            ]
        ]);
		
        if(empty($products)) {
            return $this->redirect(['action' => 'index']);
        }else{
		$products = $this->paginate($products);
        $this->set(compact('products'));
		//$this->set('_serialize', ['products']);
		}
		//$query = $this->Products->find('all')->where(['id' => 1]);
		//$this->set('Products', $this->paginate($query));
	}
	
	
////////////////////////////////////////////////////////////////////////////////

}
