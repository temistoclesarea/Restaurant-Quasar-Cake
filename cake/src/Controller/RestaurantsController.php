<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Uploader\Uploader;


class RestaurantsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->Auth->allow(['search', 'view']);
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Addresses'],
            'conditions' => [
                'Restaurants.user_id' => $this->Auth->user('id'),
            ],
        ];
        $restaurants = $this->paginate($this->Restaurants);

        $this->set([
            'restaurants' => $restaurants,
            '_serialize' => [
                'restaurants',
            ],
        ]);
    }


    public function view($id = null)
    {
        $restaurant = $this->Restaurants->get($id, [
            'contain' => ['Addresses'],
        ]);

        $this->set([
            'restaurant' => $restaurant,
            '_serialize' => [
                'restaurant',
            ],
        ]);
    }


    public function add()
    {
        $restaurant = $this->Restaurants->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->Auth->user('id');
            $data['photo'] = Uploader::handler($data['photo'], 'restaurants');
            $restaurant = $this->Restaurants->patchEntity($restaurant, $data);

            unset($data['user_id']);
            $address = $this->Restaurants->Addresses->newEntity();
            $address = $this->Restaurants->Addresses->patchEntity($address, $data);

            $restaurant->address = $address;

            $this->Restaurants->save($restaurant);
        }

        $this->set([
            'restaurant' => $restaurant,
            '_serialize' => [
                'restaurant',
            ],
        ]);
    }


    public function edit($id = null)
    {
        $restaurant = $this->Restaurants->get($id, [
            'contain' => ['Addresses'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // impede que o usuario troque o id do user
            if (!empty($data['user_id'])) {
                unset($data['user_id']);
            }

            // se ele for um array, ele esta tentando fazer upload
            if (is_array($data['photo'])) {
                $data['photo'] = Uploader::handler($data['photo'], 'restaurants');
            }

            $restaurant = $this->Restaurants->patchEntity($restaurant, $data);
            $restaurant->address = $this->Restaurants->Addresses->patchEntity($restaurant->address, $data);

            $this->Restaurants->save($restaurant);
        }

        $this->set([
            'restaurant' => $restaurant,
            '_serialize' => [
                'restaurant',
            ],
        ]);
    }


    public function search()
    {
        $this->paginate = [
            'contain' => ['Addresses', 'Plates'],
            'conditions' => [
                'or' => [
                    'Addresses.city' => $this->request->query('term'),
                    'Addresses.neighborhood' => $this->request->query('term'),
                ],
            ],
        ];
        $restaurants = $this->paginate($this->Restaurants);

        $this->set([
            'restaurants' => $restaurants,
            '_serialize' => [
                'restaurants',
            ],
        ]);
    }


    /* public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $restaurant = $this->Restaurants->get($id);
        if ($this->Restaurants->delete($restaurant)) {
            $this->Flash->success(__('The restaurant has been deleted.'));
        } else {
            $this->Flash->error(__('The restaurant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    } */
}
