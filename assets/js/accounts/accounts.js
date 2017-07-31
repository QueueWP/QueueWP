/* global jQuery */
/* eslint-disable complexity */
/* eslint consistent-this: [ "error", "control" ] */
/* exported queueWPAccounts, _queueWPAccountsSettings */
var queueWPAccounts = ( function( $ ) {
	'use strict';

	var component = {
			action: '',
			nonce: ''
		},
		elAccountsSelect = $( '#queuewp-accounts' );

	if ( 'undefined' !== typeof _queueWPAccountsSettings ) {
		$.extend( component, _queueWPAccountsSettings );
	}

	component.init = function() {
		elAccountsSelect.on( 'change', '.account_client', function( e ) {
			var result = wp.ajax.post(
				component.action,
				{
					nonce: component.nonce,
					client: $( '.account_client' ).val()
				}
			);

			result.always( function( data ) {
				$( '#queuewp-account-settings' ).html( data );
			} );
		} );
	};

	return component;
} )( jQuery );