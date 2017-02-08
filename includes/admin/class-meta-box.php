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
	 * Meta Box Handle
	 *
	 * The handle used to register and enqueue scripts for the metabox.
	 *
	 * @since 0.1
	 */
	const META_BOX_STYLE_HANDLE = 'social_queue_meta_box_admin_css';

	/**
	 * Meta_Box constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'create_meta_box' ), 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'meta_box_styles' ) );
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

	public function meta_box_styles() {
		wp_register_style( self::META_BOX_STYLE_HANDLE, Social_Queue::get()->plugin_url . 'assets/css/admin/meta-box.css', false, '0.1' );

		/**
		 * @todo: we should only enqueue this if we're on a admin page which shows the metabox.
		 */
		wp_enqueue_style( self::META_BOX_STYLE_HANDLE );
	}
}
