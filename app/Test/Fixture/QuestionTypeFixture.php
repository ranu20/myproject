<?php
/**
 * QuestionTypeFixture
 *
 */
class QuestionTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'question_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'question_type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'question_type_id', 'unique' => 1)
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
			'question_type_id' => 1,
			'question_type' => 'Lorem ipsum dolor sit amet'
		),
	);

}
