<?php
// app/Controller/UsersController.php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'splash');
    }

    public function login() {
        
        $this->layout = 'login';
        
        $this->seo['title'] = __(Configure::read('BROWSER_TITLE_FORMAT'), 
                         __('Acceso de usuarios'), 
                         Configure::read('SITE_NAME'));
        
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->set(__('Usuario y/o contraseña incorrecta. Intente nuevamente.'));
        }
        if (!empty($this->Auth->user())){
             return $this->redirect($this->Auth->redirectUrl());
        }
//        $this->render('login');
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function admin_add() {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->set(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->set(
                __('The user could not be saved. Please, try again.')
            );
        }
        
        $this->render('admin/add');
    }

    public function admin_edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}
