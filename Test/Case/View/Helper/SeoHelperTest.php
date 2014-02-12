<?php

App::uses('SeoHelper', 'Seo.View/Helper');
App::uses('MyCakeTestCase', 'Tools.TestSuite');
App::uses('View', 'View');

class SeoHelperTest extends MyCakeTestCase {

	public $Seo;

	public function setUp() {
		parent::setUp();

		$this->Seo = new SeoHelper(new View(null));
	}

	public function tearDown() {
		unset($this->Seo);

		parent::tearDown();
	}

	public function testObject() {
		$this->assertInstanceOf('SeoHelper', $this->Seo);
	}

	/**
	 * SeoHelperTest::testBreadcrumb()
	 *
	 * @return void
	 */
	public function testBreadcrumb() {
		$expected = '<li class="first"><a href="/">Startseite</a></li>';
		$result = $this->Seo->breadcrumb();
		$this->assertEquals($expected, $result);
	}
}
