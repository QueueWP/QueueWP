<?php
/**
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
 * @package QueueWP\Accounts
 * @since 0.1
 */
class Accounts {
	/**
	 * The Ajax action for fetching the accounts form.
	 *
	 * @since 0.1
	 */
	const AJAX_ACTION = 'queuewp_account_settings';

	/**
	 * The handle used to register and enqueue scripts for the accounts scripts.
	 *
	 * @since 0.1
	 */
	const JS_HANDLE = 'queuewp_accounts_js';

	/**
	 * Identifier of the meta box.
	 *
	 * @since 0.1
	 */
	const META_BOX_NAME = 'queuewp_accounts';

	/**
	 * Nonce for the accounts form.
	 *
	 * @since 0.1
	 */
	const NONCE_ACTION = 'queuewp_accounts_nonce';

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
				self::META_BOX_NAME,
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
		$clients = QueueWP::get()->clients()->clients;
		QueueWP::get()->utility()->template->load( 'accounts/meta-box', array( 'clients' => $clients ) );
	}

	/**
	 * Loads the Javascript functionality for the accounts page. These scripts
	 * are used when linking a new account, we use Ajax to fetch in an account
	 * form from the client.
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

	/**
	 * Ajax call back which gets an identifier for the type of account selected
	 * from the front end, then finds the client for that identifier and outputs
	 * the form to link the account which gets sent back via Ajax.
	 *
	 * @since 0.1
	 */
	public function render_account_settings() {
		if ( empty( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), self::NONCE_ACTION ) ) {
			return;
		}

		$client  = sanitize_text_field( wp_unslash( $_POST['client'] ) );
		$clients = QueueWP::get()->clients()->registered_clients;

		if ( array_key_exists( $client, $clients ) && method_exists( $clients[ $client ], 'render_settings' ) ) {
			$clients[ $client ]->render_settings();
		}

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			wp_die();
		}
	}
}
