<?php
App::uses('QuestionAttribute', 'Model');

/**
 * QuestionAttribute Test Case
 *
 */
class QuestionAttributeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.question_attribute',
		'app.question',
		'app.question_type',
		'app.category',
		'app.attribute',
		'app.attribute_product',
		'app.product',
		'app.brand'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QuestionAttribute = ClassRegistry::init('QuestionAttribute');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QuestionAttribute);

		parent::tearDown();
	}

}
