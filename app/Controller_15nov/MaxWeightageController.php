<?php
App::uses('AppController', 'Controller');
/**
 * Roles Controller
 *
 * @property Role $Role
 * @property PaginatorComponent $Paginator
 */
class MaxWeightageController extends AppController {

	public $components = array('Paginator');	

	public function index() {
		$this->MaxWeightage->recursive = 0;		
		$this->set('max_weightages', $this->Paginator->paginate() );
	}
	
}
