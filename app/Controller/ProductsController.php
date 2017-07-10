<?php
App::uses('AppController', 'Controller');

class ProductsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function admin_testboot() {
        
//        $this->layout = 'admin';
        $this->render('admin/testboot');
    }
    
    public function admin_add() {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        $this->seo['title'] = __(Configure::read('BROWSER_TITLE_FORMAT'), 
                              __('Agregar Producto'), 
                              Configure::read('SITE_NAME'));
        
        if ($this->request->is('post')
                or $this->request->is('put')) {
            
            $now = date('Y-m-d H:i:s');
            $this->request->data['Product']['created']  = $now;
            $this->request->data['Product']['modified'] = NULL;
            $this->request->data['Product']['status']   = 'active';
            $this->request->data['Product']['name'] = strtolower($this->request->data['Product']['name']);
            
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
                $lastId = $this->Product->getLastInsertId();
                // guardo precio en la tabla prices
                Controller::loadModel('Price');
                $this->Price->create();
                $this->request->data['Price']['product_id'] = $lastId;
                $this->request->data['Price']['cost_price'] = $this->request->data['Product']['cost_price'];
                $this->request->data['Price']['sale_price'] = $this->request->data['Product']['sale_price'];
                $this->request->data['Price']['percentage_applied'] = $this->request->data['Product']['percentage'];
                $this->request->data['Price']['price_per_grams'] = $this->request->data['Product']['price_per_grams'];
                
                if ($this->Price->save($this->request->data)) {
                    $this->Flash->success(__('El producto ha sido agregado correctamente'));
                    return $this->redirect(array(
                        'controller' => 'products',
                        'action' => 'index'));
                }
            }
                $this->Flash->danger(__('Error. Intente nuevamente.'));
        }
        
        // tipos de presentacion
        $presentations = Configure::read('PRESENTATION_TYPES');
        ksort($presentations);
        $this->set('presentations',$presentations);
        
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
        // seteo el historial de precios a la vista
        $priceHistory = unserialize($product['Price']['history']);
		//pr($priceHistory);die;
        if (!empty($priceHistory)) {            
            $this->set('beforePrice', $priceHistory); // seteo a la vista
        }
        
        if (!$product) {
            throw new NotFoundException(__('No existe el producto seleccionado'));
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $this->Product->id = $id;
            
			// fecha modificacion producto
			$this->request->data['Product']['modified'] = date('Y-m-d H:i:s');
            // primero guardo los cambios en el producto
            if ($this->Product->save($this->request->data)) {
                
                // guardo el precio si es que hay cambios en los precios o porcentaje
				$priceHistory = array();
                Controller::loadModel('Price');
                $priceOld = $this->Price->read(null, $this->request->data['Price']['id']);

                if (       ($priceOld['Price']['cost_price'] != $this->request->data['Price']['cost_price'])
                        or ($priceOld['Price']['sale_price'] != $this->request->data['Price']['sale_price'])
                        or ($priceOld['Price']['percentage_applied'] != $this->request->data['Price']['percentage_applied'])
                        or ($priceOld['Price']['price_per_grams'] != $this->request->data['Price']['price_per_grams']) 
                ) {
                    
					// guardo precio anterior
                    $priceHistory = array(
                        'cost_price' => $priceOld['Price']['cost_price'],
                        'sale_price' => $priceOld['Price']['sale_price'],
                        'percentage_applied' => $priceOld['Price']['percentage_applied'],
                        'price_per_grams' => $priceOld['Price']['price_per_grams']
                    );

                    // guardo nuevo price
                    $this->Price->id = $priceOld['Price']['id'];
                    $this->request->data['Price']['modify_date'] = date('Y-m-d H:i:s');
                    $this->request->data['Price']['history'] = serialize($priceHistory);

                    if ($this->Price->save($this->request->data)) {
                        $this->Flash->success(__('El producto y su precio ha sido editado'));
                            return $this->redirect(array(
                                'controller' => 'products',
                                'action' => 'index'));
                    }
                }
                
                $this->Flash->success(__('El producto ha sido editado'));
                    return $this->redirect(array(
                        'controller' => 'products',
                        'action' => 'index'));
                
            }
            
            $this->Flash->error(__('No se ha podido editar el producto'));
        }

        if (!$this->request->data) {
            $this->request->data = $product;
        }
        
        // tipos de presentacion
        $presentations = Configure::read('PRESENTATION_TYPES');
        ksort($presentations);
        $this->set('presentations',$presentations);
        
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
        $presentations = Configure::read('PRESENTATION_TYPES');
        $this->set('presentations', $presentations);
        
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

	public function admin_autoComplete($term = null){
		// Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
		
		$this->autoRender = false;
		$this->layout = 'ajax';
		
        $products = $this->Product->find('all', array(
            'conditions' => array('Product.name LIKE' => '%' . $this->request->query['term'] . '%'),
            'fields' => array('name', 'presentation', 'quantity')
        ));		
		
		$i = 0;
		$presentations = Configure::read('PRESENTATION_TYPES');
		foreach ($products as $product) {
			$suggestion = "{$product['Product']['name']} - {$presentations[$product['Product']['presentation']]} - {$product['Product']['quantity']}";
			$response[$i]['value'] = strtoupper($suggestion);
			$i++;
		}
		
		echo json_encode($response);
		
	}

}