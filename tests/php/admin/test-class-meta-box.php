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
	 * @covers Social_Queue\Admin\Meta_Box::__construct()
	 */
	public function test_actions_added() {
		$this->assertEquals( 1, has_action( 'add_meta_boxes', array( Social_Queue::get()->admin->meta_box, 'create_meta_box' ) ) );
	}
}