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

			$DataProductAttributeIds		= array();
			$DataProductAttributeIds		= $this->request->data['DataProductAttributeId'];

			$productData['product_name']	= $this->request->data['Product']['product_name'];
			$productData['brand_id']		= $this->request->data['Brand']['brand_id'];
			$productData['status']			= 1;
			$productData['updated_date']	= date('Y-m-d H:i:s');			
			
			if (isset($this->request->data['Product']['chicken']) )
				$productData['chicken']	= 1;
			else
				$productData['chicken']	= 0;

			if ( $this->data['Product']['product_image']['error'] == 0 ){
				
				$allowed = array('png','gif','jpg','bmp');				
				$ext	= @end(explode(".", $this->data['Product']['product_image']['name']));
				
				if ( in_array( $ext, $allowed ) ) {
					//
				}else{
					$this->Session->setFlash(__('Please upload only images.'));
					return $this->redirect(array('action' => 'add'));
				}							
				
				$target = IMAGES.'products' . DS . $this->data['Product']['product_image']['name'];				
				$move_result = move_uploaded_file( $this->data['Product']['product_image']['tmp_name'], $target );
				
				if ( $move_result ) {
					$productData['product_image_url'] = $this->data['Product']['product_image']['name'];
				}
			}

			$this->Product->create();			
			
			if ($this->Product->save( $productData )) {
					
				$data['product_id'] = $this->Product->getLastInsertID();				

				$ctr = 0;
				foreach ( $DataProductAttributeIds as $key=>$attribute_id ){					
					$data['attribute_id'] = $attribute_id;
					$data['updated_date'] = $attribute_id;
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

		$this->Brand->recursive = 0;				
		$brands 	= $this->Brand->find('all',array('conditions'=>array('Brand.status <> 0')));
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

			if ( $this->data['Product']['product_image']['error'] == 0 ) {	
				$allowed = array('png','gif','jpg','bmp');				
				$ext	= @end(explode(".", $this->data['Product']['product_image']['name']));
				
				if ( in_array( $ext, $allowed ) ) {
					//
				}else{
					$this->Session->setFlash(__('Please upload only images.'));
					return $this->redirect(array('action' => 'edit/'.$id));
				}
				
				$upload_target 	= IMAGES.'products' . DS . $this->data['Product']['product_image']['name'];
				$move_result	= move_uploaded_file( $this->data['Product']['product_image']['tmp_name'], $upload_target );
				
				if ( $move_result ) {
					$this->request->data['Product']['product_image_url'] = $this->data['Product']['product_image']['name'];
				}
			}			

			if ($this->Product->save($this->request->data)) {	
				
				$del_qry = 'delete from attribute_products where product_id = '. $id;

				$this->AttributeProduct->query( $del_qry );

				if ( isset ($DataProductAttributeId )) {
					foreach ( $DataProductAttributeId as $key=>$attribute_id ){						
						$data['attribute_id']	= $attribute_id;
						$data['product_id']		= $id;
						$this->AttributeProduct->create();
						$res = $this->AttributeProduct->save( $data );
					}
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
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function multi ($option){
		$this->render = false;

		$brand_id		=  trim ( $_POST['brand_id'] );

		if ($option == 'image_url'){
			$this->Brand->recursive = -1;
			$brand_data = $this->Brand->find( 'first',array('fields'=>array('brand_image'),'conditions'=>array('brand_id'=>$brand_id)));

			if ( $brand_data )
				$brand_data = $brand_data['Brand']['brand_image'];
			else
				$brand_data	= 0;
			
			echo $brand_data;
			exit;
		}
	}
}