<?php
/**
 * Tests: Schedule
 *
 * Tests the functionality in schedule/class-schedule.php
 *
 * @package QueueWP
 * @since 0.1
 */

use QueueWP\Schedule\Schedule;

class Test_Schedule extends \WP_UnitTestCase {
	/**
	 * Instance of the Schedule class
	 *
	 * @since 0.1
	 * @var Schedule
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
		set_current_screen( 'edit.php' );

		$this->instance = new Schedule();
	}

	/**
	 * Tests that actions are registered.
	 *
	 * @since 0.1
	 * @covers QueueWP\Schedule\Schedule::init()
	 */
	public function test_init() {
		$this->instance->init();
		$this->assertEquals( 1, has_action( 'add_meta_boxes', array( $this->instance, 'create_meta_box' ) ) );
	}

	/**
	 * Tests that create meta box enqueues scripts.
	 *
	 * @since 0.1
	 * @covers QueueWP\Schedule\Schedule::create_meta_box()
	 */
	public function test_create_meta_box() {
		$this->instance->create_meta_box();
		$this->assertEquals( 10, has_action( 'admin_enqueue_scripts', array( $this->instance, 'meta_box_scripts' ) ) );
		$this->assertEquals( 10, has_action( 'admin_enqueue_scripts', array( $this->instance, 'meta_box_styles' ) ) );
	}

	/**
	 * Tests that content is rendered to a meta box.
	 *
	 * @since 0.1
	 * @covers QueueWP\Schedule\Schedule::render_meta_box()
	 */
	public function test_render_meta_box() {
		ob_start();
		$this->instance->render_meta_box();
		$meta_box = ob_get_clean();

		$this->assertContains( '<div id="queuewp-meta-box">', $meta_box );
	}

	/**
	 * Tests that the admin scripts are loaded.
	 *
	 * @since 0.1
	 * @covers QueueWP\Schedule\Schedule::meta_box_scripts()
	 */
	public function test_meta_box_scripts() {
		$this->instance->meta_box_scripts();
		$this->assertTrue( wp_script_is( Schedule::META_BOX_STYLE_HANDLE, 'registered' ) );
		$this->assertTrue( wp_script_is( Schedule::META_BOX_STYLE_HANDLE, 'enqueued' ) );
	}

	/**
	 * Tests that the admin styles are loaded.
	 *
	 * @since 0.1
	 * @covers QueueWP\Schedule\Schedule::meta_box_styles()
	 */
	public function test_meta_box_styles() {
		$this->instance->meta_box_styles();
		$this->assertTrue( wp_style_is( Schedule::META_BOX_STYLE_HANDLE, 'registered' ) );
		$this->assertTrue( wp_style_is( Schedule::META_BOX_STYLE_HANDLE, 'enqueued' ) );
	}
}
