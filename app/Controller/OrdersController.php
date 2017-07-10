<?php
App::uses('AppController', 'Controller');

class OrdersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function admin_add($id = null) {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        $this->seo['title'] = __(Configure::read('BROWSER_TITLE_FORMAT'), 
                              __('Agregar Pedido'), 
                              Configure::read('SITE_NAME'));
        
        if ($this->request->is('post')
                or $this->request->is('put')) {
//            pr($this->request->data);die;
            $now = date('Y-m-d H:i:s');
            $this->request->data['Order']['created']  = $now;
            $this->request->data['Order']['modified'] = $now;
            $this->request->data['Order']['status']   = 'active';
            
            if (!empty($this->request->data['orderlist'])) {
                $this->request->data['Order']['orderlist'] = serialize($this->request->data['orderlist']);
            }
            
            $this->Order->create();
            if ($this->Order->save($this->request->data)) {
                $this->Flash->set(__('El pedido ha sido agregado'));
                return $this->redirect(array(
                    'controller' => 'providers',
                    'action' => 'index'));
            }
            $this->Flash->set(__('Error. Intente nuevamente.'));
        }
        
        Controller::loadModel('Provider');
        $provider = $this->Provider->read(null,$id);
        
        $this->set('provider', $provider);
        
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
        
//        $this->layout = 'admin';
        
        if (!$id) {
            throw new NotFoundException(__('No existe el producto seleccionado'));
        }

        $this->Product->Behaviors->attach('Containable');
        $this->Product->contain('Price');  
        $product = $this->Product->read(null, $id);
        if (!$product) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Product->id = $id;
            
//            pr($this->request->data);die;
            
            // primero guardo los cambios en el producto
            if ($this->Product->save($this->request->data)) {
                
                // guardo cambio en precios
                Controller::loadModel('Price');
                $this->Price->id = $this->request->data['Price']['id'];
//                $this->request->data['Price']['cost_price'] = $this->request->data['Price']['cost_price'];
//                $this->request->data['Price']['cost_price'] = $this->request->data['Price']['sale_price'];
//                $this->request->data['Price']['percentage_applied'] = $this->request->data['Price']['percentage'];
                
                // precio por gramos
                if (empty($this->request->data['Price']['price_per_grams'])) {
                    $this->request->data['Price']['price_per_grams'] = null;
                }                
                
                if ($this->Price->save($this->request->data)) {
                    $this->Flash->success(__('El producto ha sido editado correctamente'));
                    return $this->redirect(array('action' => 'index'));
                }
                
            }
            $this->Flash->error(__('No se ha podido editar el producto'));
        }

        if (!$this->request->data) {
            $this->request->data = $product;
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
        
        $products = $this->Product->find('all', array(
            'conditions' => array('Product.status' => 'active'),
            'order' => array('Product.id' => 'DESC'),
            'contain' => array('Price')
        ));
        
//        pr($products);die;
        
        $this->set('products', $products);
        
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
                              __('Ficha del producto'), 
                              Configure::read('SITE_NAME'));
        
//        $this->layout = 'admin';
        
//        $this->Product->recursive = 0;
        $this->Product->Behaviors->attach('Containable');
        $this->Product->contain('Price');        
        $product = $this->Product->read(null, $id);
//        $products = $this->Product->find('all', array(
//            'conditions' => array('Product.status' => 'active')
//        ));
//        pr($product);die;
        $this->set('product', $product);
        
        $this->render('admin/view');
    }
    
    public function admin_delete($id) {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $this->Product->id = $id;
            if ($this->Product->saveField('status','inactive')) {
                $this->Flash->success(__('El producto ha sido eliminado correctamente'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('No se ha podido eliminar el producto'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    
    
    public function admin_change_price($id = null){
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        $this->Product->Behaviors->attach('Containable');
        $this->Product->contain('Price');        
        
//        $priceHistory = array();
        if ($this->request->is(array('post', 'put'))) {
            
            $now = date('Y-m-d');
//            $now = date('2016-11-23');
            $product = $this->Product->read(null, $this->request->data['Product']['id']);
            $priceOld = $product['Price'];
            $priceHistory = unserialize($product['Price']['history']);
            
//            pr($priceHistory);die;
            
//            if (isset($priceHistory[$now])) {
//                unset($priceHistory[$now]);
//            }
            
            $priceHistory[$now][date('H:i:s')] = array(
                'cost_price' => $priceOld['cost_price'],
                'sale_price' => $priceOld['sale_price'],
                'percentage_applied' => $priceOld['percentage_applied'],
                'price_per_grams' => $priceOld['price_per_grams'],
            );
            
            krsort($priceHistory);
            
            // guardo nuevo price
            Controller::loadModel('Price');
            $this->Price->id = $priceOld['id'];
            $this->request->data['Price']['cost_price'] = $this->request->data['Product']['new_cost_price'];
            $this->request->data['Price']['sale_price'] = $this->request->data['Product']['new_sale_price'];
            $this->request->data['Price']['percentage_applied'] = $this->request->data['Product']['new_percentage_applied'];
            $this->request->data['Price']['price_per_grams'] = $this->request->data['Product']['new_price_per_grams'];
            $this->request->data['Price']['modify_date'] = $now;
            $this->request->data['Price']['history'] = serialize($priceHistory);
            
            if ($this->Price->save($this->request->data)) {
                $this->Flash->set(__('Correcto'));
                    return $this->redirect(array(
                        'controller' => 'products',
                        'action' => 'index'));
            }
            $this->Flash->set(__('Error'));
            
        }
        
        $product = $this->Product->read(null, $id);
        $this->set('product', $product);
        
        $this->render('admin/change_price');
    }
    
//    public function admin_change_price(){
//        // Se define el nivel de acceso al metodo
//        $this->Acl->aro = array('root', 'admin');
//        if (!$this->Acl->isAuthorized()) {
//            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
//            $this->redirect($this->referer());
//        }
//        
//        $ids = array();
//        if ($this->request->is(array('post', 'put'))) {
//            pr($this->request->data);die;
//            if (!empty($this->request->data)) {
////                pr($this->request->data);die;
//                $explo = explode(";", $this->request->data['Product']['ids']);
////                pr($explo);die;
//                foreach ($explo as $i => $id) {
//                    $ids[$id] = $id;
//                }
//            }
//        }
//        $products = $this->Product->find('all', array(
//            'conditions' => array('Product.id' => $ids)
//        ));
//        $this->set('products', $products);
//        $this->render('admin/change_price');
//        
//    }
    
    public function admin_change_prices(){
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        if ($this->request->is(array('post', 'put'))) {
//            pr($this->request->data);die;
            foreach ($this->request->data as $id => $prices) {
                $this->Product->id = $id;
                if (       $this->Product->saveField('list_price',$prices['list'])
                        && $this->Product->saveField('sale_price',$prices['sale'])) {
                    $this->Flash->success(__('Los precios han sido cambiados correctamente'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Flash->error(__('No se han podido cambiar los precios'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        
    }
    
//    public function admin_fast_edit() {
//        // Se define el nivel de acceso al metodo
//        $this->Acl->aro = array('root', 'admin');
//        if (!$this->Acl->isAuthorized()) {
//            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
//            $this->redirect($this->referer());
//        }
//        
//        pr($this->request);die;
//        
//        $this->layout = false;
//        
//        if ($this->request->is(array('post', 'put'))) {
//            $this->Product->id = $this->data['id'];
//            $this->request->data['Product']['names'] = $this->data['name'];
//            if ($this->Product->save($this->request->data)) {
//                die;
//            }
//        }
//        die;
////        die('Error');
//    }

}