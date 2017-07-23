<?php
/**
 * Admin: Accounts class
 *
 * Handles the accounts page when linking to a new social network.
 *
 * @package QueueWP\Accounts
 * @since 0.1
 */

namespace QueueWP\Accounts;

use QueueWP\QueueWP;
use QueueWP\Setup\Custom_Post_Types;

/**
 * Class Accounts
 *
 * @package QueueWP\Admin
 * @since 0.1
 */
class Accounts {
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
	 * Actually creates the metabox for linking an account.
	 *
	 * @since 0.1
	 */
	public function create_meta_box() {
		$screen = get_current_screen();

		if ( ! empty( $screen ) && ( Custom_Post_Types::ACCOUNTS_POST_TYPE_NAME === $screen->post_type ) ) {
			add_meta_box(
				'queuewp_accounts',
				__( 'Link Account', 'queuewp' ),
				array( $this, 'render_meta_box' ),
				'',
				'normal',
				'high'
			);
		}
	}

	/**
	 * Renders the content of the meta box by loading the template.
	 *
	 * @since 0.1
	 */
	public function render_meta_box() {
		$accounts = $this->get_accounts();
		QueueWP::get()->utility()->template->load( 'accounts/choose', array( 'accounts' => $accounts ) );
	}

	/**
	 * Returns a list of registered accounts.
	 *
	 * @since 0.1
	 * @return array
	 */
	public function get_accounts() {
		/**
		 * QueueWP Accounts
		 *
		 * @since 2.1
		 * @param array $accounts The accounts currently registered.
		 */
		return apply_filters( 'queuewp_accounts', array() );
	}
}
