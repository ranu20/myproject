<?php
	class CustomHelper extends AppHelper {
		
		public function serilizeIndex( $per_page = null ) {
		
			if ( isset( $this->request->params['named']['page'] ) ){
				$start = ( $this->request->params['named']['page'] * $per_page) - $per_page + 1 ;				
				return $start;
			}				
			else{
				return $start = 1;
			}
			
		}
	}