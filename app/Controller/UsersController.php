<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $components = array('Paginator', 'Email');
	
	public function beforeFilter() {							
		$this->Auth->allow('forgotpassword', 'add');       
    }
	
	public function login() {
		$this->layout = 'default_login';
		
		if ($this->request->is('post')) {			
			if ($this->Auth->login()) {				
				return $this->redirect($this->Auth->redirect());
			}			
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}
	
	public function logout(){
		$this->layout = 'default_login';
		$this->Auth->logout();
		$this->redirect( $this->Auth->redirect() );
	}
	
	public function index() {
		$this->layout = 'default';
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}
	
	public function view($id = null) {
		$this->layout = 'default';
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
	
	public function add() {
		$this->layout = 'default';
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}
	
	public function edit($id = null) {
		$this->layout = 'default';
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function delete( $id = null ) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		$this->request->onlyAllow('post', 'delete');
		
		if ( $this->User->delete() ) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.') );
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function forgotpassword(){
		$this->layout = 'default_login';		
		
		if ($this->request->is('post') || $this->request->is('put')) {

			$email = $this->request->data['User']['email'];
			
			$data	= $this->User->findByEmail( $email );

			if ( $data ){

				$userid = $data['User']['id'];
				$new_password = $this->generatePassword();				
				$this->User->create();
				$this->User->id = $userid;

				$userData['User']['password']		= $this->Auth->password( $new_password );
				$userData['User']['real_password']	= $new_password ;

				$save_result = 	$this->User->save( $userData );
				{
					$message	= "Your new password for admin panel is ". $new_password .				
					$subject	= 'Your new password for admin panel';
					$From		= "ajay.sarwai@kiwitech.com";
					$content = $message;
					$this->MyEmail ($email, $subject, $message, $From);
				}					

				$this->Session->setFlash(__('Your password change successfully. Please go to your mail account'));
				return $this->redirect(array('action' => 'login'));
			}else{
				$this->Session->setFlash(__('Incorrect email.'));
				return $this->redirect(array('action' => 'forgotpassword'));
			}
		}	
	}

	function generatePassword ($length = 5){
        // inicializa variables
        $password = "";
        $i = 0;
        $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
        
        // agrega random
        while ( $i < $length ){
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
            
            if (!strstr($password, $char)) { 
                $password .= $char;
                $i++;
            }
        }
        return $password;
    } 	

	function MyEmail($to, $subject, $message, $from){
		$this->Email->to = 'ajay.sarwai@kiwitech.com';
		$this->Email->subject = $subject;
		$this->Email->from = 'ajay.sarwai@kiwitech.com';
		$this->Email->template = 'only_text'; // 
		
		$this->Email->smtpOptions = array('port'=>'465','timeout'=>'60','host' => 'ssl://smtp.gmail.com','username'=>'ajay.sarwai@kiwitech.com','password'=>'kiwi.hipoptosis',);
		
		$this->Email->delivery = 'smtp';
			if ($this->Email->send()) {			
				return true;
			} else {
				echo $this->Email->smtpError;
			}
		}
}


