<?php
/**
 * Tests: Meta Box
 *
 * Tests the functionality in admin/class-meta-box.php
 *
 * @package Social_Queue
 * @since 0.1
 */

use Social_Queue\Social_Queue;
use Social_Queue\Admin\Meta_Box;

class Test_Meta_Box extends \WP_UnitTestCase {
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
	 * Tests that actions are registered.
	 *
	 * @covers Social_Queue\Admin\Meta_Box::__construct()
	 */
	public function test_construct() {
		$this->assertEquals( 1, has_action( 'add_meta_boxes', array( Social_Queue::get()->admin->meta_box, 'create_meta_box' ) ) );
		$this->assertEquals( 10, has_action( 'admin_enqueue_scripts', array( Social_Queue::get()->admin->meta_box, 'meta_box_scripts' ) ) );
		$this->assertEquals( 10, has_action( 'admin_enqueue_scripts', array( Social_Queue::get()->admin->meta_box, 'meta_box_styles' ) ) );
	}

	/**
	 * Tests that content is rendered to a meta box.
	 *
	 * @covers Social_Queue\Admin\Meta_Box::render_meta_box()
	 */
	public function test_render_meta_box() {
		ob_start();
		Social_Queue::get()->admin->meta_box->render_meta_box();
		$meta_box = ob_get_clean();

		$this->assertContains( '<div id="social-queue-meta-box">', $meta_box );
	}

	/**
	 * Tests that the admin scripts are loaded.
	 *
	 * @covers Social_Queue\Admin\Meta_Box::meta_box_scripts()
	 */
	public function test_meta_box_scripts() {
		Social_Queue::get()->admin->meta_box->meta_box_scripts();
		$this->assertTrue( wp_script_is( Meta_Box::META_BOX_STYLE_HANDLE, 'registered' ) );
		$this->assertTrue( wp_script_is( Meta_Box::META_BOX_STYLE_HANDLE, 'enqueued' ) );
	}

	/**
	 * Tests that the admin styles are loaded.
	 *
	 * @covers Social_Queue\Admin\Meta_Box::meta_box_styles()
	 */
	public function test_meta_box_styles() {
		Social_Queue::get()->admin->meta_box->meta_box_styles();
		$this->assertTrue( wp_style_is( Meta_Box::META_BOX_STYLE_HANDLE, 'registered' ) );
		$this->assertTrue( wp_style_is( Meta_Box::META_BOX_STYLE_HANDLE, 'enqueued' ) );
	}
}