<?php
/**
 * Tests: Custom Post Types class
 *
 * Tests the functionality in setup/class-custom-post-types.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Setup\Custom_Post_Types;

/**
 * Class Custom_Post_Types
 *
 * Tests for the Custom_Post_Types class methods.
 *
 * @since 0.1
 * @covers QueueWP\Setup\Custom_Post_Types
 */
class Test_Custom_Post_Types extends \WP_UnitTestCase {
	/**
	 * Instance of the Custom_Post_Types class
	 *
	 * @since 0.1
	 * @var Custom_Post_Types
	 */
	public $instance;

	/**
	 * Setup the tests.
	 *
	 * @since 0.1
	 */
	public function setUp() {
		parent::setUp();

		$this->instance = new Custom_Post_Types();
	}

	/**
	 * Make sure that the action is added.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Custom_Post_Types::init()
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 10, has_action( 'init', array( $this->instance, 'setup' ) ) );
	}

	/**
	 * Make sure that the Custom Post Type is registered.
	 *
	 * @since 0.1
	 * @covers QueueWP\Setup\Custom_Post_Types::setup()
	 */
	public function test_setup() {
		$this->instance->setup();
		$this->assertTrue( post_type_exists( Custom_Post_Types::QUEUE_POST_TYPE_NAME ) );
	}
}
