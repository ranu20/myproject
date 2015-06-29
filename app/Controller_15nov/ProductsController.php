<?php

App::uses('AppController', 'Controller');

class ProductsController extends AppController {


	public $components = array('Paginator');
	public $uses 		= array('Product','Brand','Attribute','AttributeProduct');
	//public $paginate	= array('limit' => 8);
	public $paginate	= array('conditions'=>array('Product.status <> 0'),'limit' => 7,'order'=>'product_id desc');

	public function index() {
		$this->Product->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('products', $this->Paginator->paginate());
	}	

	public function add() {
		if ($this->request->is('post')) {			

			$DataProductAttributeId		= array();
			$DataProductAttributeId		= $this->request->data['DataProductAttributeId'];
			
			if ( empty ( $DataProductAttributeId )){				
				$this->Session->setFlash(__('Please select atleast one attribute.'));
				return $this->redirect(array('action' => 'add'));							
			}
			
			$this->request->data['Product']['status']		= 1;
			$this->request->data['Product']['updated_date']	= date('Y-m-d H:i:s');
			$this->request->data['Product']['brand_id']		= $this->request->data['Brand']['brand_id'];						
			
			if (isset($this->request->data['Product']['chicken']) )
				$this->request->data['Product']['chicken']	= 1;			
			else
				$this->request->data['Product']['chicken']	= 0;			

			if ( $this->data['Product']['product_image']['error'] == 0 ){
				
				$allowed = array('png','gif','jpg','bmp');				
				$ext	= @end(explode(".", $this->data['Product']['product_image']['name']));
				
				if ( in_array( $ext, $allowed ) ) {
					$target 	 = IMAGES.'products' . DS . $this->data['Product']['product_image']['name'];				
					$move_result = move_uploaded_file( $this->data['Product']['product_image']['tmp_name'], $target );
					
					if ( $move_result ) {
						//$productData['product_image_url'] = $this->data['Product']['product_image']['name'];
						$this->request->data['Product']['product_image_url']		= 	$this->data['Product']['product_image']['name'];
					}
					else{
						// File can not move to destination folder.
					}
				}else{
					$this->Session->setFlash(__('Please upload only images.'));
					return $this->redirect(array('action' => 'add'));
				}		
				
			}else{
				// File can not uploaded.
			}
			
			/* Now, saving data */
			
			$this->Product->create();
			if ($this->Product->save( $this->request->data )) {
				$ctr = 0;
				$last_insert_id = $this->Product->getLastInsertID();
				
				
				foreach ( $DataProductAttributeId as $key=>$attribute_id ){
					$data['attribute_id']	= $attribute_id;					
					$data['product_id']		= $last_insert_id;
					$data['updated_date']	= date('Y-m-d H:i:s');
					$data['status']			= 1;
					
					$this->AttributeProduct->create();
					$res = $this->AttributeProduct->save( $data );
					$ctr++;			
				}
				
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect( array( 'action' => 'index' ) );
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		
		$products	= $this->Product->find('list', array('conditions'=>array('Product.status <> 0')));		
		
		$brands 	= $this->Brand->find('all',array('conditions'=>array('Brand.status <> 0'), 'recursive'=>0 ) );
		
		$attributes = $this->Attribute->find('all' , array('conditions'=>array('Attribute.status <> 0')));

		$this->set(compact('products', 'brands', 'attributes' ));
	}

	public function edit($id = null) {
		
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {

			$DataProductAttributeIds = array();
			$DataProductAttributeId	 = $this->request->data['DataProductAttributeId'];			
			
			if ( empty ( $DataProductAttributeId )){				
				$this->Session->setFlash(__('Please select atleast one attribute.'));
				return $this->redirect(array('action' => 'edit/'.$id));							
			}
			
			if ( $this->data['Product']['product_image']['error'] == 0 ) {	
				$allowed	= array('png','gif','jpg','bmp');				
				$ext		= @end(explode(".", $this->data['Product']['product_image']['name']));
				
				if ( in_array( $ext, $allowed ) ) {
				
					$upload_target 	= IMAGES . 'products' . DS . $this->data['Product']['product_image']['name'];
					$move_result	= move_uploaded_file( $this->data['Product']['product_image']['tmp_name'], $upload_target );
					
					if ( $move_result ) {
						$this->request->data['Product']['product_image_url'] = $this->data['Product']['product_image']['name'];
					}
					else{
						// file move error
					}
				}else{
					$this->Session->setFlash(__('Please upload only images.'));
					return $this->redirect(array('action' => 'edit/'.$id));
				}
			}else{
				// file upload error
			}
			
			$this->request->data['Product']['updated_date'] = date('Y-m-d H:i:s');
			$this->request->data['Product']['status'] 		= 2;

			if ($this->Product->save( $this->request->data )) {
			
				// deleting existing data
				$del_qry = 'delete from attribute_products where product_id = '. $id;
				$this->AttributeProduct->query( $del_qry );
				
				// adding form data				
				foreach ( $DataProductAttributeId as $key=>$attribute_id ){						
					$data['attribute_id']	= $attribute_id;
					$data['product_id']		= $id;
					$data['status']			= 2;
					$data['updated_date']	= date('Y-m-d H:i:s');
					
					$this->AttributeProduct->create();
					$res = $this->AttributeProduct->save( $data );
				}
				
				$this->Session->setFlash(__('The product has been modified successfully.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be modified. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));

			$this->request->data = $this->Product->find('first', $options);

			$temp_prd_att = $this->AttributeProduct->find('all', array('fields'=>array('attribute_id'), 'conditions'=>array('AttributeProduct.product_id'=> $id )) );
			
			if ( $temp_prd_att ){
				foreach ( $temp_prd_att as $key=>$value){
					$products_attributes[] = $value['AttributeProduct']['attribute_id'];
				}
				$this->set ('prd_attr', $products_attributes);				
			}			
		}
		
		$products = $this->Product->find('list', array('conditions'=>array('Product.status <> 0')));
		
		$brands = $this->Brand->find('list',array('conditions'=>array('Brand.status <> 0'), 'fields'=>array('brand_id','brand_name'),'order'=>array('brand_id'=>'ASC')));		
		
		$attributes = $this->Attribute->find('list', array('conditions'=>array('Attribute.status <> 0'),'fields'=>array('attribute_id','attribute_name')));

		$this->set(compact('products', 'brands', 'attributes', 'prd_attr'));
	}

	public function delete($id = null) {
		$this->Product->id = $id;
		
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');

		$data = array();
		$data['Product']['status'] = 0;

		if ($this->Product->save( $data )) {
			$delete_qry = 'delete from attribute_products where product_id = '. $id;

			$this->AttributeProduct->query( $delete_qry );
			
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	
}