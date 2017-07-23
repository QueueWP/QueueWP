<?php
/**
 * Tests: Accounts
 *
 * Tests the functionality in accounts/class-accounts.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Accounts\Accounts;

class Test_Accounts extends \WP_UnitTestCase {
	/**
	 * Instance of the Accounts class
	 *
	 * @since 0.1
	 * @var Accounts
	 */
	public $instance;

	/**
	 * Setup the tests.
	 *
	 * @since 0.1
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
		set_current_screen( 'edit.php?post_type=queuewp_accounts' );

		$this->instance = new Accounts();
	}

	/**
	 * Tests that actions are registered.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Accounts::init()
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 1, has_action( 'add_meta_boxes', array( $this->instance, 'create_meta_box' ) ) );
	}

	/**
	 * Tests that content is rendered to a meta box.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Accounts::render_meta_box()
	 */
	public function test_render_meta_box() {
		ob_start();
		$this->instance->render_meta_box();
		$meta_box = ob_get_clean();

		$this->assertContains( '<select name="account_type">', $meta_box );
	}

	/**
	 * Test that registered accounts are added and returned.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Accounts::get_accounts()
	 */
	public function test_get_accounts() {
		add_filter( 'queuewp_accounts', function( $accounts ) {
			$accounts[] = 'Test';
			return $accounts;
		} );

		$accounts = $this->instance->get_accounts();
		$this->assertNotEmpty( $accounts );
		$this->assertContains( 'Test', $accounts );
	}
}
