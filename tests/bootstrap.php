<?php
/**
 * For now our test bootstrap relies on VVV architecture.
 *
 * @todo: Make this platform independent.
 */
require_once( '../../../../../wordpress-develop/tests/phpunit/includes/functions.php' );

function _manually_load_plugins() {
	require dirname( __FILE__ ) . '/../social-queue.php';
}

tests_add_filter( 'muplugins_loaded', '_manually_load_plugins' );

function _manually_activate_plugins() {
	$active_plugins[] = 'social-queue/social-queue.php';
}

tests_add_filter( 'site_option_active_sitewide_plugins', '_manually_activate_plugins' );
tests_add_filter( 'option_active_plugins', '_manually_activate_plugins' );

require_once( '../../../../../wordpress-develop/tests/phpunit/includes/bootstrap.php' );
