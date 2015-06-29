<?php
/**
 * Application level Controller 
 * This file is application-wide controller file. You can put all application-wide controller-related methods here.
  */
App::uses('Controller', 'Controller');


class AppController extends Controller {    

	public $helpers		= array('Custom');                     
     
     
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'attributes', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
        )
    );

    public function beforeFilter() {		
        Configure::load('site_config'); 		
	}
	
}
