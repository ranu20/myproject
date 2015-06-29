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
			/*'conditions'=>array( 'categories_questions.status <> '=> 0),*/
	),
		'Attribute'=> array(
			'className'=>'Attribute',
			'associationForeignKey'=>'attribute_id',
			'foreignKey'=>'question_id',
			'joinTable'=>'attributes_questions'	,
			'unique' => true,				
	));	

	public function paginate($conditions, $fields, $order, $limit, $page = 1, $recursive = null, $extra = array()) {
		

    	$recursive = -1;

    	$questions = array();

		$query_questions= "SELECT  Question.question_id, Question.question_name FROM `questions` as Question  where Question.status <> 0 order by Question.question_id desc
		LIMIT " . ( ($page - 1) * $limit) . ', ' . $limit;

		$questions_data = $this->query( $query_questions );

		foreach ($questions_data  as $key => $value) {		
		
			$questions[$key]['Question']['question_id'] 	= $value['Question']['question_id'];
			$questions[$key]['Question']['question_name']	= $value['Question']['question_name'];

			$current_question_id = $value['Question']['question_id'] ;


			$categories_sql= "SELECT  Category.category_name from categories_questions as CategoryQuestion  
			inner join categories as Category on CategoryQuestion.category_id = Category.category_id
			where CategoryQuestion.status <> 0 and 
			CategoryQuestion.question_id = " . $current_question_id;
			
			$categories_data = $this->query( $categories_sql );			


			foreach ($categories_data  as $key2 => $value2) {	
				$questions[$key]['Category'][$key2]['category_name'] = $value2['Category']['category_name'];
			}
			
		}
		return $questions;
	}
	
}
