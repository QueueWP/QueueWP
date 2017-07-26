<?php
/**
 * Tests: Facebook
 *
 * Tests the functionality in accounts/class-facebook.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Accounts\Facebook;

class Test_Facebook extends \WP_UnitTestCase {
	/**
	 * Instance of the Facebook class
	 *
	 * @since 0.1
	 * @var Facebook
	 */
	public $instance;

	/**
	 * Setup the tests.
	 *
	 * @since 0.1
	 */
	public function setUp() {
		parent::setUp();

		$this->instance = new Facebook();
	}

	/**
	 * Tests that actions are registered.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Facebook::init()
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 10, has_filter( 'queuewp_accounts', array( $this->instance, 'register_account' ) ) );
	}

	/**
	 * Tests that Facebook gets added to the registered accounts array.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Facebook::register_account()
	 */
	public function test_register_account() {
		$accounts = $this->instance->register_account( array() );
		$this->assertContains( 'Facebook', $accounts );
	}

	/**
	 * Tests that the account form gets rendered.
	 *
	 * @since 0.1
	 * @covers QueueWP\Accounts\Facebook::render_settings()
	 */
	public function test_render_settings() {
		ob_start();
		$this->instance->render_settings();
		$settings = ob_get_clean();

		$this->assertContains( '<input type="submit" value="Connect To Facebook.com" />', $settings );
	}
}
