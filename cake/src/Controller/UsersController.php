<?php
namespace App\Controller;

use App\Controller\AppController;
use Firebase\JWT\JWT;
use Cake\Utility\Security;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow([
            'login',
            'add',
        ]);
    }


    public function login()
    {
        $this->request->allowMethod(['post']);

        $user = $this->Auth->identify(); //identifica se for o email ou a senha de algum usuario, ele autentica

        if ($user) {
            $this->Auth->setUser($user); // usuario autenticado
            $data = [
                'token' => JWT::encode([
                    'sub' => $user['id'], // valor que vai codificar
                    'ext' => time() + 3600 * 24 * 1, // tempo de vida para o token expirar
                ], Security::salt()),
            ];

            $this->set([
                'data' => $data,
                '_serialize' => ['data'],
            ]);
        } else {
            $this->response = $this->response->withStatus(400);
            $this->set([
                'message' => 'Usuário ou senha inválidos',
                '_serialize' => ['message'],
            ]);
        }
    }


    public function me()
    {
        $user = $this->Auth->user();
        $this->set([
            'user' => $user,
            '_serialize' => ['user'],
        ]);
    }


    public function add()
    {
        $this->request->allowMethod(['post']);

        $user = $this->Users->newEntity();

        $user = $this->Users->patchEntity($user, $this->request->getData());

        if (count($user->errors()) > 0) {
            $this->response = $this->response->withStatus(422);
            $this->set([
                'errors' => $user->errors(),
                '_serialize' => ['errors'],
            ]);
            return;
        }

        $this->Users->save($user);

        $this->set([
            'user' => $user,
            '_serialize' => ['user'],
        ]);
    }
}
