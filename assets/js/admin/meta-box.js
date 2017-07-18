/* global jQuery */
/* eslint-disable complexity */
/* eslint consistent-this: [ "error", "control" ] */
/* exported queueWPMetaBox */
var queueWPMetaBox = ( function( $ ) {
	'use strict';

	var component			= {},
		elMetaBox			= $( '#queuewp-meta-box' ),
		elEditor			= $( '.queuewp-custom-content' ),
		elScheduleAutomatic	= $( '.queuewp-schedule-automatic' ),
		elScheduleManual	= $( '.queuewp-schedule-manual' );

	component.init = function() {
		elMetaBox.on( 'click', '.queuewp-edit',  function( e ) {
			component.toggleContent( e, elEditor, true );
		} );

		elMetaBox.on( 'click', '.queuewp-schedule-no-action', function() {
			component.hideContent( [ elScheduleAutomatic, elScheduleManual ] );
		} );

		elMetaBox.on( 'click', '.queuewp-schedule-automatic-action', function( e ) {
			component.hideContent( [ elScheduleManual ] );
			component.toggleContent( e, elScheduleAutomatic, false );
		} );

		elMetaBox.on( 'click', '.queuewp-schedule-manual-action', function( e ) {
			component.hideContent( [ elScheduleAutomatic ] );
			component.toggleContent( e, elScheduleManual, false );
		} );
	};

	component.toggleContent = function( e, content, preventDefault ) {
		if ( preventDefault ) {
			e.preventDefault();
		}

		content.toggle();
	};

	component.hideContent = function( contentList ) {
		_.each( contentList, function( el ) {
			el.hide();
		} );
	};

	return component;
} )( jQuery );
