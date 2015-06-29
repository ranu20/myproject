<?php
App::uses('AppController', 'Controller');
/**
 * AttributeProducts Controller
 *
 * @property AttributeProduct $AttributeProduct
 * @property PaginatorComponent $Paginator
 */
class AttributeProductsController extends AppController {
	
	

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AttributeProduct->recursive = 0;
		$this->set('attributeProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AttributeProduct->exists($id)) {
			throw new NotFoundException(__('Invalid attribute product'));
		}
		$options = array('conditions' => array('AttributeProduct.' . $this->AttributeProduct->primaryKey => $id));
		$this->set('attributeProduct', $this->AttributeProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AttributeProduct->create();
			
			pr($this->request->data);

			if ($this->AttributeProduct->save( $this->request->data )) {
				$this->Session->setFlash(__('The attribute product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute product could not be saved. Please, try again.'));
			}
		}
		$attributeProducts = $this->AttributeProduct->find('list');
		$attributes = $this->AttributeProduct->Attribute->find('list');
		$products = $this->AttributeProduct->Product->find('list');
		$this->set(compact('attributeProducts', 'attributes', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AttributeProduct->exists($id)) {
			throw new NotFoundException(__('Invalid attribute product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AttributeProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The attribute product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribute product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AttributeProduct.' . $this->AttributeProduct->primaryKey => $id));
			$this->request->data = $this->AttributeProduct->find('first', $options);
		}
		$attributeProducts = $this->AttributeProduct->find('list');
		$attributes = $this->AttributeProduct->Attribute->find('list');
		$products = $this->AttributeProduct->Product->find('list');
		$this->set(compact('attributeProducts', 'attributes', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AttributeProduct->id = $id;
		if (!$this->AttributeProduct->exists()) {
			throw new NotFoundException(__('Invalid attribute product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AttributeProduct->delete()) {
			$this->Session->setFlash(__('The attribute product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The attribute product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
