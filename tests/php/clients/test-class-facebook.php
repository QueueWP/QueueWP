<?php
/**
 * Tests the functionality in clients/class-facebook.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Clients\Facebook;

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
	 * @covers QueueWP\Clients\Facebook::init()
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 10, has_filter( 'queuewp_clients', array( $this->instance, 'register_client' ) ) );
	}

	/**
	 * Tests that Facebook gets added to the registered account clients array.
	 *
	 * @since 0.1
	 * @covers QueueWP\Clients\Facebook::register_client()
	 */
	public function test_register_client() {
		$client = $this->instance->register_client( array() );
		$this->assertNotEmpty( $client['facebook'] );
		$this->assertContains( 'Facebook', $client['facebook']['label'] );
	}

	/**
	 * Tests that the account client form gets rendered.
	 *
	 * @since 0.1
	 * @covers QueueWP\Clients\Facebook::render_settings()
	 */
	public function test_render_settings() {
		ob_start();
		$this->instance->render_settings();
		$settings = ob_get_clean();

		$this->assertContains( '<input type="submit" value="Connect To Facebook.com" />', $settings );
	}
}
