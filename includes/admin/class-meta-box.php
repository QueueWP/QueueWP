<?php
/**
 * Admin: Meta_Box class
 *
 * All the functionality for the main Meta Box for the plugin.
 *
 * @package Social_Queue\Admin
 * @since 0.1
 */

namespace Social_Queue\Admin;

use Social_Queue\Social_Queue;

/**
 * Class Meta_Box
 *
 * Creates the meta box.
 *
 * @package Social_Queue\Admin
 * @since 0.1
 */
class Meta_Box {

	/**
	 * Meta_Box constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'create_meta_box' ), 1 );
	}

	/**
	 * Create Meta Box
	 *
	 * Actually creates the metabox for scheduling social posts.
	 *
	 * @since 0.1
	 */
	public function create_meta_box() {
		add_meta_box(
			'social_queue',
			__( 'Social Queue', 'social-queue' ),
			array( $this, 'render_meta_box' ),
			'',
			'normal',
			'high'
		);
	}

	/**
	 * Render Meta Box
	 *
	 * Renders the content of the meta box by loading the template.
	 *
	 * @since 0.1
	 */
	public function render_meta_box() {
		Social_Queue::get()->utility->template->load( 'admin/meta-box.php' );
	}
}
