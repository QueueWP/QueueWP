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
		elAccountsSelect.on( 'change', '.account_type', function( e ) {
			var result = wp.ajax.post(
				component.action,
				{
					nonce: component.nonce,
					account: $( '.account_type' ).val()
				}
			);

			result.always( function( data ) {
				$( '#queuewp-account-settings' ).html( data );
			} );
		} );
	};

	return component;
} )( jQuery );