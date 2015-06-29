<?php
App::uses('AppController', 'Controller');
/**
 * QuestionAttributes Controller
 *
 *
 *
 *
 * @property QuestionAttribute $QuestionAttribute
 * @property PaginatorComponent $Paginator
 */
class QuestionAttributesController extends AppController {

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
		$this->QuestionAttribute->recursive = 0;
		$this->set('questionAttributes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->QuestionAttribute->exists($id)) {
			throw new NotFoundException(__('Invalid question attribute'));
		}
		$options = array('conditions' => array('QuestionAttribute.' . $this->QuestionAttribute->primaryKey => $id));
		$this->set('questionAttribute', $this->QuestionAttribute->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QuestionAttribute->create();
			if ($this->QuestionAttribute->save($this->request->data)) {
				$this->Session->setFlash(__('The question attribute has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question attribute could not be saved. Please, try again.'));
			}
		}
		$questionAttributes = $this->QuestionAttribute->find('list');
		$questions = $this->QuestionAttribute->Question->find('list');
		$attributes = $this->QuestionAttribute->Attribute->find('list');
		$this->set(compact('questionAttributes', 'questions', 'attributes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->QuestionAttribute->exists($id)) {
			throw new NotFoundException(__('Invalid question attribute'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->QuestionAttribute->save($this->request->data)) {
				$this->Session->setFlash(__('The question attribute has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question attribute could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('QuestionAttribute.' . $this->QuestionAttribute->primaryKey => $id));
			$this->request->data = $this->QuestionAttribute->find('first', $options);
		}
		$questionAttributes = $this->QuestionAttribute->find('list');
		$questions = $this->QuestionAttribute->Question->find('list');
		$attributes = $this->QuestionAttribute->Attribute->find('list');
		$this->set(compact('questionAttributes', 'questions', 'attributes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->QuestionAttribute->id = $id;
		if (!$this->QuestionAttribute->exists()) {
			throw new NotFoundException(__('Invalid question attribute'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->QuestionAttribute->delete()) {
			$this->Session->setFlash(__('The question attribute has been deleted.'));
		} else {
			$this->Session->setFlash(__('The question attribute could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
