<?php
/**
 * Tests: Template class
 *
 * Tests the functionality in utility/class-template.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Utility\Template;

/**
 * Class Test_Template
 *
 * Tests for the Template class methods.
 *
 * @since 0.1
 * @covers QueueWP\Utility\Template
 */
class Test_Template extends \WP_UnitTestCase {
	/**
	 * Instance of the Template class
	 *
	 * @since 0.1
	 * @var Template
	 */
	public $instance;

	/**
	 * Setup the tests.
	 *
	 * @since 0.1
	 */
	public function setUp() {
		parent::setUp();

		$this->instance = new Template();
	}

	/**
	 * Make sure that a template gets loaded.
	 *
	 * @since 0.1
	 * @covers QueueWP\Utility\Template::load()
	 */
	public function test_load() {
		ob_start();
		$this->instance->load( 'admin/meta-box' );
		$template = ob_get_clean();

		$this->assertContains( '<div id="queuewp-meta-box">', $template );
	}

	/**
	 * Make sure that data gets passed through to a template.
	 *
	 * @since 0.1
	 * @covers QueueWP\Utility\Template::load()
	 */
	public function test_load_data() {
		ob_start();
		$this->instance->load( 'accounts/choose', array( 'accounts' => array( 'twitter' => 'Twitter' ) ) );
		$template = ob_get_clean();

		$this->assertContains( '<option value="twitter">Twitter</option>', $template );
	}
}
