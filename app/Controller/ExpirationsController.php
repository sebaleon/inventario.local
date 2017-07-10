<?php
App::uses('AppController', 'Controller');

class ExpirationsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_index() {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
            if (!$this->Acl->isAuthorized()) {
                $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'message message-error'));
                $this->redirect();
            }
            
        $this->seo['title'] = __(Configure::read('BROWSER_TITLE_FORMAT'), 
                              __('Listado de Vencimientos'), 
                              Configure::read('SITE_NAME'));
        
        $expirations = $this->Expiration->find('all', array(
            'conditions' => array('Expiration.status' => 'active',
								  'Expiration.date_exp >=' => date('Y-m-d'),
                                  'Expiration.type'   => 'now'),
            'order' => array('Expiration.date_exp' => 'DESC'),
        ));
        
        $this->set('expirations', $expirations);
        
        $this->render('admin/index');
    }

    public function admin_add() {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        $this->seo['title'] = __(Configure::read('BROWSER_TITLE_FORMAT'), 
                      __('Agregar Fecha de Vencimiento'), 
                      Configure::read('SITE_NAME'));

        if ($this->request->is('post')
                or $this->request->is('put')) {
            
            $this->request->data['Expiration']['status']   = 'active';
            
            $newDateExp = date('Y-m-d', strtotime($this->request->data['Expiration']['date_exp']));
            
            $now = $newDateExp;
            $sevenDaysLess = strtotime('-7 days', strtotime($newDateExp));
            $threeDaysLess = strtotime('-3 days', strtotime($newDateExp));
            $oneDaysLess   = strtotime('-1 days', strtotime($newDateExp));
            
            $sevenDaysLess = date('Y-m-d', $sevenDaysLess);
            $threeDaysLess = date('Y-m-d', $threeDaysLess);
            $oneDaysLess   = date('Y-m-d', $oneDaysLess); 
            
            $datesExp = array(
                'now'   => $now,
                'one'   => $oneDaysLess,
                'three' => $threeDaysLess,
                'seven' => $sevenDaysLess
            );
            
            // hash para poder eliminar todas las alertas
            $hash_delete = md5($this->request->data['Expiration']['description'].$newDateExp.date('Y-m-d H:i:s'));
            $this->request->data['Expiration']['hash_delete'] = $hash_delete;
            
            $i = 0;
            foreach ($datesExp as $type => $date) {
////                pr($date);die;
                $this->Expiration->create();
                $this->request->data['Expiration']['date_exp'] = $date;
                $this->request->data['Expiration']['type'] = $type;
                if ($this->Expiration->save($this->request->data)) {
                    $i++;
                }
            }
            
            if ($i == 4) { // porque guardo 4 fechas
                $this->Flash->success(__('La fecha de vencimiento ha sido creada. Puede agregar otra.'));
                return $this->redirect(array('action' => 'add'));
            } else {
                $this->Flash->danger(__('Error. Intente nuevamente.'));
            }
            
//            return $this->redirect(array('action' => 'add'));
        }
        $this->request->data['Expiration']['date_exp'] = '';
        $this->render('admin/add');
    }
    
    public function admin_edit($id = null) {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        $this->Expiration->id = $id;
        //Verifico que exista el ticket
        if (!$this->Expiration->exists()) {
            throw new NotFoundException(__('No existe la fecha de vencimiento que intenta editar'));
        }
        
        if ($this->request->is('post')
            or $this->request->is('put')) {
            
            $newDateExp = date('Y-m-d', strtotime($this->request->data['Expiration']['date_exp']));
            
            $now = $newDateExp;
            $sevenDaysLess = strtotime('-7 days', strtotime($newDateExp));
            $threeDaysLess = strtotime('-3 days', strtotime($newDateExp));
            $oneDaysLess   = strtotime('-1 days', strtotime($newDateExp));
            
            $sevenDaysLess = date('Y-m-d', $sevenDaysLess);
            $threeDaysLess = date('Y-m-d', $threeDaysLess);
            $oneDaysLess   = date('Y-m-d', $oneDaysLess); 
            
            $datesExp = array(
                'now'   => $now,
                'one'   => $oneDaysLess,
                'three' => $threeDaysLess,
                'seven' => $sevenDaysLess
            );
            
            $i = 0;
            foreach ($datesExp as $type => $date) {
////                pr($date);die;
                $this->Expiration->create();
                $this->request->data['Expiration']['date_exp'] = $date;
                $this->request->data['Expiration']['type'] = $type;
                if ($this->Expiration->save($this->request->data)) {
                    $i++;
                }
            }
            
            if ($i == 4) { // porque guardo 4 fechas
                $this->Flash->success(__('La fecha de vencimiento ha sido creada. Puede agregar otra.'));
                return $this->redirect(array('action' => 'add'));
            } else {
                $this->Flash->danger(__('Error. Intente nuevamente.'));
            }
            
        } else {
            $this->request->data = $this->Expiration->read(null, $id);
            $newDateExp = date('d-m-Y', strtotime($this->request->data['Expiration']['date_exp']));
            $this->request->data['Expiration']['date_exp'] = $newDateExp;
        }
        
//        $this->set('data', $data);
        $this->render('admin/edit');
    }
    
    public function admin_delete($id) {
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        if ($this->request->is(array('post', 'put'))) {
            
            $expiration = $this->Expiration->read(null, $id);
            
            if ($this->Expiration->deleteAll(array('Expiration.hash_delete' => $expiration['Expiration']['hash_delete']))) {
                $this->Flash->success(__('La fecha de vencimiento ha sido eliminada correctamente'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('No se ha podido eliminar la fecha de vencimiento'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
    
    public function admin_updateExpiration(){
        // Se define el nivel de acceso al metodo
        $this->Acl->aro = array('root', 'admin');
        if (!$this->Acl->isAuthorized()) {
            $this->Session->setFlash(Configure::read('ACL_ERROR'), 'default', array('class' => 'alert alert-error'));
            $this->redirect($this->referer());
        }
        
        if ($this->request->is('post')
            or $this->request->is('put')) {
            
            $this->Expiration->id = $this->data['id'];
            $this->Expiration->saveField('status', 'inactive');
        }        
        die;
    }

}

