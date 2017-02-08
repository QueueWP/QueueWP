<?php
/**
 * Tests: Load class
 *
 * Tests the functionality in setup/class-load.php
 *
 * @package Social_Queue
 * @since 0.1
 */

use Social_Queue\Social_Queue;

/**
 * Class Test_Load
 *
 * Tests for the Load class methods.
 *
 * @covers Social_Queue\Setup\Load
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
		Social_Queue::get()->setup->load->load_admin();
		Social_Queue::get()->setup->load->init_admin();
	}

	/**
	 * @covers Social_Queue\Setup\Load::load()
	 */
	public function test_if_classes_are_loaded() {
		$this->assertTrue( class_exists( 'Social_Queue\Utility\Template' ) );
	}

	/**
	 * @covers Social_Queue\Setup\Load::init()
	 */
	public function test_if_objects_are_created() {
		$this->assertNotEmpty( Social_Queue::get()->utility->template );
		$this->assertInstanceOf( 'Social_Queue\Utility\Template', Social_Queue::get()->utility->template );
	}

	/**
	 * @covers Social_Queue\Setup\Load::load_admin()
	 */
	public function test_if_admin_classes_are_loaded() {
		$this->assertTrue( class_exists( 'Social_Queue\Admin\Meta_Box' ) );
	}

	/**
	 * @covers Social_Queue\Setup\Load::init_admin()
	 */
	public function test_if_admin_objects_are_created() {
		$this->assertNotEmpty( Social_Queue::get()->admin->meta_box );
		$this->assertInstanceOf( 'Social_Queue\Admin\Meta_Box', Social_Queue::get()->admin->meta_box );
	}

	/**
	 * @covers Social_Queue\Setup\Load::get_admin_collection()
	 */
	public function test_admin_collection_is_returned() {
		$this->assertTrue( is_object( Social_Queue::get()->setup->load->get_admin_collection() ) );
	}

	/**
	 * @covers Social_Queue\Setup\Load::get_utility_collection()
	 */
	public function test_utility_collection_is_returned() {
		$this->assertTrue( is_object( Social_Queue::get()->setup->load->get_utility_collection() ) );
	}
}