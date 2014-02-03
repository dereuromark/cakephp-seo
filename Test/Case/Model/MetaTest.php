<?php
App::uses('Meta', 'Seo.Model');

/**
 * Meta Test Case
 *
 */
class MetaTest extends CakeTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array(
		'plugin.seo.meta'
	);

	/**
	 * SetUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();
		$this->Meta = ClassRegistry::init('Seo.Meta');
	}

/**
 * TearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Meta);

		parent::tearDown();
	}

/**
 * testRetrieveBySlug method
 *
 * @return void
 */
	public function testRetrieveBySlug() {
		$result = $this->Meta->retrieveBySlug('some-slug');
		debug($result);
	}

}
