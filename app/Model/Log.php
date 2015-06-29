<?php
App::uses('AppModel', 'Model');
/**
 * Role Model
 *
 * @property Role $Role
 * @property Role $Role
 */
class Log extends AppModel {

    public $primaryKey = 'role_id';
    
    public $validate = array(
		'id' => array(
			'numeric' => array( 'rule' => array('numeric'),	),
		),
		'user_id' => array(
			'numeric' => array( 'rule' => array('numeric'),	),
		),		
	);

	public function addLogEntry( $data = array() ) {
		$this->autoRender =  false;
		//debug($this->Auth->user());
		
		if (!empty ( $_SERVER['REMOTE_ADDR'] ) )
			$logData['Log']['remote_addr'] 	=  $_SERVER['REMOTE_ADDR'];		

		//$authUserId =  CakeSession::read("Auth.User.id") ;

		$userData['user_id'] 			 	= (empty ( $data['Log']['user_id'] ) ? 404 : $data['Log']['user_id']);

		$logData['Log']['login_request'] 	= (empty ( $data['Log']['login_request']) ? 0 : $data['Log']['login_request']);
		
		$logData['Log']['attribute_id']		= (empty ( $data['Log']['attribute_id']) ? 0 : $data['Log']['attribute_id']);

		$logData['Log']['product_id']		= (empty ( $data['Log']['product_id']) ? 0 : $data['Log']['product_id']);	

		$logData['Log']['category_id']		= (empty ( $data['Log']['category_id']) ? 0 : $data['Log']['category_id']);

		$logData['Log']['brand_id']			= (empty ( $data['Log']['brand_id']) ? 0 : $data['Log']['brand_id']);
		
		$logData['Log']['question_id']		= (empty ( $data['Log']['question_id']) ? 0 : $data['Log']['question_id']);	

		if ( empty ( $data['Log']['action'] ) )
			$logData['Log']['action']		= "No action found by ". $userData['user_id'];	
		else
			$logData['Log']['action']		= $data['Log']['action']. $userData['user_id'];


		$logData['Log']['user_id'] 			= $userData['user_id']; 		
		$logData['Log']['log_date']			= date('Y-m-d H:i:s');

		//debug ( $data ); debug ( $logData ); 	
		
		$this->save( $logData );

	}

}
