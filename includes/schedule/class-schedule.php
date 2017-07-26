<?php
/**
 * Schedule: Schedule class
 *
 * All the functionality for the schedule meta box for the plugin.
 *
 * @package QueueWP\Schedule
 * @since 0.1
 */

namespace QueueWP\Schedule;

use QueueWP\QueueWP;

/**
 * Class Schedule
 *
 * @package QueueWP\Schedule
 * @since 0.1
 */
class Schedule {
	/**
	 * The handle used to register and enqueue scripts for the metabox.
	 *
	 * @since 0.1
	 */
	const META_BOX_STYLE_HANDLE = 'queuewp_meta_box_admin_css';

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'create_meta_box' ), 1 );
	}

	/**
	 * Actually creates the metabox for scheduling social posts.
	 *
	 * @since 0.1
	 */
	public function create_meta_box() {
		$screen = get_current_screen();

		if ( ! empty( $screen ) && ( 'post' === $screen->post_type || 'page' === $screen->post_type ) ) {
			add_meta_box(
				'queuewp',
				__( 'QueueWP', 'queuewp' ),
				array( $this, 'render_meta_box' ),
				'',
				'normal',
				'high'
			);

			add_action( 'admin_enqueue_scripts', array( $this, 'meta_box_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'meta_box_styles' ) );
		}
	}

	/**
	 * Renders the content of the meta box by loading the template.
	 *
	 * @since 0.1
	 */
	public function render_meta_box() {
		QueueWP::get()->utility()->template->load( 'schedule/meta-box' );
	}

	/**
	 * Loads the Javascript functionality to the admin area for a meta box.
	 *
	 * @since 0.1
	 */
	public function meta_box_scripts() {
		wp_register_script(
			self::META_BOX_STYLE_HANDLE,
			QueueWP::get()->plugin_url . 'assets/js/admin/meta-box.js',
			array( 'jquery', 'utils', 'wp-util' ),
			'0.1',
			true
		);

		wp_add_inline_script( self::META_BOX_STYLE_HANDLE, 'queueWPMetaBox.init();', 'after' );
		wp_enqueue_script( self::META_BOX_STYLE_HANDLE );
	}

	/**
	 * Adds styles to the admin area for the QueueWP meta box.
	 *
	 * @since 0.1
	 */
	public function meta_box_styles() {
		wp_register_style( self::META_BOX_STYLE_HANDLE, QueueWP::get()->plugin_url . 'assets/css/admin/meta-box.css', false, '0.1' );
		wp_enqueue_style( self::META_BOX_STYLE_HANDLE );
	}
}
