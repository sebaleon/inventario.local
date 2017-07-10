<?php
App::uses('AppModel', 'Model');

class Product extends AppModel {
    
    public $hasOne = array(
        'Price' => array(
            'className'  => 'Price',
            'foreignKey' => 'product_id',
        ),
    );
    
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);      
        
        $this->validate = array(
            'id' => array(
                'required' => array(
                    'rule'    => 'notBlank',
                   ),
            'numeric' => array(
                'rule'    => 'numeric',
                ),
            'unique' => array(
                'rule'    => 'isUnique',
                ),
            ),        
            'name' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'Ingrese una marca y su descripcion'
                ),
            ),
            'code' => array(
                 'safeChars' => array(
                     'rule'    => Configure::read('PHP_REGEXP_SAFE_CHARS'),
                     'message' => __d('user', 'Ha ingresado caracteres no válidos')
                 )
            ),
            'presentation' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'Seleccione una presentacion'
                ),
                'valid' => array(
                    'rule' => array('inList', array_keys(Configure::read('PRESENTATION_TYPES'))),
                    'message' => 'Seleccione un tipo de presentacion valido',
                    'allowEmpty' => false
                )
            ),
            'quantity' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'Ingrese cantidad de contenido'
                ),
                 'safeChars' => array(
                     'rule'    => Configure::read('PHP_REGEXP_SAFE_CHARS'),
                     'message' => __d('user', 'Ha ingresado caracteres no válidos')
                 )
            ),
            'cost_price' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'Ingrese un precio de costo'
                ),
                 'quant' => array(
                     'rule' => array('decimal'),
                     'message' => __d('user', 'Debe ingresar solo numeros')
                 )
            ),
            'sale_price' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'Ingrese precio de venta'
                ),
                 'quant' => array(
                     'rule' => array('decimal'),
                     'message' => __d('user', 'Debe ingresar solo numeros')
                 )
            ),
            /*'price_per_grams' => array(
                'grams' => array(
                    'rule' => array('decimal'),
                    'message' => __d('user', 'Debe ingresar solo numeros')
                )
            ),*/
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
}

