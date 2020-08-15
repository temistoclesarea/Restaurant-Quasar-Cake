<?php
namespace App\Controller;

use App\Controller\AppController;


class AddressesController extends AppController
{
    
    public function index()
    {
        $this->paginate = [
            'conditions' => [
                'user_id' => $this->Auth->user('id'),
            ],
        ];
        $addresses = $this->paginate($this->Addresses);

        $this->set([
            'addresses' => $addresses,
            '_serialize' => [
                'addresses',
            ],
        ]);
    }

    
    public function add()
    {
        $address = $this->Addresses->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->Auth->user('id');
            $address = $this->Addresses->patchEntity($address, $data);
            $this->Addresses->save($address);
        }

        $this->set([
            'address' => $address,
            '_serialize' => [
                'address',
            ],
        ]);
    }
}
