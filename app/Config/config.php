<?php
// MSG set for admin message

//define('PATH','http://db-bgfoods.com/latest/');
//$config['IMGPATH']='http://db-bgfoods.com/latest/img/'; // for live

define('PATH','http://localhost/petgurudev/');
$config['IMGPATH']='http://localhost/petgurudev/app/webroot/img'; // for live

define('PRODUCTIMG',WWW_ROOT.'img/product/');
define('IMG_FOLDER',WWW_ROOT.'img');


// hrere define categories image url

define('PROTYPIMAGE',PATH.'img/product_types/');


$config['BRAND'] = array('1'=>'New brand added successfully.','2'=>'The brand name already exists.');

$config['NORECORD']=array('1'=>'There are no recent products available.','2'=>'There are no recent recipes available.',
			  '3'=>'No brands matched your search.','4'=>'No products matched your search.',
			  '5'=>'No recipes matched your search.',
                          '6'=>'No stores matched your search.',
                          '7'=>'No app stores matched your search.');

$config['LOGS'] = array('1'=>'New recipe added successfully.','2'=>'Recipe updated successfully.',
			'3'=>'The recipe deleted successfully.','4'=>'New Product added successfully.',
			'5'=>'Product updated successfully.','6'=>'The Product deleted successfully.',
			'7'=>'New brand added successfully.','8'=>'Brand updated successfully.',
			'9'=>'The brand deleted successfully.');
			
