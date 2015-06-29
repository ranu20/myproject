<?php
/**
 * AttributeFixture
 *
 */
class AttributeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'attribute_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'attribute' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'weightage' => array('type' => 'integer', 'null' => false, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'updated_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'attribute_id', 'unique' => 1)
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
			'attribute_id' => 1,
			'attribute' => 'Lorem ipsum dolor sit amet',
			'weightage' => 1,
			'deleted' => 1,
			'updated_date' => '2013-09-13 09:42:59'
		),
	);

}
