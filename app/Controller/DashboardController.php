<?php

App::uses('AppController', 'Controller');

class DashboardController extends AppController {

	public function beforeFilter(){
		$this->layout = 'default_dashboard';
	}

	public function index() {
		//$this->layout = 'default_dashboard';
		echo $this->Auth->password('eastpoint');
	}
	
}