<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Uploader\Uploader;

/**
 * Plates Controller
 *
 * @property \App\Model\Table\PlatesTable $Plates
 *
 * @method \App\Model\Entity\Plate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlatesController extends AppController
{

    public function index($restaurant_id)
    {
        $this->paginate = [
            'contain' => ['PlateOptions'],
            'conditions' => [
                'restaurant_id' => $restaurant_id,
            ],
        ];
        $plates = $this->paginate($this->Plates);

        $this->set([
            'plates' => $plates,
            '_serialize' => ['plates'],
        ]);
    }


    public function view($id = null)
    {
        $plate = $this->Plates->get($id, [
            'contain' => ['PlateOptions'],
        ]);

        $this->set([
            'plate' => $plate,
            '_serialize' => ['plate'],
        ]);
    }


    public function add()
    {
        $plate = $this->Plates->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // se ele for um array, ele esta tentando fazer upload
            if (is_array($data['photo'])) {
                $data['photo'] = Uploader::handler($data['photo'], 'plates');
            }

            $plate = $this->Plates->patchEntity($plate, $data);

            $this->Plates->save($plate);

            if (isset($data['options'])) {
                $this->options($plate->id, $data['options']);
            }
        }
        $this->set([
            'plate' => $plate,
            '_serialize' => ['plate'],
        ]);
    }


    public function edit($id = null)
    {
        $plate = $this->Plates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // se ele for um array, ele esta tentando fazer upload e precisa ser um array
            if (is_array($data['photo']) and is_array($data['photo'])) {
                $data['photo'] = Uploader::handler($data['photo'], 'plates');
            }

            $plate = $this->Plates->patchEntity($plate, $data);
            $this->Plates->save($plate);

            if (isset($data['options'])) {
                $this->options($plate->id, $data['options']);
            }
        }

        $this->set([
            'plate' => $plate,
            '_serialize' => ['plate'],
        ]);
    }


    protected function options($plate_id, $options)
    {
        $options = json_decode($options, true);
        $this->Plates->PlateOptions->deleteAll([
            'plate_id' => $plate_id,
        ]);

        foreach ($options as $option) {
            $data['title'] = $option;
            $data['plate_id'] = $plate_id;
            $entity = $this->Plates->PlateOptions->newEntity();
            $entity = $this->Plates->PlateOptions->patchEntity($entity, $data);
            $this->Plates->PlateOptions->save($entity);
        }
    }


    /* public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plate = $this->Plates->get($id);
        if ($this->Plates->delete($plate)) {
            $this->Flash->success(__('The plate has been deleted.'));
        } else {
            $this->Flash->error(__('The plate could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    } */
}
