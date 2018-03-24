<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class CartComponent extends Component
{

////////////////////////////////////////////////////////////////////////////////

    public function getcart()
    {
        return $this->request->session()->read('Shop');
    }

////////////////////////////////////////////////////////////////////////////////

    public function cart()
    {
        $shop = $this->getcart();
        // print_r($shop);
        $quantity = 0;
        $subtotal = 0;
        $total = 0;
        $order_item_count = 0;
        // $order = $shop['Order'];
        if (count($shop['Orderproducts']) > 0) {
            foreach ($shop['Orderproducts'] as $item) {
                $quantity += $item['quantity'];
                $subtotal += $item['subtotal'];
                $total += $item['subtotal'];
                $order_item_count++;
            }
            $order['order_item_count'] = $order_item_count;
            $order['quantity'] = $quantity;
            $order['subtotal'] = sprintf('%01.2f', $subtotal);
            $order['total'] = sprintf('%01.2f', $total);

            $this->request->session()->write('Shop.Order', $order);
            return true;
        }
        else {
            $this->clear();
            return false;
        }
    }

////////////////////////////////////////////////////////////////////////////////

    public function add($id, $quantity = 1, $productoptionId = null)
    {

        $controller = $this->_registry->getController();

        if(!is_numeric($quantity) || $quantity < 1) {
            $quantity = 1;
        }

        // if($quantity == 0) {
        //     $this->remove($id . '_' . $productoptionId);
        //     return;
        // }

        $quantity = abs($quantity);

        $data = [];

        $product = $controller->Products->get($id, [
            'contain' => []
        ]);

        if($productoptionId) {

            $productoption = $controller->Products->Productoptions->find('all', [
                'conditions' => array(
                    'Productoptions.id' => $productoptionId,
                ),
                'order' => [
                    'Productoptions.name' => 'ASC',
                ],
            ])->first();

            $price = $productoption->price;

        } else {
            $productoption = (object) [];
            $productoption->id = null;
            $productoption->name = null;
            $productoption->price = 0;

            $price = $product->price;

        }

        $data = [
            'product_id' => $product->id,
            'name' => $product->name,
            'productoption_id' => $productoption->id,
            'productoption_name' => $productoption->name,
            'slug' => $product->slug,
            'image' => $product->image,
            'price' => sprintf('%01.2f', $price),
            'quantity' => $quantity,
            'subtotal' => sprintf('%01.2f', $price * $quantity),
        ];

        $this->request->session()->write('Shop.Orderproducts.' . $id . '_' . $productoptionId, $data);

        $this->cart();

    }

////////////////////////////////////////////////////////////////////////////////

    public function remove($id) {
        if($this->request->session()->read('Shop.Orderproducts.' . $id)) {
            $product = $this->request->session()->read('Shop.Orderproducts.' . $id);
            $this->request->session()->delete('Shop.Orderproducts.' . $id);
            $this->cart();
            return $product;
        }
        return false;
    }

////////////////////////////////////////////////////////////////////////////////

    public function clear()
    {
        $this->request->session()->delete('Shop');
    }

////////////////////////////////////////////////////////////////////////////////

}