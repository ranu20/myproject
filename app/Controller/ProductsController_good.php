<?php

App::uses('AppController', 'Controller');

class ProductsController extends AppController {


	public $components = array('Paginator');
	public $uses 		= array('Product','Brand','Attribute','AttributeProduct','Category','CategoryProduct');
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
			$DataCategoryProductId		= $this->request->data['CategoryId'];				
			
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
			
			
			/* Now, saving data */			
			
			$this->Product->create();
			if ($this->Product->save( $this->request->data )) {
				$ctr 			= 0;
				$last_insert_id = $this->Product->getLastInsertID();
				
				// saving product image
				if ( $this->data['Product']['product_image']['error'] == 0 ){
				
					$allowed	= array('png','gif','jpg','bmp');				
					$ext		= @end(explode(".", $this->data['Product']['product_image']['name']));
					
					if ( in_array( $ext, $allowed ) ) {
						$new_file_name =  $last_insert_id . '.' . $ext ;
						$target 	 = IMAGES . 'products' . DS . $new_file_name ;
						$move_result = move_uploaded_file( $this->data['Product']['product_image']['tmp_name'], $target );
						
						if ( $move_result ) {
							// updating image name;
							$this->Product->id							= $last_insert_id;
							$image_data['Product']['product_image_url']	= $new_file_name;
							$this->Product->save( $image_data );
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
				
				$cond_1	= 'update attribute_products set status = 0, updated_date =  now() where product_id=' . $last_insert_id ;
				$res	= $this->AttributeProduct->query( $cond_1 );
				
				foreach ( $DataProductAttributeId as $key=>$attribute_id ){
					$data['attribute_id']	= $attribute_id;					
					$data['product_id']		= $last_insert_id;
					$data['updated_date']	= date('Y-m-d H:i:s');
					$data['status']			= 1;
					
					$this->AttributeProduct->create();
					$res = $this->AttributeProduct->save( $data );
					$ctr++;			
				}
				
				// category update				
				$cond	= 'update categories_products set status = 0, updated_date = now() where product_id=' . $last_insert_id ;
				$res	= $this->CategoryProduct->query( $cond );
				
				$ctr = 0;
				foreach ( $DataCategoryProductId as $key=>$category_id ){
					$data['product_id'] 	= $last_insert_id;
					$data['category_id'] 	= $category_id;
					$data['updated_date'] 	= date('Y-m-d H:i:s');
					$this->CategoryProduct->create();
					$res = $this->CategoryProduct->save( $data );
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
		
		$categories = $this->Category->find('list',array('conditions'=>array('Category.status <> 0'), 'fields'=>array('category_id','category_name'),'order'=>array('category_id'=>'ASC')));

		$this->set(compact('products', 'brands', 'attributes','categories' ));
	}

	public function edit($id = null) {
		
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {

			$DataProductAttributeIds = array();
			$DataProductAttributeId	 = $this->request->data['DataProductAttributeId'];			
			$DataCategoryIds 		 = $this->request->data['DataProductCategory'];
			
			debug ( $DataCategoryIds);
			
			
			if ( empty ( $DataProductAttributeId )){				
				$this->Session->setFlash(__('Please select atleast one attribute.'));
				return $this->redirect(array('action' => 'edit'.$id));							
			}			
			
			$this->request->data['Product']['updated_date'] = date('Y-m-d H:i:s');
			$this->request->data['Product']['status'] 		= 2;

			if ($this->Product->save( $this->request->data )) 
			{
				// marking attribute-product mapping as deleted for this product
				$del_qry = 'update attribute_products  set status = 0, updated_date =  now() where product_id = '. $id;
				$this->AttributeProduct->query( $del_qry );
				
				// adding data in AttributeProduct table
				foreach ( $DataProductAttributeId as $key=>$attribute_id ){						
					$data['attribute_id']	= $attribute_id;
					$data['product_id']		= $id;
					$data['status']			= 2;
					$data['updated_date']	= date('Y-m-d H:i:s');
					
					$this->AttributeProduct->create();
					$res = $this->AttributeProduct->save( $data );
				}
				
				// category update				
				$cond	= 'update categories_products set status = 0, updated_date = now() where product_id=' . $id;
				$res	= $this->CategoryProduct->query( $cond );
				
				$ctr = 0;
				foreach ( $DataCategoryIds as $key=>$category_id ){
					$cat_data = array();
					$cat_data['CategoryProduct']['status']			= 2;
					$cat_data['CategoryProduct']['product_id'] 	= $id;
					$cat_data['CategoryProduct']['category_id'] 	= $category_id;
					$cat_data['CategoryProduct']['updated_date'] 	= date('Y-m-d H:i:s');					

					$this->CategoryProduct->create();
					$res2 = $this->CategoryProduct->save( $cat_data );
					$ctr++;			
				}
				
				// saving product image
				if ( $this->data['Product']['product_image']['error'] == 0 ){
				
					$allowed	= array('png','gif','jpg','bmp');				
					$ext		= @end(explode(".", $this->data['Product']['product_image']['name']));
				
					
					if ( in_array( $ext, $allowed ) ) {
						
						$new_file_name	=  $id . '.' . $ext ;						
						$target 		= IMAGES . 'products' . DS . $new_file_name ;						
						$move_result	= move_uploaded_file( $this->data['Product']['product_image']['tmp_name'], $target );
						
						if ( $move_result ) {
							// updating image name;
							$this->Product->id								= $id;
							$image_data['Product']['product_image_url']		= $new_file_name;
							$this->Product->save( $image_data );
						}
						else{
							// File can not move to destination folder.
							$this->Session->setFlash(__('File can not uploaded.'));
						}
					}else{
						$this->Session->setFlash(__('Please upload only images.'));
						return $this->redirect(array('action' => 'edit',$id));
					}		
					
				}else{					
					// File can not move to destination folder.
					$this->Session->setFlash(__('File can not uploaded.'));
				}				
				
				$this->Session->setFlash(__('The product has been modified successfully.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be modified. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));

			$this->request->data = $this->Product->find('first', $options);

			$temp_prd_att = $this->AttributeProduct->find('all', array('fields'=>array('attribute_id'), 'conditions'=>array('AttributeProduct.product_id'=> $id,'AttributeProduct.status <>0')) );
			
			if ( $temp_prd_att ){
				foreach ( $temp_prd_att as $key=>$value){
					$products_attributes[] = $value['AttributeProduct']['attribute_id'];
				}
				$this->set ('prd_attr', $products_attributes);				
			}
			
			// product related categories
			$temp_cats = $this->CategoryProduct->find('all', array('fields'=>array('*'), 'conditions'=>array('CategoryProduct.product_id'=> $id,'CategoryProduct.status !='=>0 ) ) );	
			
			if ( $temp_cats ){
				foreach ( $temp_cats as $key=>$value){
					$cats_prod[]		= $value['CategoryProduct']['category_id'];
				}
				$this->set ('cats_prod', $cats_prod);				
			}
		}
		
		$products	= $this->Product->find('list', array('conditions'=>array('Product.status <> 0')));		
		$brands		= $this->Brand->find('list',array('conditions'=>array('Brand.status <> 0'), 'fields'=>array('brand_id','brand_name'),'order'=>array('brand_id'=>'ASC')));		
		$attributes = $this->Attribute->find('list', array('conditions'=>array('Attribute.status <> 0'),'fields'=>array('attribute_id','attribute_name')));
		$categories	= $this->Category->find('list',array('conditions'=>array('Category.status <> 0'),'fields'=>array('category_id','category_name'),'order'=>array('category_id'=>'ASC')));
		
		$this->set( compact('products', 'brands', 'attributes', 'categories', 'prd_attr') );
	}

	public function delete($id = null) {
		$this->Product->id = $id;
		
		if (!$id) {
			throw new NotFoundException(__('Invalid product'));
		}
		
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}

		$this->request->onlyAllow('post', 'delete');

		$data	= array();
		$data['Product']['status']		= 0;
		$data['Product']['updated_date']= date('Y-m-d H:i:s');
		
		if ( $this->Product->save( $data ) ) {
			$delete_qry = 'update attribute_products set status = 0, updated_date = now() where product_id = '. $id;
			
			$this->AttributeProduct->query( $delete_qry );
			
			$cond_cat_prod	= 'update categories_products set status = 0, updated_date = now() where product_id=' . $id ;
			$res			= $this->CategoryProduct->query( $cond_cat_prod );
			
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	
}