<?php
/**
 * Accounts: Facebook class
 *
 * Handles the authentication and setup of a Facebook account.
 *
 * @package QueueWP\Accounts
 * @since 0.1
 */

namespace QueueWP\Accounts;

use QueueWP\QueueWP;

/**
 * Class Facebook
 *
 * @package QueueWP\Accounts
 * @since 0.1
 */
class Facebook {
	/**
	 * The key of the client.
	 *
	 * @since 0.1
	 */
	const ACCOUNT_KEY = 'facebook';

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_action( 'queuewp_accounts', array( $this, 'register_account' ) );
	}

	/**
	 * Register the Facebook account type.
	 *
	 * @since 0.1
	 */
	public function register_account( $accounts ) {
		$accounts[ self::ACCOUNT_KEY ] = __( 'Facebook', 'queuewp' );
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
			QueueWP::get()->utility()->template->load( 'accounts/facebook-connect' );
		}
	}
}
