<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
        public $components = array(
        'Session',
        'Flash',
        'Acl',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'products',
                'action' => 'index',
                'admin'  => true
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login',
                'admin'  => false
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
            'authorize' => array('Controller')
        ),
    );
        
    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }
    
        public $helpers = array(
        'Autoload',
        'Form',
        'Html',
        'Number',
        'Time',
        'Paginator',
        'Session',
    );

    /**
     * Setea un layout dependiendo del prefix usado actualmente
     * @return void
     */
//    public function autoLayout() {
//        if (isset($this->request->params['prefix'])) {
//            $this->layout = $this->request->params['prefix'];
//        } else {
//            $this->layout = "public";
//        }
//        return $this;
//    }

    public $seo = array();
    
    public function beforeFilter() {
        parent::beforeFilter();
        // Configuraciones del AuthComponent
        $this->Auth->authError = Configure::read('ACL_ERROR');
        //$this->Auth->allow('index', 'view');
    }
    public function beforeRender() {
        parent::beforeRender();
        // Configuraciones del AuthComponent
        $this->Auth->authError = Configure::read('ACL_ERROR');
        
        // creo alertas de fechas de vencimiento
        Controller::loadModel('Expiration');
        $alerts = $this->Expiration->createAlert();
		//pr($alerts);die;
        $this->set('alerts', $alerts);
        
        // Seteo los parámetros para el seo
        $this->set('seo', $this->seo);
    }
    
    public function redirect($url, $status = null, $exit = true) {
        
        if(is_null($this->Auth->user())){
            $url = array( 'controller' => 'users'
                        , 'action'     => 'login',
                          'admin'      => false);
        }
//        else{
//            $url = array( 'controller' => 'products' 
//                        , 'action'     => 'index'
//                        , $this->Auth->user('role') => true);
//        }

        parent::redirect($url, $status, $exit);
    }
}
