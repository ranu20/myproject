<?php
App::uses('AppModel', 'Model');

	class Store  extends AppModel {
		public $primaryKey = 'store_id';	
		public $tableName  = 'stores' ;
		
	}