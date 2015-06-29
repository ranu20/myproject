<?php
App::uses('AppModel', 'Model');


class Question extends AppModel {
	public $primaryKey = 'question_id';
	
	public $validate = array(
		'question_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),		
			),
		),
		'category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		)
	);	
	
	
	public $hasAndBelongsToMany = array(
		'Category'=> array(
			'className'=>'Category',
			'associationForeignKey'=>'category_id',
			'foreignKey'=>'question_id',
			'joinTable'=>'categories_questions'	,
			'unique' => true,				
	),
		'Attribute'=> array(
			'className'=>'Attribute',
			'associationForeignKey'=>'attribute_id',
			'foreignKey'=>'question_id',
			'joinTable'=>'attributes_questions'	,
			'unique' => true,				
	));	
}
	

