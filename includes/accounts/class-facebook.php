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

/**
 * Class Facebook
 *
 * @package QueueWP\Accounts
 * @since 0.1
 */
class Facebook {
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
		$accounts['facebook'] = __( 'Facebook', 'queuewp' );
		return $accounts;
	}
}
