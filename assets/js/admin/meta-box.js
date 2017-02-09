/* global jQuery */
/* eslint-disable complexity */
/* eslint consistent-this: [ "error", "control" ] */
/* exported socialQueueMetaBox */
var socialQueueMetaBox = ( function( $ ) {
	'use strict';

	var component			= {},
		elMetaBox			= $( '#social-queue-meta-box' ),
		elEditor			= $( '.social-queue-custom-content' ),
		elScheduleAutomatic	= $( '.social-queue-schedule-automatic' ),
		elScheduleManual	= $( '.social-queue-schedule-manual' );

	component.init = function() {
		elMetaBox.on( 'click', '.social-queue-edit',  function( e ) {
			component.toggleContent( e, elEditor, true );
		} );

		elMetaBox.on( 'click', '.social-queue-schedule-no-action', function() {
			component.hideContent( [ elScheduleAutomatic, elScheduleManual ] );
		} );

		elMetaBox.on( 'click', '.social-queue-schedule-automatic-action', function( e ) {
			component.hideContent( [ elScheduleManual ] );
			component.toggleContent( e, elScheduleAutomatic, false );
		} );

		elMetaBox.on( 'click', '.social-queue-schedule-manual-action', function( e ) {
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
