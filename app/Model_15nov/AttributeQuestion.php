<?php
App::uses('AppModel', 'Model');

class AttributeQuestion extends AppModel {	
	public $useTable 	='attributes_questions';	
	public $primaryKey	= 'attribute_question_id';
	
	public $belongsTo = array(		
		'Attribute' => array(
			'className' => 'Attribute',
			'foreignKey' => 'attribute_id',			
		)
	);
}
