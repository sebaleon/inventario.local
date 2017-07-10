<?php
App::uses('AppModel', 'Model');

class Expiration extends AppModel {
    
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);      
        
        $this->validate = array(
            'id' => array(
                'required' => array(
                    'rule'    => 'notEmpty',
                   ),
            'numeric' => array(
                'rule'    => 'numeric',
                ),
            'unique' => array(
                'rule'    => 'isUnique',
                ),
            ),        
            'description' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'Campo obligatorio'
                ),
            ),
            'date_exp' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'Campo obligatorio'
                ),
            ),
            'status' => array(
                'valid' => array(
                    'rule' => array('inList', array('active', 'inactive')),
                    'message' => 'Status no valido',
                    'allowEmpty' => false
                )
            ),
        );      
        
    }      
    
    public function getList(){
        $list = $this->find('list', array(
            'fields' => array('id', 'name')
        ));
        return $list;
    }
    
    public function createAlert(){
        $now = date('Y-m-d');
        $expirations = $this->find('all', array(
            'conditions' => array('date_exp' => $now,
                                  'status' => 'active'
                )
        ));
        return $expirations;        
    }
}

