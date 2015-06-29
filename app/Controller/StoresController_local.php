<?php
App::uses('AppController', 'Controller');
	
	
	class StoresController extends AppController {

		public $uses = array('Store');
		
		public function beforeFilter() {			
			$this->Auth->allow('api');
		}		
		
		// retrieve parameters from URL OR send error response
		public function getRequestParams() 
		{
			$allowed_params = array('user_name', 'store_name', 'location', 'udid','CAKEPHP');
			$api_parameters	= array();
			
			//foreach ( $_REQUEST as $param => $value ){			// for testing only
			foreach ($_POST as $param => $value){				
				if ( in_array( trim(  $param ), $allowed_params ) )  {					
					if ( $param != 'CAKEPHP' )
						$api_parameters[ $param ] = $value;
				}else{					
					$data = array();
					$data['response']['response_code']		= 0;
					$data['response']['response_message']	= "Invalid parameter- " . $param;
					$this->sendApiResponse ( $data ); 
				}
			}			
			return $api_parameters;
		}
		
		// dispatcher function
		public function api()
		{
			$this->autoRender	= false;
			$response 			= '';
			$message 			= '';
			$api_parmams		= $this->getRequestParams();

			print_r( $api_parmams );

			
			if( empty( $api_parmams['udid'] ))
			{
				$data = array();
				$data['response']['response_code']		= 0;
				$data['response']['response_message']	= 'invalid udid OR udid parameter not found';
				$this->sendApiResponse ( $data );
			}
			else{
				$conditions = array('conditions'=>array('udid'=>$api_parmams['udid']) );
				$find		= $this->Store->find('first', $conditions);
				
				if ( empty ( $find ) ){					
					$result = $this->addStore($response, $message);					
				}else{
					$result = $this->updateStore( $find['Store']['store_id'], $response, $message );
				}
			}
		}
		
		// add stores data into table
		public function addStore(& $response, & $message) {
		
			$this->autoRender	= false;
			
			$api_parmams		= $this->getRequestParams();
			
			$add_result 		= $this->Store->save( $api_parmams );
			
			if ( empty ( $add_result )){
				$data['response']['response_code']		= 0;
				$data['response']['response_message']	= 'Can\'t add stores data, Please try again';
				
			}else{
				$data['response']['response_code'] 		= 1;
				$data['response']['response_message']	= 'Stores data added successfully';
			}
			
			$this->sendApiResponse( $data );
		}
		
		// update stores data in the table
		public function updateStore( $id, & $response, & $message ) {
			
			$this->autoRender	= false;
			
			$api_params			= $this->getRequestParams();
			 
			$this->Store->id	= $id;
			$update_result 	= $this->Store->save( $api_params );
			
			$data = array();
			
			if ( empty ( $update_result )){
				$data['response']['response_code']		= 0;
				$data['response']['response_message']	= 'Can\'t update stores data, Please try again';
			}else{
				$data['response']['response_code'] 		= 1;
				$data['response']['response_message']	= 'Stores data updated successfully';
			}
			$this->sendApiResponse( $data );
			
		}
		
		// send Response to requester / referrer
		public function sendApiResponse( $data = array() ){			
			$this->autoRender	= false;
			echo json_encode( $data );
			die;
		}
		
		
		
}