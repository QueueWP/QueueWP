/* global jQuery */
/* eslint-disable complexity */
/* eslint consistent-this: [ "error", "control" ] */
/* exported socialQueueMetaBox */
var socialQueueMetaBox = ( function( $ ) {
	'use strict';

	var component				= {},
		elEditButton		= $( '.social-queue-edit' ),
		elNoButton			= $( '.social-queue-schedule-no-action' ),
		elAutoButton		= $( '.social-queue-schedule-automatic-action' ),
		elManualButton		= $( '.social-queue-schedule-manual-action' ),
		elEditor			= $( '.social-queue-custom-content' ),
		elScheduleAutomatic	= $( '.social-queue-schedule-automatic' ),
		elScheduleManual	= $( '.social-queue-schedule-manual' );

	component.init = function() {
		elEditButton.on( 'click', function( event ) {
			component.toggleContent( event, elEditor, true );
		} );

		elNoButton.on( 'click', function() {
			component.hideContent( [ elScheduleAutomatic, elScheduleManual ] );
		} );

		elAutoButton.on( 'click', function( event ) {
			component.hideContent( [ elScheduleManual ] );
			component.toggleContent( event, elScheduleAutomatic, false );
		} );

		elManualButton.on( 'click', function( event ) {
			component.hideContent( [ elScheduleAutomatic ] );
			component.toggleContent( event, elScheduleManual, false );
		} );
	};

	component.toggleContent = function( event, content, preventDefault ) {
		if ( preventDefault ) {
			event.preventDefault();
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
