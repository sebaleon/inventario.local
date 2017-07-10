<?php

App::uses('AuthComponent', 'Controller/Component');

class AclComponent extends Component 
{
    /**
     *  Roles que van a estar habilitados para ejecutar la acciÃ³n
     * @var array
     */
    public $aro = array();
    
    
    public function isAuthorized()
    {
        $role = AuthComponent::user('group');
        if (in_array($role, $this->aro))
        {
            return true;
        }
        return false;
    }
    
}