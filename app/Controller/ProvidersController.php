<?php
App::uses('AppController', 'Controller');

class ProvidersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function admin_add() {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        $this->seo['title'] = __(Configure::read('BROWSER_TITLE_FORMAT'), 
                              __('Agregar Proveedor'), 
                              Configure::read('SITE_NAME'));
        
        if ($this->request->is('post')
                or $this->request->is('put')) {
            
            $now = date('Y-m-d H:i:s');
            $this->request->data['Provider']['created']  = $now;
            $this->request->data['Provider']['modified'] = $now;
            $this->request->data['Provider']['status']   = 'active';
            $this->request->data['Provider']['name']     = strtolower($this->request->data['Provider']['name']);
            
            $this->Provider->create();
            if ($this->Provider->save($this->request->data)) {
                    $this->Flash->set(__('El proveedor ha sido agregado correctamente'));
                    return $this->redirect(array(
                        'controller' => 'providers',
                        'action' => 'index'));
            }
            $this->Flash->set(__('Error. Intente nuevamente.'));
        }
        
        $this->render('admin/add');
    }
    public function admin_edit($id = null) {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        $this->seo['title'] = __(Configure::read('BROWSER_TITLE_FORMAT'), 
                              __('Editar Producto'), 
                              Configure::read('SITE_NAME'));
        
        

        $this->Provider->Behaviors->attach('Containable');
        $this->Provider->contain('Order');
        $provider = $this->Provider->read(null, $id);
        
        if (!$provider) {
            throw new NotFoundException(__('No existe proveedor'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Provider->id = $id;
            
            // primero guardo los cambios en el producto
            if ($this->Provider->save($this->request->data)) {
                
                $this->Flash->success(__('Los datos del proveedor han sido editado correctamente'));
                return $this->redirect(array('action' => 'index'));
                
            }
            $this->Flash->error(__('No se ha podido editar el proveedor'));
        }

        if (!$this->request->data) {
            $this->request->data = $provider;
        }
        
        $this->render('admin/edit');
    }
    
    public function admin_index() {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        $this->seo['title'] = __(Configure::read('BROWSER_TITLE_FORMAT'), 
                              __('Listado de Productos'), 
                              Configure::read('SITE_NAME'));
        
        $providers = $this->Provider->find('all', array(
            'conditions' => array('Provider.status' => 'active'),
            'order' => array('Provider.id' => 'DESC'),
            'contain' => array('Orders')
        ));
        
//        pr($products);die;
        
        $this->set('providers', $providers);
        
        $this->render('admin/index');
    }
    
    public function admin_view($id = null) {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        $this->seo['title'] = __(Configure::read('BROWSER_TITLE_FORMAT'), 
                              __('Ficha del proveedor'), 
                              Configure::read('SITE_NAME'));
        
//        $this->layout = 'admin';
        
//        $this->Product->recursive = 0;
        $this->Provider->Behaviors->attach('Containable');
        $this->Provider->contain('Order');        
        $provider = $this->Provider->read(null, $id);
//        $products = $this->Product->find('all', array(
//            'conditions' => array('Product.status' => 'active')
//        ));
//        pr($product);die;
        $this->set('provider', $provider);
        
        $this->render('admin/view');
    }
    
    public function admin_delete($id = null) {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $this->Provider->id = $id;
            if ($this->Provider->saveField('status','inactive')) {
                $this->Flash->success(__('El proveedor ha sido eliminado correctamente'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('No se ha podido eliminar el proveedor'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    
}