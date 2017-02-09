<?php
/**
 * Tests: Social_Queue class
 *
 * Tests the functionality in social-queue.php
 *
 * @package Social_Queue
 * @since 0.1
 */

use Social_Queue\Social_Queue;

/**
 * Class Test_Social_Queue
 *
 * Tests for the Social_Queue class methods.
 *
 * @package Social_Queue
 * @since 0.1
 */
class Test_Social_Queue extends WP_UnitTestCase {
	/**
	 * Tests that an instand sets up the global paths.
	 *
	 * @covers Social_Queue::__construct()
	 */
	public function test_construct() {
		$this->assertTrue( strlen( Social_Queue::get()->plugin_url ) > 0 );
		$this->assertTrue( strlen( Social_Queue::get()->plugin_dir ) > 0 );
	}

	/**
	 * Test that only one of the same instance will get returned and exist in
	 * memory.
	 *
	 * @covers Social_Queue::get()
	 */
	public function test_get() {
		$this->assertTrue( is_object( Social_Queue::get() ) );
		$this->assertInstanceOf( 'Social_Queue\Social_Queue', Social_Queue::get() );

		$instance2 = Social_Queue::get();
		$this->assertTrue( Social_Queue::get() === $instance2 );
	}

	/**
	 * Tests that files are loaded and objects are created.
	 *
	 * @covers Social_Queue::setup()
	 */
	public function test_setup() {
		$this->assertTrue( class_exists( 'Social_Queue\Setup\Load' ) );
		$this->assertInstanceOf( 'Social_Queue\Setup\Load', Social_Queue::get()->setup->load );
		$this->assertTrue( is_object( Social_Queue::get()->admin ) );
		$this->assertTrue( is_object( Social_Queue::get()->utility ) );
	}
}