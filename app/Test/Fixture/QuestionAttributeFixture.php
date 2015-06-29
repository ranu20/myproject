<?php
/**
 * QuestionAttributeFixture
 *
 */
class QuestionAttributeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'question_attribute_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'question_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'attribute_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'updated_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'question_attribute_id', 'unique' => 1)
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
			'question_attribute_id' => 1,
			'question_id' => 1,
			'attribute_id' => 1,
			'deleted' => 1,
			'updated_date' => '2013-09-13 09:46:13'
		),
	);

}
