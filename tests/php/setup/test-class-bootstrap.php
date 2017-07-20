<?php
/**
 * Tests: Bootstrap class
 *
 * Tests the functionality in setup/class-bootstrap.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Setup\Bootstrap;

/**
 * Class Test_Bootstrap
 *
 * Tests for the Bootstrap class methods.
 *
 * @since 0.1
 * @covers QueueWP\Setup\Bootstrap
 */
class Test_Bootstrap extends \WP_UnitTestCase {
	/**
	 * Instance of the Bootstrap class
	 *
	 * @var Bootstrap
	 */
	public $instance;

	/**
	 * Setup the tests.
	 */
	public function setUp() {
		parent::setUp();

		/**
		 * Fake that we're in the WordPress admin area.
		 *
		 * Rerun the setup since for this test, we want to load the files as if
		 * we're in the admin area.
		 */
		wp_set_current_user( 1 );
		set_current_screen( 'edit.php' );

		$this->instance = new Bootstrap();
	}

	/**
	 * Tests if objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Bootstrap::setup_init()
	 */
	public function test_setup_init() {
		$this->instance->setup_init();
		$this->assertNotEmpty( $this->instance->setup->custom_post_types );
		$this->assertInstanceOf( 'QueueWP\Setup\Custom_Post_Types', $this->instance->setup->custom_post_types );
	}

	/**
	 * Tests if objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Bootstrap::general_init()
	 */
	public function test_general_init() {
		$this->instance->general_init();
		$this->assertNotEmpty( $this->instance->utility->template );
		$this->assertInstanceOf( 'QueueWP\Utility\Template', $this->instance->utility->template );
	}

	/**
	 * Tests if admin objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Bootstrap::admin_init()
	 */
	public function test_admin_init() {
		$this->instance->admin_init();
		$this->assertNotEmpty( $this->instance->admin->meta_box );
		$this->assertInstanceOf( 'QueueWP\Admin\Meta_Box', $this->instance->admin->meta_box );
	}
}