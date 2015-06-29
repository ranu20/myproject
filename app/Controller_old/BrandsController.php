<?php
App::uses('AppController', 'Controller');
class BrandsController extends AppController {

	public $components = array('Paginator');	
	public $uses	   = array('Brand','Product');
	public $paginate	= array('conditions'=>array('status <> 0'),'limit' => 7);

	public function index() {
		$this->Brand->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('brands', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->Brand->exists($id)) {
			throw new NotFoundException(__('Invalid brand'));
		}
		$options = array('conditions' => array('Brand.' . $this->Brand->primaryKey => $id));
		$this->set('brand', $this->Brand->find('first', $options));
	}
	
	public function add() {		
			
		if ($this->request->is('post')) {		
			
			$find_result = $this->Brand->find('all', array('conditions'=>array('brand_name'=>trim($this->data['Brand']['brand_name'])),'recursive'=>-1 ) );
			
			if ( $find_result )
			{
				$this->Session->setFlash(__('The brand is already exists. Please, try other brand name.'));
				return $this->redirect(array('action' => 'add'));				
			}
			$brand_data =  array();

			$brand_data['Brand']['brand_name']	= $this->data['Brand']['brand_name'];
			$brand_data['Brand']['updated_date']= date('Y-m-d H:i:s');
			$brand_data['Brand']['status']		= 1;
			
			if ( $this->Brand->save( $brand_data ) ) {
				$this->Session->setFlash(__('The brand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The brand could not be saved. Please, try again.'));
			}
		}
		$brands = $this->Brand->find('list', array('conditions'=>array('Brand.status <> 0')));
		$this->set(compact('brands'));
	}

	public function edit($id = null) {
		if (!$this->Brand->exists($id)) {
			throw new NotFoundException(__('Invalid brand'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {			
			
			$this->request->data['Brand']['updated_date']	= date('Y-m-d H:i:s');
			$this->request->data['Brand']['status']			= 2;

			if ($this->Brand->save( $this->request->data )) {
				$this->Session->setFlash(__('The brand has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The brand could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Brand.' . $this->Brand->primaryKey => $id));
			$this->request->data = $this->Brand->find('first', $options);
		}
		
		//$brands = $this->Brand->find('all', array('recursive'=>0));
		//$this->set(compact('brands'));
	}

	public function delete($id = null) {
	
		$this->Brand->id = $id;
		if ( !$this->Brand->exists() ) {
			throw new NotFoundException(__('Invalid brand'));
		}

		$find = $this->Product->query("select * from products where brand_id = $id");	
		
		if( $find ){
			$this->Session->setFlash("This brand is related to products, it cant be deleted.");
		} else {			
			$data = array();
			$data['Brand']['status']		= 0;
			$data['Brand']['updated_date']	= date('Y-m-d H:i:s');

			if ( $this->Brand->save( $data ) ) {
				$this->Session->setFlash(__('The brand has been deleted.'));
			} else {
				$this->Session->setFlash(__('The brand could not be deleted. Please, try again.'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}
}