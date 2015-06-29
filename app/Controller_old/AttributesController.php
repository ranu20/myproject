<?php
App::uses('AppController', 'Controller');
/**
 * Attributes Controller
 *
 * @property Attribute $Attribute
 * @property PaginatorComponent $Paginator
 */
class AttributesController extends AppController {

	public $components	= array('Paginator');
	public $paginate	= array('conditions'=>array('status <> 0'),'limit' => 7,'order'=>'Attribute.attribute_id desc');	

	public function index() {
		$this->Attribute->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('attributes', $this->Paginator->paginate());
	}

	public function view( $id = null ) {
		if (!$this->Attribute->exists($id)) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		$options = array('conditions' => array('Attribute.' . $this->Attribute->primaryKey => $id));
		$this->set('attribute', $this->Attribute->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			
			$this->request->data['Attribute']['updated_date']  = date('Y-m-d H:i:s');
			$this->request->data['Attribute']['status']  = 1;			

			$this->Attribute->create();
			if ($this->Attribute->save( $this->request->data )) {
				$this->Session->setFlash(__('The attribute has been saved.'));
					return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.'));
			}
		}
		$this->Attribute->recursive=0;
		$attributes = $this->Attribute->find('all');
		$this->set( compact('attributes') );
	}

	public function edit($id = null) {
		if (!$this->Attribute->exists($id)) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

			$this->Attribute->id = $id;			
			$this->request->data['Attribute']['updated_date']  = date('Y-m-d H:i:s');
			$this->request->data['Attribute']['status']  = 2;			
			if ($this->Attribute->save($this->request->data)) {
				$this->Session->setFlash(__('The attribute has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Attribute.' . $this->Attribute->primaryKey => $id));
			$this->request->data = $this->Attribute->find('first', $options);
		}
		$attributes = $this->Attribute->find('list');
		$this->set(compact('attributes'));
	}

	public function delete( $id = null ) {
		$this->Attribute->id = $id;
		if (!$this->Attribute->exists()) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		$this->request->onlyAllow('post', 'delete');

		$data = array();
		$data['Attribute']['status']		= 0;
		$data['Attribute']['updated_date']	= date('Y-m-d H:i:s');

		if ( $this->Attribute->save( $data ) ) {
			$this->Session->setFlash(__('The attribute has been deleted.'));
		} else {
			$this->Session->setFlash(__('The attribute could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}