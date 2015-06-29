<?php
App::uses('AppController', 'Controller');
	
	class ApiController extends AppController {

	public $uses = array('Attribute','AttributeProduct','Brand','Category','Product','Question','MaxWeightage');

		public function beforeFilter() {			
			$this->Auth->allow('index');
		}
		public function getApiParams() 
		{
			$apiParameters =  array();
			foreach ($_REQUEST as $name => $value){
			
				if (trim( strtolower ( $name ) ) == 'timestamp') {
					$apiParameters['timestamp'] = $value;				
				}
				else{
					$apiParameters =  array();				
				}
		   }	   
		   return $apiParameters;
		}
		public function index() {

			$this->autoRender	= false;
			$final_data 		= array();
			
			$conditions 		= array();  //$conditions['updated']
			$params				= array('recursive'=>-1);
			
			$api_params	= $this->getApiParams();	
			
			if( isset ($api_params['timestamp'])){				
				$conditions['conditions']['updated_date >'] = $api_params['timestamp'];								
			}			
			
			// BRANDS DATA
		
			$params_brand		= array('fields'=>array('brand_id','brand_name','status'), 'recursive'=>-1);
			$params_brand += $conditions;
			
			$this->PrepareData($this->Brand->find('all',$params_brand), $final_data['Result']['Brands'], 0);
			
			// CATEGORIES DATA
			$params_cat			= array('fields'=>array('category_id','category_name','status','updated_date'), 'recursive'=>-1);
			$params_cat += $conditions;
			$this->PrepareData( $this->Category->find('all', $params_cat), $final_data['Result']['Categories'], 0 );			
						
			// ATTRIBUTE DATA
			$params_attr	= array('fields'=>array('attribute_id','attribute_name','weight','question_id','status'), 'recursive'=>-1);
			$params_attr += $conditions;
			$this->PrepareData( $this->Attribute->find('all', $params_attr), $final_data['Result']['Attribute'], 0 );	
			
			// PRODUCTS DATA
			$params_prd			= array('fields'=>array('product_id','product_name', 'product_image_url', 'brand_id', 'status'), 'recursive'=>-1);
			$params_prd += $conditions;
			$this->PrepareData( $this->Product->find('all', $params_prd), $final_data['Result']['Product'], 0 );
			
			// QUESTIONS DATA			
			$params_questions	= array('fields'=>array('question_id','question_name', 'question_type_id', 'category_id', 'status'), 'recursive'=>0);	
			if ($conditions )
				$params_questions += array('conditions'=>array('Question.updated_date >' => $api_params['timestamp']	));
			$this->PrepareData( $this->Question->find('all', $params_questions), $final_data['Result']['Question'], 1 );
			
			// ATTRIBUTEPRODUCT DATA			
			$params_attr_prd = array('fields'=>array('attribute_product_id', 'attribute_id', 'product_id' ), 'recursive'=>-1);			
			$this->PrepareData( $this->AttributeProduct->find('all', $params_attr_prd), $final_data['Result']['Attribute-Product'], 0 );
			
			
			//MAX_POINT			
			$params_max_weight = array('fields'=>array('maximum_weight'), 'recursive'=>-1);
			$this->PrepareData( $this->MaxWeightage->find('all', $params_max_weight), $final_data['Maximum-Weight'], 0 );
			
			
			
			if ( count( $final_data ) > 0 ) {
				$f[] = $final_data;
				//$final_data['Result']['Brands'] 		//$final_data['Result']['Categories'] //$final_data['Result']['Attribute'] //$final_data['Result']['Product']
				//$final_data['Result']['Question'] 	//$final_data['Result']['Attribute-Product']
				
				$staus_array['response']['response_code']		= 1;
				$staus_array['response']['response_message']	= 'success';
			}
			else{
				$staus_array['response']['response_code']		= 2;
				$staus_array['response']['response_message']	= 'faiure';
			}
			$f[] 			  = $staus_array;			
			$f[]['timestamp'] = date('Y-m-d h:i:s');		
			
			echo  json_encode( $f ) ;
			exit;
		}
		
		public function PrepareData( $data =  null, & $result=array(), $exception ) {
			//pr ( $data);
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
	}}
		
		