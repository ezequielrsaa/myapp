<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

class OrdersController extends AppController
{

////////////////////////////////////////////////////////////////////////////////

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Cart');
    }

////////////////////////////////////////////////////////////////////////////////

    public function address()
    {
        $shop = $this->Cart->getcart();
        if(!$shop['Order']['total']) {
            return $this->redirect('/');
        }

        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if (!$order->errors()) {

                $order = $this->request->data;

                if($order['shipping_state'] == 'CA') {
                    $order['tax'] = sprintf('%01.2f', $shop['Order']['subtotal'] * 0.095);
                    $order['total'] = sprintf('%01.2f', $shop['Order']['subtotal'] + $order['tax']);
                } else {
                    $order['tax'] = 0;
                    $order['total'] = $shop['Order']['subtotal'];
                }

                $this->request->session()->write('Shop.Order', $order + $shop['Order']);
                return $this->redirect(['action' => 'review']);
            } else {
                $this->Flash->error('The form could not be saved. Please, try again.');
            }
        } else {
            if(!empty($shop['Order'])) {
                $this->request->data = $shop['Order'];
            }
        }
        $this->set(compact('order'));
    }

////////////////////////////////////////////////////////////////////////////////

    public function review()
    {
        $shop = $this->Cart->getcart();
        if(!$shop['Order']['total']) {
            return $this->redirect('/');
        }
        $this->set(compact('shop'));

        $order = $this->Orders->newEntity($shop['Order']);

        if ($this->request->is('post')) {

            $order = $this->Orders->patchEntity($order, $this->request->data, ['validate' => 'review']);

            $order->ip_address = $this->request->clientIp();
            $order->remote_host = gethostbyaddr(env('REMOTE_ADDR'));
            $order->referer_cookie = $this->Cookie->read('referer_cookie');
            $order->referer_session = $this->request->session()->read('referer_session');
            $order->request_uri = $this->Cookie->read('request_uri');

            $order->creditcard_number = substr($this->request->data['creditcard_number'], 0, 12);

            $ordersave = $this->Orders->save($order);

            if ($ordersave) {

                $orderproducts = $this->Orders->Orderproducts->newEntities($shop['Orderproducts']);

                foreach ($orderproducts as $orderproduct) {
                    $orderproduct['order_id'] = $ordersave->id;
                    $this->Orders->Orderproducts->save($orderproduct);
                }

                $email = new Email();

                $email->from(['info@domain.com' => 'domain'])
                    ->transport('default')
                    ->sender('info@domain.com', 'domain')
                    ->domain('www.domain.com')
                    ->emailFormat('html')
                    ->to('info@domain.com')
                    ->subject('Website Order')
                    ->template('order', 'default')
                    ->viewVars(['shop' => $shop, 'order' => $order])
                    ->send();

                $email->from(['web@domain.com' => 'domain'])
                    ->transport('default')
                    ->sender('web@domain.com', 'domain')
                    ->domain('www.domain.com')
                    ->emailFormat('html')
                    ->to($order->email)
                    ->subject('Website Order')
                    ->template('order', 'default')
                    ->viewVars(['shop' => $shop, 'order' => $order])
                    ->send();

                return $this->redirect(['action' => 'success']);
            } else {
                $this->Flash->error('The order could not be placed. Please, try again.');
            }
        }
        $this->set(compact('order'));
    }

////////////////////////////////////////////////////////////////////////////////

    public function success()
    {
        $shop = $this->Cart->getcart();
        $this->Cart->clear();
        if(empty($shop)) {
            return $this->redirect('/');
        }
        $this->set(compact('shop'));
    }

////////////////////////////////////////////////////////////////////////////////

}
