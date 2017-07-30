<?php
/**
 * Tests: Scheduler class
 *
 * Tests the functionality in schedule/class-scheduler.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Schedule\Scheduler;

/**
 * Class Scheduler
 *
 * Tests for the Scheduler class methods.
 *
 * @since 0.1
 * @covers QueueWP\Schedule\Scheduler
 */
class Test_Scheduler extends \WP_UnitTestCase {
	/**
	 * Instance of the Scheduler class
	 *
	 * @since 0.1
	 * @var Scheduler
	 */
	public $instance;

	/**
	 * Setup the tests.
	 *
	 * @since 0.1
	 */
	public function setUp() {
		parent::setUp();

		$this->instance = new Scheduler();
	}

	/**
	 * Test that a new schedule post gets added.
	 *
	 * @since 0.1
	 * @covers QueueWP\Schedule\Scheduler::add_to_queue()
	 */
	public function test_add_to_queue() {
		// Create a post.
		$post_id = $this->factory()->post->create( array(
			'post_title' => 'Test Post',
		) );

		// @todo: implement these when networks are added.
		$accounts = array( 1 );

		// No account.
		$result = $this->instance->add_to_queue( $post_id, array(), 'Test tweet' );
		$this->assertTrue( is_wp_error( $result ) );
		$this->assertEquals( 'queuewp-error', $result->get_error_code() );
		$this->assertEquals( 'An account must be selected when scheduling a post', $result->get_error_message() );

		// No content.
		$result = $this->instance->add_to_queue( $post_id, $accounts, '' );
		$this->assertTrue( is_wp_error( $result ) );
		$this->assertEquals( 'queuewp-error', $result->get_error_code() );
		$this->assertEquals( 'Unable to schedule post without content defined', $result->get_error_message() );

		// Date in the past.
		$datetime = date( 'Y-m-d H:i:s', time() - 100 );
		$result = $this->instance->add_to_queue( $post_id, $accounts, 'Test tweet', $datetime );
		$this->assertTrue( is_wp_error( $result ) );
		$this->assertEquals( 'queuewp-error', $result->get_error_code() );
		$this->assertEquals( 'Cannot schedule a post in the past', $result->get_error_message() );

		// Legit post.
		$datetime = date( 'Y-m-d H:i:s', time() );
		$result = $this->instance->add_to_queue( $post_id, $accounts, 'Test tweet', $datetime );
		$post = get_post( $result );
		$this->assertEquals( \QueueWP\Setup\Custom_Post_Types::QUEUE_POST_TYPE_NAME, $post->post_type );
		$this->assertEquals( 'Test tweet', $post->post_title );
		$this->assertEquals( $datetime, $post->post_date );
		$this->assertEquals( $post_id, get_post_meta( $result, 'parent', true ) );
		$this->assertEquals( $accounts, get_post_meta( $result, 'accounts', true ) );
	}
}
