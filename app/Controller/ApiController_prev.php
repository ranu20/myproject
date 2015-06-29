<?php
App::uses('AppController', 'Controller');
	
	class ApiController extends AppController {

	public $uses = array('Attribute','AttributeProduct','AttributeQuestion','Brand','Category', 'CategoryQuestion','Product','Question','MaxWeightage');

		public function beforeFilter() {			
			$this->Auth->allow('api');
		}
		
		public function getApiParams() 
		{
			$allowed_params = array('timestamp','CAKEPHP');
			$apiParameters =  array();
			
			foreach ($_REQUEST as $name => $value){				
				if ( in_array( trim(  $name ), $allowed_params ) )  {
					if ( trim(  $name ) == 'timestamp')
						$apiParameters['timestamp'] = trim(  $value );				
				}
				else{
					//$apiParameters =  array();				
					$data = array();
					$data['Response']['response_code']		= 0;
					$data['Response']['response_message']	= "Invalid parameter- " . $name;
					$this->sendApiResponse ( $data ); 
				}
		   }	   
		   return $apiParameters;
		}
		
		public function api() {			

			$this->autoRender	= false;
			$final_data 		= array();
			
			$conditions 		= array();  //$conditions['updated']
			$params				= array('recursive'=>-1);
			
			$api_params	= $this->getApiParams();	
			
			if( isset ($api_params['timestamp'])){				
				$conditions['conditions']['updated_date >'] = $api_params['timestamp'];								
			}			
			
			// BRANDS DATA		
			$params_brand		= array('fields'=>array('brand_id','brand_name','status','updated_date'), 'recursive'=>-1);
			$params_brand += $conditions;			
			
			$this->PrepareData($this->Brand->find('all',$params_brand), $data_brand, 0);
			$this->dataStatus($data_brand, $status );
						
			if ( $status == 1)
				$final_data['Result']['Brands'] = $data_brand;
			
			// CATEGORIES DATA
			$params_cat			= array('fields'=>array('category_id','category_name','status','updated_date'), 'recursive'=>-1);
			$params_cat += $conditions;
			$this->PrepareData( $this->Category->find('all', $params_cat), $data_cat , 0 );
			$this->dataStatus($data_cat, $status );
			
			if ( $status == 1)
				$final_data['Result']['Categories'] = $data_cat;
					
			// ATTRIBUTE DATA
			$params_attr	= array('fields'=>array('attribute_id','attribute_name','weight','status','updated_date'), 'recursive'=>-1);
			$params_attr	+= $conditions;
			$this->PrepareData( $this->Attribute->find('all', $params_attr), $data_attribute, 0 );	
			
			$this->dataStatus($data_attribute, $status );
			
			if ( $status == 1)
				$final_data['Result']['Attribute'] = $data_attribute;			
			
			// PRODUCTS DATA
			$params_prd			= array('fields'=>array('product_id','product_name', 'product_image_url', 'brand_id', 'chicken','status','updated_date'), 'recursive'=>-1);
			$params_prd += $conditions;
			$this->PrepareData( $this->Product->find('all', $params_prd), $data_prd, 0 );
			
			$this->dataStatus($data_prd, $status );
			if ( $status == 1 )
				$final_data['Result']['Product'] = $data_prd;
			
			// QUESTIONS DATA			
			$params_questions	= array('fields'=>array('question_id','question_name', 'question_type', 'status','updated_date'), 'recursive'=>0);	
			if ( $conditions )
				$params_questions += array('conditions'=>array('Question.updated_date >' => $api_params['timestamp']	));
			$this->PrepareData( $this->Question->find('all', $params_questions), $data_quest, 1 );
			$this->dataStatus($data_quest, $status );
			if ( $status == 1)
				$final_data['Result']['Question'] = $data_quest;
			
			// ATTRIBUTEPRODUCT DATA			
			$params_attr_prd = array('fields'=>array('attribute_product_id', 'attribute_id', 'product_id','status'), 'recursive'=>-1);
			$params_attr_prd += $conditions;
			$this->PrepareData( $this->AttributeProduct->find('all', $params_attr_prd), $data_attr_product, 0 );
			
			$this->dataStatus($data_attr_product, $status );
			if ( $status == 1)
				$final_data['Result']['Attribute-Product'] = $data_attr_product;
			
			// ATTRIBUTE-QUESTION DATA			
			$params_attr_quest = array('fields'=>array('attribute_question_id', 'attribute_id', 'question_id','status','updated_date'), 'recursive'=>-1);
			$params_attr_quest += $conditions;			
			$this->PrepareData( $this->AttributeQuestion->find('all', $params_attr_quest), $data_attr_quest, 0 );			
			$this->dataStatus($data_attr_quest, $status );
			if ( $status == 1)
				$final_data['Result']['Attribute-Question'] = $data_attr_quest;

			// CATEGORY-QUESTION DATA
			$params_cat_quest = array('fields'=>array('category_question_id', 'category_id', 'question_id','status','updated_date'), 'recursive'=>-1);
			$params_cat_quest += $conditions;			
			$this->PrepareData( $this->CategoryQuestion->find('all', $params_cat_quest), $data_cat_quest, 0 );			
			$this->dataStatus($data_cat_quest, $status );
			if ( $status == 1)
				$final_data['Result']['Category-Question'] = $data_cat_quest;				
		
			if ( count( $final_data ) > 0 ) {				
			
				$params_max_weight 								= array('fields'=>array('maximum_weight'), 'recursive'=>-1);
				$max_weight_data 								= $this->MaxWeightage->find('all', $params_max_weight);			
				$final_data['Maximum-Weight']					= $max_weight_data[0]['MaxWeightage']['maximum_weight'];	
				
				$f[] 											= $final_data;
				
				$staus_array['response']['response_code']		= 1;
				$staus_array['response']['response_message']	= 'success';
			}
			else{
				$f[]											= array('Result'=>array());
				$staus_array['response']['response_code']		= 1;
				$staus_array['response']['response_message']	= 'success';
			}
			$f[] 			  = $staus_array;			
			$f[]['timestamp'] = date('Y-m-d h:i:s');		
			
			echo  json_encode( $f ) ;
			exit;
		}
		
		public function PrepareData( $data =  null, & $result=array(), $exception ) {			
			if ( $exception == 1){
				$temp_result =  array();
				
				if ( count ( $data ) > 0 ) {				
					foreach ( $data as $key=>$values ){						
						$values_new = $values['Question'];
						foreach ( $values_new as $key=>$value ){
							$temp_result[$key] = $value;
						}
						$result[] = $temp_result;
					}
				}
				else{
					$result[] = array();				
				}
			}
			else {								
				if ( count ( $data ) > 0 ) {
					foreach ( $data as $key=>$values ){
						foreach ( $values as $value ){
							$result[] = $value;
						}
					}
				}
				else{
					$result[] = array();
				}			
			}
		}
	
		public function sendApiResponse( $data = array() ) {			
			$this->autoRender	= false;
			echo json_encode( $data );
			die;
		}
		
		public function dataStatus ( $data_input, & $status ){			
			foreach ( $data_input as $key=>$value){
				if ( empty($data_input[$key]))
					$status = 0;
				else
					$status = 1;
			}
		}
}
		
		