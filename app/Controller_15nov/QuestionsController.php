<?php
App::uses('AppController', 'Controller');

class QuestionsController extends AppController {

	public $components	= array('Paginator');
	public $uses 		= array('Question','Attribute','Category','CategoryQuestion', 'AttributeQuestion');	
	public $paginate	= array('fields'=>array('Question.question_id','Question.question_name','Question.status','Question.updated_date'),'conditions'=>array('Question.status <> 0'),'limit' => 7,'order'=>'question_id desc');

	public function index() {
	    $this->Paginator->settings = $this->paginate;
		$data_question = $this->Paginator->paginate();		
		
		if (isset ( $data_question ) ){
			$this->set('questions', $this->Paginator->paginate());
		}
	}	

	public function add() {
		if ($this->request->is('post')) {
			
			$data=  array();
			$data['Question']['question_name']		= $this->request->data['Question']['question_name'];			
			$data['Question']['question_type']		= $this->request->data['Question']['question_type'];			
			$data['Question']['status']				= 1;
			$data['Question']['updated_date']		= date('Y-m-d h:i:s');			
			
			$DataProductAttributeIds	= array();
			$DataProductAttributeIds	= $this->request->data['AttributeId'];
			$DataCategoryIds 			= $this->request->data['CategoryId'];
			
			$this->Question->create();
			
			if ($this->Question->save( $data )) {
			
				$question_id = $this->Question->getLastInsertID();
				
				// attribute update
				$cond =  'delete from categories_questions where question_id='.$question_id ;
				$res = $this->CategoryQuestion->query( $cond );
				
				$ctr = 0;
				foreach ( $DataCategoryIds as $key=>$category_id ){
					$data['question_id'] 	= $question_id;
					$data['category_id'] 	= $category_id;
					$data['updated_date'] 	= date('Y-m-d H:i:s');
					$this->CategoryQuestion->create();
					$res = $this->CategoryQuestion->save( $data );
					$ctr++;			
				}
				
				// attribute update
				$cond2 =  'delete from attributes_questions where question_id = '.$question_id ;
				$res = $this->AttributeQuestion->query( $cond2 );
				
				$ctr = 0;
				foreach ( $DataProductAttributeIds as $key=>$attribute_id ){
					$data['question_id'] 	= $question_id;
					$data['attribute_id'] 	= $attribute_id;
					$data['updated_date'] 	= date('Y-m-d H:i:s');
					$this->AttributeQuestion->create();
					$res = $this->AttributeQuestion->save( $data );
					$ctr++;			
				}			

				$this->Session->setFlash(__('The question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
			}
		}
		
		$cond 			= array('fields'=>array('question_type','question_type'));
		
		$attributes = $this->Attribute->find('list',array('conditions'=>array('Attribute.status <> 0'), 'fields'=>array('attribute_id','attribute_name'),'order'=>array('attribute_id'=>'ASC')));
		
		$categories = $this->Category->find('list',array('conditions'=>array('Category.status <> 0'), 'fields'=>array('category_id','category_name'),'order'=>array('category_id'=>'ASC')));
		$this->set(compact('attributes', 'categories'));
	}

	public function edit($id = null) {
		if (!$this->Question->exists($id)) {
			throw new NotFoundException(__('Invalid question'));
		}

		if ( $this->request->is('post') || $this->request->is('put') ) {
			$DataProductAttributeIds = array();
			
			$DataProductAttributeIds = $this->request->data['DataProductAttributeId'];				
			$DataCategoryIds 		 = $this->request->data['DataQuestionCategory'];		
			
			$data_question = array();			
			$data_question['Question']['status']				= 2;
			$data_question['Question']['updated_date']			= date('Y-m-d h:i:s');
			$data_question['Question']['question_name']			= $this->request->data['Question']['question_name'];
			$data_question['Question']['question_id']			= $this->request->data['Question']['question_id'];
			$data_question['Question']['question_type']			= $this->request->data['Question']['question_type'];

			$this->Question->create();
			if ( $this->Question->save( $data_question ) ) {		

				// attribute update
				$cond2 =  'delete from attributes_questions where question_id = '.$id;
				$res = $this->AttributeQuestion->query( $cond2 );				
				
				$ctr = 0;
				foreach ( $DataProductAttributeIds as $key=>$attribute_id ){
					$data = array();
					$data['AttributeQuestion']['status']		= 2;
					$data['AttributeQuestion']['question_id'] 	= $id;
					$data['AttributeQuestion']['attribute_id'] 	= $attribute_id;
					$data['AttributeQuestion']['updated_date'] 	= date('Y-m-d H:i:s');
					$this->AttributeQuestion->create();
					$res = $this->AttributeQuestion->save( $data );

					$ctr++;			
				}				
				
				//updating categories				
				$cond =  'delete from categories_questions where question_id='. $id ;
				$res1 = $this->CategoryQuestion->query( $cond );				
				
				$ctr = 0;
				foreach ( $DataCategoryIds as $key=>$category_id ){
					$cat_data = array();
					$cat_data['CategoryQuestion']['status']			= 2;
					$cat_data['CategoryQuestion']['question_id'] 	= $id;
					$cat_data['CategoryQuestion']['category_id'] 	= $category_id;
					$cat_data['CategoryQuestion']['updated_date'] 	= date('Y-m-d H:i:s');					

					$this->CategoryQuestion->create();
					$res2 = $this->CategoryQuestion->save( $cat_data );
					$ctr++;			
				}
				
				$this->Session->setFlash(__('The question has been modified successfully.'));
				return $this->redirect(array('action' => 'index'));

			} else {
				$this->Session->setFlash(__('The question could not be modified. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Question.' . $this->Question->primaryKey => $id));
			$this->request->data = $this->Question->find('first', $options);			
			
			$temp_atts = $this->AttributeQuestion->find('all', array('fields'=>array('*'), 'conditions'=>array('AttributeQuestion.question_id'=> $id ) ) );			
			
			if ( $temp_atts ){
				foreach ( $temp_atts as $key=>$value){
					$quest_attrs[] 			= $value['AttributeQuestion']['attribute_id'];
					$quest_attrs_names[]	= $value['Attribute']['attribute_name'];
				}
				$this->set ('quest_attrs', $quest_attrs);
				$this->set ('quest_attrs_names', $quest_attrs_names);				
			}
			
			$temp_cats = $this->CategoryQuestion->find('all', array('fields'=>array('*'), 'conditions'=>array('CategoryQuestion.question_id'=> $id ) ) );	
			
			if ( $temp_cats ){
				foreach ( $temp_cats as $key=>$value){
				
					$quest_cats[]		= $value['CategoryQuestion']['category_id'];
					$quest_cats_names[]	= $value['Category']['category_name'];
					
				}
				$this->set ('quest_cats', $quest_cats);
				$this->set ('quest_cats_names', $quest_cats_names);				
			}
		}
		
		$questions 	= $this->Question->find('list', array('conditions'=>array('Question.status <> 0') ));		
		$attributes	= $this->Attribute->find('list',array('conditions'=>array('Attribute.status <> 0'), 'fields'=>array('attribute_id','attribute_name'),'order'=>array('attribute_id'=>'ASC')));		
		$categories	= $this->Category->find('list',array('conditions'=>array('Category.status <> 0'),'fields'=>array('category_id','category_name'),'order'=>array('category_id'=>'ASC')));

		$this->set(compact('questions', 'attributes', 'categories'));
	}

	public function delete($id = null) {
		
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		$this->request->onlyAllow('post', 'delete');
		
		
		$upd_attr_null	= $this->Attribute->query("update attributes set question_id = NULL  where question_id = $id");	
		
		$quest_cat_del	= $this->CategoryQuestion->query("delete from categories_questions where question_id = $id");	
		
		
		$data = array();
		$data['Question']['status'] = 0;

		if ($this->Question->save( $data )) {
			$this->Session->setFlash(__('The question has been deleted.'));
		} else {
			$this->Session->setFlash(__('The question could not be deleted. Please, try again.'));
		}	
		return $this->redirect(array('action' => 'index'));
	}
	
}
