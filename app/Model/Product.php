<?php
App::uses('AppModel', 'Model');

class Product extends AppModel {
	
	public $primaryKey = 'product_id';

	public $validate = array(
		'product_id' => array(
			'numeric' => array('rule' => array('numeric'),),
		),
		'brand_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),),
		),		
	);
			
	public $belongsTo = array(		
		'Brand' => array(
			'className' => 'Brand',
			'foreignKey' => 'brand_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'AttributeProduct' => array(
			'className' => 'AttributeProduct',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	public $hasAndBelongsToMany = array(
		'Category'=> array(
			'className'=>'Category',
			'associationForeignKey'=>'category_id',
			'foreignKey'=>'product_id',
			'joinTable'=>'categories_products'	,
			//'unique' => true,
	), );
}