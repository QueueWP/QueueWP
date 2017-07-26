<?php
/**
 * All the functionality for the settings page.
 *
 * @package QueueWP\Settings
 * @since 0.1
 */

namespace QueueWP\Settings;

use QueueWP\Setup\Custom_Post_Types;

/**
 * Class Settings
 *
 * @package QueueWP\Settings
 * @since 0.1
 */
class Settings {
	/**
	 * Slug of the settings page.
	 *
	 * @since 0.1
	 */
	const SETTINGS_SLUG = 'queuewp-settings';

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_filter( 'admin_menu', array( $this, 'create_settings_page' ) );
	}

	/**
	 * Setup the sub menu for the settings page.
	 *
	 * @since 0.1
	 */
	public function create_settings_page() {
		add_submenu_page(
			'edit.php?post_type=' . Custom_Post_Types::QUEUE_POST_TYPE_NAME,
			__( 'QueueWP Settings', 'queuewp' ),
			__( 'Settings', 'queuewp' ),
			'manage_options',
			self::SETTINGS_SLUG,
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Render the settings form.
	 *
	 * @since 0.1
	 */
	public function render_settings_page() {
		\QueuewP\QueueWP::get()->utility()->template->load( 'settings/settings' );
	}
}
