<?php
/**
 * Tests: Load class
 *
 * Tests the functionality in setup/class-load.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\QueueWP;

/**
 * Class Test_Load
 *
 * Tests for the Load class methods.
 *
 * @since 0.1
 * @covers QueueWP\Setup\Load
 */
class Test_Load extends \WP_UnitTestCase {

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
		QueueWP::get()->setup->bootstrap->load_admin();
		QueueWP::get()->setup->bootstrap->init_admin();
	}

	/**
	 * Tests that classes are loaded.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Load::general_load()
	 */
	public function test_general_load() {
		$this->assertTrue( class_exists( 'QueueWP\Utility\Template' ) );
	}

	/**
	 * Tests if objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Load::general_init()
	 */
	public function test_general_init() {
		$this->assertNotEmpty( QueueWP::get()->utility->template );
		$this->assertInstanceOf( 'QueueWP\Utility\Template', QueueWP::get()->utility->template );
	}

	/**
	 * Tests if admin classes are loaded.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Load::load_admin()
	 */
	public function test_load_admin() {
		$this->assertTrue( class_exists( 'QueueWP\Admin\Meta_Box' ) );
	}

	/**
	 * Tests if admin objects are created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Load::init_admin()
	 */
	public function test_init_admin() {
		$this->assertNotEmpty( QueueWP::get()->admin->meta_box );
		$this->assertInstanceOf( 'QueueWP\Admin\Meta_Box', QueueWP::get()->admin->meta_box );
	}

	/**
	 * Tests if the admin collection is returned.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Load::get_admin_collection()
	 */
	public function test_get_admin_collection() {
		$this->assertTrue( is_object( QueueWP::get()->setup->bootstrap->get_admin_collection() ) );
	}

	/**
	 * Tests if the utility collection is returned.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Load::get_utility_collection()
	 */
	public function test_get_utility_collection() {
		$this->assertTrue( is_object( QueueWP::get()->setup->bootstrap->get_utility_collection() ) );
	}
}