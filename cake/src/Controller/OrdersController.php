<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\UnauthorizedException;

class OrdersController extends AppController
{

    public function index()
    {
        // http://localhost:8765/orders.json?restaurant=5
        $restaurant_id = $this->request->getQuery('restaurant');

        $restaurant = $this->Orders->Restaurants->find('all', [
            'conditions' => [
                'Restaurants.user_id' => $this->Auth->user('id'),
                'id' => $restaurant_id,
            ],
        ])->first();

        if (!$restaurant and !$restaurant_id) { // BUG: bug na condição em pedidos restaurant e meus pedidos - corrigir
            throw new UnauthorizedException; //XXX: força um erro de autorização se não exitir restaurante
        }
        $this->paginate = [
            'contain' => ['Restaurants', 'Addresses', 'Users'],
            'conditions' => [
                'or' => [
                    'Orders.user_id' => $this->Auth->user('id'),
                    'Orders.restaurant_id' => $restaurant_id,
                ],
            ]
        ];
        $orders = $this->paginate($this->Orders);

        $this->set([
            'orders' => $orders,
            '_serialize' => ['orders'],
        ]);
    }


    public function view($id = null) //XXX: cuidado com o "options"
    {
        if ($this->request->is('get')) { // "Options" não passa parametro corretamente para o controller
            $order = $this->Orders->get($id, [
                'contain' => ['Restaurants', 'Addresses', 'Users', 'PlatesOrders'],
                'conditions' => [
                    'Orders.user_id' => $this->Auth->user('id'),
                ],
            ]); 
        } else {
            $order = $this->Orders->newEntity(); // Envia uma entidade vazia para não passar uma variavel nula
        }

        $this->set([
            'order' => $order,
            '_serialize' => ['order'],
        ]);
    }


    public function add()
    {
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->Auth->user('id');
            $order = $this->Orders->patchEntity($order, $data);
            $this->Orders->save($order);
        }
        
        $this->set([
            'order' => $order,
            '_serialize' => ['order'],
        ]);
    }


    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['PlatesOrders'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            $this->Orders->save($order);
        }
        
        $this->set([
            'order' => $order,
            '_serialize' => ['order'],
        ]);
    }

 
    /* public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    } */
}
