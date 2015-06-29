<?php
App::uses('AppController', 'Controller');
class BrandsController extends AppController {

	public $components = array('Paginator');	
	public $uses	   = array('Brand','Product');
	public $paginate	= array('conditions'=>array('status <> 0'),'limit' => 7);

	public function index() {
		$this->Brand->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('brands', $this->Paginator->paginate());
	}

	public function view($id = null) {
		
		if (!$this->Brand->exists($id)) {
			throw new NotFoundException(__('Invalid brand'));
		}
		$options = array('conditions' => array('Brand.' . $this->Brand->primaryKey => $id));
		$this->set('brand', $this->Brand->find('first', $options));
	}
	
	public function add() {		
			
		if ($this->request->is('post')) {		
			
			$find_result = $this->Brand->find('all', array('conditions'=>array('brand_name'=>trim($this->data['Brand']['brand_name'])),'recursive'=>-1 ) );
			
			if ( $find_result )
			{
				$this->Session->setFlash(__('The brand is already exists. Please, try other brand name.'));
				return $this->redirect(array('action' => 'add'));				
			}
			$brand_data =  array();

			$brand_data['Brand']['brand_name']	= $this->data['Brand']['brand_name'];
			$brand_data['Brand']['updated_date']= date('Y-m-d H:i:s');
			$brand_data['Brand']['status']		= 1;
			
			if ( $this->Brand->save( $brand_data ) ) {
				
				$last_insert_id = $this->Brand->getLastInsertID();
				
				if ( $this->data['Brand']['brand_image']['error'] == 0 ){
					
					$allowed	= array('png','gif','jpg','bmp');				
					$ext		= @end(explode(".", $this->data['Brand']['brand_image']['name']));
					
					if ( in_array( $ext, $allowed ) ) {

						$new_file_name =  $last_insert_id . '.' . $ext ;
						
						$target 	 = IMAGES . 'brands' . DS . $new_file_name ;
						
						$move_result = move_uploaded_file( $this->data['Brand']['brand_image']['tmp_name'], $target );
						
						if ( $move_result ) {
							// updating image name;							
							$this->Brand->id						= $last_insert_id;
							$image_data['Brand']['brand_image_url']	= $new_file_name;
							$this->Brand->save( $image_data );
						}
						else{
							// File can not move to destination folder.
							
						}
					}else{							
						$this->Session->setFlash(__('Please upload only images.'));
						return $this->redirect(array('action' => 'add'));
					}		
					
				}else{
					$this->Session->setFlash(__('File can not uploaded.'));
				}

				$this->Session->setFlash(__('The brand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The brand could not be saved. Please, try again.'));
			}
		}
		$brands = $this->Brand->find('list', array('conditions'=>array('Brand.status <> 0')));
		$this->set(compact('brands'));
	}

	public function edit( $id = null) {
		if (!$this->Brand->exists($id)) {
			throw new NotFoundException(__('Invalid brand'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {			
			
			$this->request->data['Brand']['updated_date']	= date('Y-m-d H:i:s');
			$this->request->data['Brand']['status']			= 2;

			if ($this->Brand->save( $this->request->data )) {

				if ( $this->data['Brand']['brand_image']['error'] == 0 ){
					
					$allowed	= array('png','gif','jpg','bmp');				
					$ext		= @end(explode(".", $this->data['Brand']['brand_image']['name']));
					
					if ( in_array( $ext, $allowed ) ) {

						$new_file_name =  $id . '.' . $ext ;
						
						$target 	 = IMAGES . 'brands' . DS . $new_file_name ;
						
						$move_result = move_uploaded_file( $this->data['Brand']['brand_image']['tmp_name'], $target );
						
						if ( $move_result ) {
							// updating image name;							
							$this->Brand->id						= $id;
							$image_data['Brand']['brand_image_url']	= $new_file_name;
							$this->Brand->save( $image_data );
						}
						else{
							// File can not move to destination folder.
							
						}
					}else{							
						$this->Session->setFlash(__('Please upload only images.'));
						return $this->redirect(array('action' => 'add'));
					}		
					
				}

				$this->Session->setFlash(__('The brand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The brand could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Brand.' . $this->Brand->primaryKey => $id));
			$this->request->data = $this->Brand->find('first', $options);
		}
		
		//$brands = $this->Brand->find('all', array('recursive'=>0));
		//$this->set(compact('brands'));
	}

	public function delete($id = null) {
	
		$this->Brand->id = $id;
		if ( !$this->Brand->exists() ) {
			throw new NotFoundException(__('Invalid brand'));
		}

		$find = $this->Product->query("select * from products where brand_id = $id");	
		
		if( $find ){
			$this->Session->setFlash("This brand is related to products, it cant be deleted.");
		} else {			
			$data = array();
			$data['Brand']['status']		= 0;
			$data['Brand']['updated_date']	= date('Y-m-d H:i:s');

			if ( $this->Brand->save( $data ) ) {
				$this->Session->setFlash(__('The brand has been deleted.'));
			} else {
				$this->Session->setFlash(__('The brand could not be deleted. Please, try again.'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}
}