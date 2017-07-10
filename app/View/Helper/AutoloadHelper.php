<?php

App::uses('AppHelper', 'View/Helper');

class AutoloadHelper extends AppHelper
{

    private $_options = array('path' => 'scripts');

    private $action = null;

    private $controller = null;

    private $model = null;

    private $models = null;

    private $View;

    public $helpers = array('Html', 'Session');

    private function __loadScripts()
    {
        extract($this->_options);
        if (!empty($path)) {
            $path .= DS;
        }
        $files = array($this->controller . '.js',
                       $this->controller . DS . $this->action . '.js');
        if (preg_match('/(add|edit)$/', $this->action)) {
            $files[] = $this->controller . DS 
                     . str_replace(array('add', 'edit'),array('form', 'form'), $this->action) 
                     . '.js';
        }
        foreach ($files as $file) {
            $file = $path . $file;
            $includeFile = JS . $file;
            if (file_exists($includeFile)) {
                $file = str_replace(DS, '/', $file);
                $this->Html->script($file, array('block' => 'script'));
            }
        }
    }

//    private function __loadSearch($model)
//    {
//        $filename = APP . 'View' . DS . 'Elements' . DS . 'Search' . DS 
//                  . Inflector::pluralize($model) . '.ctp';
//        $element = 'Search' . DS . Inflector::pluralize($model);
//        if (strtolower(Inflector::pluralize($model)) == strtolower($this->controller) 
//            and preg_match('/index$/', strtolower($this->action))
//            and file_exists($filename)
//        ) {
//            $this->View->append('search');
//            echo $this->View->element($element);
//            $this->View->end();
//        }
//    }
//
//    private function __loadSidebar()
//    {
//        
//        if ( $this->Session->read('Auth.User.role') == 'admin' ) {
//            $role = 'admin';
//            if ($this->Session->read('Auth.User.group') == 'agent') {
//                $sidebar_menu = Configure::read('SIDEBAR_MENU_AGENT');
//            } else {
//                $sidebar_menu = Configure::read('SIDEBAR_MENU_ADMIN');
//            }
//        } else {
//            $role = 'user';
//            $sidebar_menu = Configure::read('SIDEBAR_MENU_USER');
//        }
//        
//        foreach ($sidebar_menu as $menu) {
//            
//            $filename = APP . 'View' . DS . 'Elements' . DS . 'Sidebar' . DS . $role . DS 
//                      . $menu . '.ctp';
//            $element = 'Sidebar' . DS . $role . DS . $menu;
//            
//            if (file_exists($filename)) {
//                $this->View->append('sidebar');
//                echo $this->View->element($element);
//                $this->View->end();
//            }
//        }
//    }
//
//    private function __loadTopbar($model)
//    {
//        $filename = APP . 'View' . DS . 'Elements' . DS . 'Topbar' . DS 
//                  . Inflector::pluralize($model) . '.ctp';
//        $element = 'Topbar' . DS . Inflector::pluralize($model);
//        /*
//        VER TOPBAR / SIDEBAR - achavazza@eniti.es
//        if (file_exists($filename)) {
//            $this->View->append('topbar');
//            echo $this->View->element($element);
//            $this->View->end();
//        }*/
//    }


    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
        $this->View =& $View;
        $this->_options = am($this->_options, $settings);
    }

    public function beforeRender($viewFile) {
        $this->controller = $this->request->params['controller'];
        $this->model = ucfirst(Inflector::singularize($this->controller));
        $this->action = $this->request->params['action'];
//        // Listo los modelos disponibles
        $this->models = App::objects('model');
//        $controller = $this->request->params['controller'];
//        $action = $this->request->params['action'];
        // Incorpora los scripts automaticamente
        $this->__loadScripts();
        // Incorpora los elementos del sidebar automaticamente
//        $this->__loadSidebar();
//        foreach ($this->models as $model) {
//            // Incorpora los elementos del topbar automaticamente
//            $this->__loadTopbar($model);
//            // Incorpora los elementos del search automaticamente
//            $this->__loadSearch($model);
//        }
    }

}
