<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\UnauthorizedException;

class OrdersController extends AppController
{

    public function index()
    {
        // http://localhost:8765/orders.json?restaurant_id=5
        $restaurant_id = $this->request->getQuery('restaurant');

        $restaurant = $this->Orders->Restaurants->find('first', [
            'conditions' => [
                'user-id' => $this->Auth->user('id'),
                'id' => $restaurant_id,
            ],
        ]);
        if (!$restaurant and $restaurant_id) {
            throw new UnauthorizedException; //XXX: obs
        }
        $this->paginate = [
            'contain' => ['Restaurants', 'Addresses', 'Users'],
            'conditions' => [
                'or' => [
                    'user_id' => $this->Auth->user('id'),
                    'restaurant_id' => $restaurant_id,
                ],
            ]
        ];
        $orders = $this->paginate($this->Orders);

        $this->set([
            'orders' => $orders,
            '_serialize' => ['orders'],
        ]);
    }


    public function view($id = null) //XXX: possivel problema com token via "options" que vai ser corrigido depois
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Restaurants', 'Addresses', 'Users', 'Plates'],
            'conditions' => [
                'Orders.user_id' => $this->Auth->user('id'),
            ],
        ]); 
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
            'contain' => ['Plates'],
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
