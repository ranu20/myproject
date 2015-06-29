<?php
App::uses('AppModel', 'Model');

class CategoryProduct extends AppModel {	
	public $useTable 	='categories_products';	
	public $primaryKey	= 'category_product_id';

	public $belongsTo = array(		
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',			
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',			
		),
	);
}
