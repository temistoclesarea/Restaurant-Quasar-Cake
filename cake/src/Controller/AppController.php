<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email', // autentica pelo email
                    ],
                ],
                'ADmad/JwtAuth.Jwt' => [
                    'fields' => [
                        'username' => 'id', // fica autenticado pelo id, assim continua logado mesmo mudando email
                    ],
                ],
            ],
        ]);

        $this->response = $this->response // response é imutavel, só pode ser substituido completamente
            ->cors($this->request)
            ->allowOrigin(['*']) // ex. ['http://site.com','192.160.86.45']
            ->allowHeaders(['*']) // ex. ['Autorization']
            ->allowMethods(['*']) // ex. ['GET','POST']
            ->build(); // refazer todo o response

        if ($this->request->is('options')) { // tem que liberar, porque se a original for bloqueada, não será executada
            $this->Auth->allow();
        }

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
}
