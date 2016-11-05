/**
 * jquery.bears_core.admin.js
 * Author: Bearsthemes
 * Author Uri: http://bearsthemes.com
 * Email: bearsthemes@gmail.com
 * Version: 1.0
 */

! ( function( $ ) {
	'use strict';

	var bcoreAPI = function() {
		this.init();
	}

	bcoreAPI.prototype = {
		init: function() {
			this.accordionHandle();
			this.backupdatabaseHandle();
		},
		accordionHandle: function() {
			$( '.bcore-block-accordion-wrap' ).each( function() {
				var $accordionWrap = $( this );

				$accordionWrap.find( '.bcore-block-accordion-body' ).slideUp( 0 );
				$accordionWrap.find( '.bcore-block-accordion' ).first().find( '.bcore-block-accordion-body' ).slideDown( 'slow' );

				$accordionWrap.on( 'click', '.bcore-block-accordion > .title', function() {
					var $accordionItem = $( this ).parent( '.bcore-block-accordion' );
					$accordionWrap.find( '.bcore-block-accordion-body' ).slideUp( 'slow' );
					$accordionItem.find( '.bcore-block-accordion-body' ).slideDown( 'slow' );
				} )
			} )
		},
		backupdatabaseHandle: function() {
			$( 'body' ).on( 'click', '#bcore-backupdatabase-handle', function( e ) {
				e.preventDefault();
				var $this = $( this ),
					path = $( this ).data( 'path' ),
					uri = $( this ).data( 'uri' );

				$this.addClass( 'bcore-ajax-loading' );

				$.ajax( {
					type: 'POST',
					url: bcore_object.ajax_url,
					data: { action: 'bcore_backupDatabase_handle', path: path, uri: uri },
					success: function( result ) {
						// console.log( result );
						$this.removeClass( 'bcore-ajax-loading' );
						$this.parents( '.bcore-block-accordion-body' ).append( $( result ).css( 'display', 'none' ).fadeIn( 'slow' ) );
					},
					error: function( e ) {
						alert( JSON.stringify( e ) );
						console.log( e )
					}
				} )
			} )

			/* Restore */
			$( 'body' ).on( 'click', 'a.bcore-restore-database', function( e ) {
				e.preventDefault();

				var $this = $( this ),
					$rowElem = $( this ).parents( '.table-row' ),
					file = $( this ).data( 'file' ),
					ask = confirm( 'Do you want RESTORE database?' );

				if( ask == true ) {
				    $rowElem.addClass( 'bcore-ajax-loading' );

				    $.ajax( {
						type: 'POST',
						url: bcore_object.ajax_url,
						data: { action: 'bcore_restoreDatabase_handle', file: file },
						success: function( result ) {
							alert( result );
							$rowElem.removeClass( 'bcore-ajax-loading' );
							console.log( result );
						},
						error: function( e ) {
							alert( JSON.stringify( e ) );
							console.log( e )
						}
					} )
				}
			} )

			/* Delete */
			$( 'body' ).on( 'click', 'a.bcore-delete-database', function( e ) {
				e.preventDefault();

				var $rowElem = $( this ).parents( '.table-row' ),
					file = $( this ).data( 'file' ),
					ask = confirm( 'Do you want DELETE this file?' );

				if( ask == true ) {
				    $rowElem.addClass( 'bcore-ajax-loading' );

				    $.ajax( {
						type: 'POST',
						url: bcore_object.ajax_url,
						data: { action: 'bcore_deleteDatabase_handle', file: file },
						success: function( result ) {
							alert( result );
							$rowElem.fadeOut( 'slow', function() { $( this ).remove() } );
							console.log( result );
						},
						error: function( e ) {
							alert( JSON.stringify( e ) );
							console.log( e )
						}
					} )
				}
			} )
		}
	}

	/* DOM Reaady */
	$( function() {

		/* use bcoreAPI */
		new bcoreAPI();
	} ) 
} )( jQuery )
