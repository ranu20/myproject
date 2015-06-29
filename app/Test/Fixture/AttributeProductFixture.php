<?php
/**
 * AttributeProductFixture
 *
 */
class AttributeProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'attribute_product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'attribute_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => true, 'default' => null),
		'updated_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'attribute_product_id', 'unique' => 1)
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
			'attribute_product_id' => 1,
			'attribute_id' => 1,
			'product_id' => 1,
			'deleted' => 1,
			'updated_date' => '2013-09-13 09:45:56'
		),
	);

}
