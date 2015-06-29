<?php

App::uses('AppController', 'Controller');

class LogsController extends AppController {


	//public $components 	= array('Paginator');
	public $uses 		= array('Log');
	//public $paginate	= array('limit' => 8);
	//public $paginate	= array('conditions'=>array('Product.status <> 0'),'limit' => 7,'order'=>'product_id desc');

	public function index() {
		//$this->Product->recursive = 0;
		//$this->Paginator->settings = $this->paginate;
		//$this->set('products', $this->Paginator->paginate());
	}			
	

	public function sanitizeInput( $in )
	{
	    $out = trim( $in ); // Kills needless whitespace
		$out = strip_tags( $out ); // Kills html tags

		// if magic quotes is not enabled addslashes to protect from sql injection
		if (!get_magic_quotes_gpc())
		{
	    	$out = addslashes( $out );
		}
		$out= htmlentities( $out );
		return $out;
	}
	
}