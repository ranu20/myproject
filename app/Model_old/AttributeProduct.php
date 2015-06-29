<?php
App::uses('AppModel', 'Model');

class AttributeProduct extends AppModel {
	
	public $primaryKey = 'attribute_product_id';

	public $validate = array(
		'attribute_product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'attribute_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),				
			),
		),
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(		
		'Attribute' => array(
			'className' => 'Attribute',
			'foreignKey' => 'attribute_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
