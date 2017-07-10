<?php
App::uses('AppModel', 'Model');

class Provider extends AppModel {
    
    public $hasMany = array(
        'Order' => array(
            'className'  => 'Order',
            'foreignKey' => 'provider_id',
        ),
    );    
    
//    public function getList(){
//        $list = $this->find('list', array(
//            'fields' => array('id', 'name')
//        ));
//        return $list;
//    }
}