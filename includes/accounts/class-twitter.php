<?php
/**
 * Accounts: Twitter class
 *
 * Handles the authentication and setup of a Twitter account.
 *
 * @package QueueWP\Accounts
 * @since 0.1
 */

namespace QueueWP\Accounts;

/**
 * Class Twitter
 *
 * @package QueueWP\Accounts
 * @since 0.1
 */
class Twitter {
	/**
	 * The key of the client.
	 *
	 * @since 0.1
	 */
	const ACCOUNT_KEY = 'twitter';

	/**
	 * Init.
	 *
	 * @since 0.1
	 */
	public function init() {
		add_action( 'queuewp_accounts', array( $this, 'register_account' ) );
	}

	/**
	 * Register the Twitter account type.
	 *
	 * @since 0.1
	 */
	public function register_account( $accounts ) {
		$accounts['twitter'] = __( 'Twitter', 'queuewp' );
		return $accounts;
	}
}
