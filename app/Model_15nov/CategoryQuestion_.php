<?php
App::uses('AppModel', 'Model');

class CategoryQuestion extends AppModel {	
	public $useTable 	='categories_questions';	
	public $primaryKey	= 'category_question_id';

	public $belongsTo = array(		
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',			
		)
	);
}
