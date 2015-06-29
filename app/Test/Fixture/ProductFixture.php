<?php
/**
 * ProductFixture
 *
 */
class ProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'product_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'brand_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'updated_date' => array('type' => 'timestamp', 'null' => true, 'default' => 'CURRENT_TIMESTAMP'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'product_id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'product_id' => 1,
			'product_name' => 'Lorem ipsum dolor sit amet',
			'brand_id' => 1,
			'deleted' => 1,
			'updated_date' => 1379058324
		),
	);

}
