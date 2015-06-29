<?php
App::uses('AppController', 'Controller');

class CategoriesController extends AppController {

	public $components	= array('Paginator');
	public $uses		= array('Category','Question','AttributeQuestion', 'CategoryQuestion'); 	
	public $paginate	= array('conditions'=>array('status <> 0'),'limit' => 7);

	public function index() {
		$this->Category->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('categories', $this->Paginator->paginate());
	}	

	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Category']['updated_date']  = date('Y-m-d H:i:s');
			$this->request->data['Category']['status']  = 1;

			$this->Category->create();
			
			if ($this->Category->save( $this->request->data )) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Category->find('list', array('conditions'=>array('Category.status <> 0')));
		$this->set(compact('categories'));
	}

	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

			$this->request->data['Category']['updated_date']	= date('Y-m-d H:i:s');
			$this->request->data['Category']['status']			= 2;
						
			if ($this->Category->save($this->request->data)) {
				
				$upd_quest_qry	= 'update categories_questions set status = 2, updated_date = now() where attribute_id = '. $id ;
				$this->CategoryQuestion->query( $upd_quest_qry );
				
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$categories = $this->Category->find('list',array('conditions'=>array('Category.status <> 0')));
		$this->set(compact('categories'));
	}

	public function delete($id = null) 
	{
		$find = $this->CategoryQuestion->query("select * from categories_questions where category_id = ".  $id . " and status <> 0");
		
		if( $find ){
			$this->Session->setFlash("Category can't be deleted as some questions are related to it.");
		}
		else{
			$this->Category->id = $id;
			
			if (!$this->Category->exists()) {
				throw new NotFoundException(__('Invalid category'));
			}
			$this->request->onlyAllow('post', 'delete');

			$data								= array();
			$data['Category']['status']			= 0;
			$data['Category']['updated_date']	= date('Y-m-d H:i:s');

			if ( $this->Category->save( $data )) {			
				$upd_quest_qry	= 'update categories_questions set status = 0, updated_date = now() where category_id = '. $id ;
				$this->CategoryQuestion->query( $upd_quest_qry );
				
				$this->Session->setFlash(__('The category has been deleted.'));
			} else {
				$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
			}
		}		
		return $this->redirect(array('action' => 'index'));
	}}
