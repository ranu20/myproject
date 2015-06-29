<?php
App::uses('AttributeProduct', 'Model');

/**
 * AttributeProduct Test Case
 *
 */
class AttributeProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.attribute_product',
		'app.attribute',
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
		$this->AttributeProduct = ClassRegistry::init('AttributeProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AttributeProduct);

		parent::tearDown();
	}

}
