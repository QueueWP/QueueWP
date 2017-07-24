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
	 * The handle used to register and enqueue scripts for the accounts scripts.
	 *
	 * @since 0.1
	 */
	const JS_HANDLE = 'queuewp_accounts_js';

	const NONCE_ACTION = 'queuewp_accounts_nonce';

	const AJAX_ACTION = 'queuewp_account_settings';

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_action( 'add_meta_boxes', array( $this, 'create_meta_box' ), 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'accounts_scripts' ) );
		add_action( 'wp_ajax_' . self::AJAX_ACTION, array( $this, 'render_account_settings' ) );
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
		QueueWP::get()->utility()->template->load( 'accounts/meta-box', array( 'accounts' => $accounts ) );
	}

	/**
	 * Loads the Javascript functionality to the admin area for a meta box.
	 *
	 * @since 0.1
	 */
	public function accounts_scripts() {
		$screen = get_current_screen();

		if ( empty( $screen ) || Custom_Post_Types::ACCOUNTS_POST_TYPE_NAME !== $screen->post_type ) {
			return;
		}

		wp_register_script(
			self::JS_HANDLE,
			QueueWP::get()->plugin_url . 'assets/js/accounts/accounts.js',
			array( 'jquery', 'utils', 'wp-util' ),
			'0.1',
			true
		);

		$js_settings = array(
			'nonce'  => wp_create_nonce( self::NONCE_ACTION ),
			'action' => self::AJAX_ACTION,
		);

		wp_scripts()->add_data(
			self::JS_HANDLE,
			'data',
			sprintf( 'var _queueWPAccountsSettings = %s;', wp_json_encode( $js_settings ) )
		);

		wp_add_inline_script( self::JS_HANDLE, 'queueWPAccounts.init();', 'after' );
		wp_enqueue_script( self::JS_HANDLE );
	}

	public function render_account_settings() {
		if ( empty( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), self::NONCE_ACTION ) ) {
			return;
		}

		$account = sanitize_text_field( wp_unslash( $_POST['account'] ) );
		$clients = QueueWP::get()->accounts()->clients;

		if ( array_key_exists( $account, $clients ) && method_exists( $clients[ $account ], 'render_settings' ) ) {
			$clients[ $account ]->render_settings();
		}
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
