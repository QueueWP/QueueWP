<?php
/**
 * Accounts: QueueWP class
 *
 * Handles the authentication and setup of a QueueWP account.
 *
 * @package QueueWP\Accounts
 * @since 0.1
 */

namespace QueueWP\Accounts;

/**
 * Class QueueWP
 *
 * @package QueueWP\Accounts
 * @since 0.1
 */
class QueueWP {
	/**
	 * The key of the client.
	 *
	 * @since 0.1
	 */
	const ACCOUNT_KEY = 'queuewp';

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_action( 'queuewp_accounts', array( $this, 'register_account' ) );
	}

	/**
	 * Register the QueueWP account type.
	 *
	 * @since 0.1
	 */
	public function register_account( $accounts ) {
		$accounts[ self::ACCOUNT_KEY ] = __( 'QueueWP', 'queuewp' );
		return $accounts;
	}

	/**
	 * Render the account connection form.
	 *
	 * @since 0.1
	 */
	public function render_settings() {
		$token = '';

		if ( empty( $token ) ) {
			\QueuewP\QueueWP::get()->utility()->template->load( 'accounts/queuewp-connect' );
		}
	}
}
