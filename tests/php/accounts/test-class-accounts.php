<?php
/**
 * Tests the functionality in accounts/class-accounts.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\QueueWP;
use QueueWP\Accounts\Accounts;
use QueueWP\Setup\Custom_Post_Types;

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

		/*
		 * Fake that we're in the WordPress admin area.
		 *
		 * Rerun the setup since for this test, we want to load the files as if
		 * we're in the admin area.
		 */
		wp_set_current_user( 1 );
		set_current_screen( 'edit-' . Custom_Post_Types::ACCOUNTS_POST_TYPE_NAME );

		/*
		 * Re-run init on QueueWP class to re-create bootstrap and take in to
		 * account that we're now admin.
		 */
		QueueWP::get()->init();

		$this->instance = new Accounts();
	}

	/**
	 * Tear down the tests.
	 *
	 * @since 0.1
	 */
	public function tearDown() {
		parent::tearDown();

		// We're not admin anymore.
		unset( $GLOBALS['current_screen'] );

		// Reset plugin so that admin objects are not created.
		QueueWP::get()->init();
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
		$this->assertEquals( 10, has_action( 'admin_enqueue_scripts', array( $this->instance, 'accounts_scripts' ) ) );
		$this->assertEquals( 10, has_action( 'wp_ajax_' . Accounts::AJAX_ACTION, array( $this->instance, 'render_account_settings' ) ) );
	}

	/**
	 * Tests that meta box is created.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Accounts::create_meta_box()
	 */
	public function test_create_meta_box() {
		global $current_screen, $wp_meta_boxes;
		$current_screen->post_type = \QueueWP\Setup\Custom_Post_Types::ACCOUNTS_POST_TYPE_NAME;
		$this->instance->create_meta_box();
		// @todo: Expand this test to actually check for the metabox.
		$this->assertTrue( array_key_exists( 'edit-' . Accounts::META_BOX_NAME, $wp_meta_boxes ) );
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

		$this->assertContains( '<select name="account_client" class="account_client">', $meta_box );
	}

	/**
	 * Test JS scripts are registered and enqueued and that our settings are
	 * added.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Accounts::accounts_scripts()
	 */
	public function test_accounts_scripts() {
		$this->instance->accounts_scripts();

		// Scripts registered.
		$this->assertTrue( wp_script_is( Accounts::JS_HANDLE, 'registered' ) );

		// Settings added.
		$this->assertContains( 'var _queueWPAccountsSettings = {', wp_scripts()->get_data( Accounts::JS_HANDLE, 'data' ) );

		// Scripts enqueued.
		$this->assertTrue( wp_script_is( Accounts::JS_HANDLE, 'enqueued' ) );
	}

	/**
	 * Test that the account form renders.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Accounts::render_account_settings()
	 */
	public function test_render_account_settings() {
		// Fake form values.
		$_POST['client'] = 'facebook';
		$_POST['nonce']  = wp_create_nonce( Accounts::NONCE_ACTION );

		// Setup our clients.
		\QueueWP\QueueWP::get()->init();

		ob_start();
		$this->instance->render_account_settings();
		$settings = ob_get_clean();

		$this->assertContains( '<input type="submit" value="Connect To Facebook.com" />', $settings );

		// Bad client form values.
		$_POST['client'] = 'none';
		$_POST['nonce']  = wp_create_nonce( Accounts::NONCE_ACTION );

		ob_start();
		$this->instance->render_account_settings();
		$settings = ob_get_clean();

		$this->assertEmpty( $settings );
	}
}
