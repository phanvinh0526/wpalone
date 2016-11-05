!(function($){
	"use strict";
	jQuery(document).ready(function($) {
		//Back top
		function BearsthemeBackTop() {
			$('#bt-backtop').on('click', function() {
				$('html,body').animate({
					scrollTop: 0
				}, 400);
				return false;
			});

			if ($(window).scrollTop() > 300) {
				$('#bt-backtop').addClass('bt-show');
			} else {
				$('#bt-backtop').removeClass('bt-show');
			}

			$(window).on('scroll', function() {

				if ($(window).scrollTop() > 300) {
					$('#bt-backtop').addClass('bt-show');
				} else {
					$('#bt-backtop').removeClass('bt-show');
				}
			});
		}
		BearsthemeBackTop();
		//Date picker
		function BearsthemeDatePicker() {
			if ($('.ro-date-picker').length) {
				$('.ro-date-picker').datepicker();
			}
		}
		BearsthemeDatePicker();
		//useful var
		var $window = $(window);
		var mainMenuHeight = $('#bt-main-menu').height();
		/* Make easing scroll when click a link in page */
		function BearsthemeEasingMoving() {
			var $root = $('html, body');
			$('.bt-demo-select').on('click', function() {
				var href = $.attr(this, 'href');
				$root.animate({
					scrollTop: ($(href).offset().top - mainMenuHeight)
				}, 500, function() {
					window.location.hash = href;
				});
				return false;
			});
		}
		BearsthemeEasingMoving();
		//Video popup
		function Bearsthemeheadervideo() {
			$("#bt-play-button").on("click", function(e){
				e.preventDefault();
					$.fancybox({
					'padding' : 0,
					'autoScale': false,
					'transitionIn': 'none',
					'transitionOut': 'none',
					'title': this.title,
					'width': 720,
					'height': 405,
					'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
					'type': 'swf',
					'swf': {
					'wmode': 'transparent',
					'allowfullscreen': 'true'
					}
				});
			});
		}
		Bearsthemeheadervideo();
		/* Open the hide mini search */
		function BearsthemeOpenMiniSearchSidebar() {
			$('.bt-share-search-icon > li > a.search-icon').on('click', function() {
				$('#bt_header .widget_search').toggle();
			});
		}
		BearsthemeOpenMiniSearchSidebar()
		/* Open the hide social share */
		function BearsthemeOpenMiniSocialShareSidebar() {
			$('.bt-share-search-icon > li > a.share-icon').on('click', function() {
				$('#bt_header .bt-social-share').toggle();
			});
		}
		BearsthemeOpenMiniSocialShareSidebar();
		/* Open the hide mini cart */
		function BearsthemeOpenMiniCartSidebar() {
			$('.bt_widget_mini_cart .bt-cart-header > a.bt-icon').on('click', function() {
				$('.bt_widget_mini_cart .bt-cart-content').toggle();
			});
		}
		BearsthemeOpenMiniCartSidebar();
		/* Open the hide menu canvas */
		function BearsthemeOpenMenuSidebar() {
			$('.bt-menu-sidebar > a').on('click', function() {
				$('body').toggleClass('bt-menu-canvas-open');
			});
			$('.bt-menu-canvas-overlay').on('click', function() {
				$('body').toggleClass('bt-menu-canvas-open');
			});
		}
		BearsthemeOpenMenuSidebar();
		/* Open the hide menu */
		function BearsthemeOpenMenu() {
			var $navEl = $( '.bt-header-menu ul#nav' ),
				$btnHamburger = $( '#bt-hamburger' ), 
				$closeEl = $( '<a>', { href: '#', class: 'btn-close-menu-mobi', 'html': '<i class="ion-close-round"></i>' } );

			if( $navEl.length > 0 ) $navEl.append( $closeEl );

			$btnHamburger.on('click', function( e ) {
				e.preventDefault();
				$( 'body' ).toggleClass( 'menumobi_active' );
				$( '.bt-menu-list' ).toggleClass('hidden-xs hidden-sm is_menumobi_active');
			});

			$closeEl.on( 'click', function( e ) {
				e.preventDefault();
				$btnHamburger.trigger( 'click' );
			} )
		}
		BearsthemeOpenMenu();
		/* Header Stick */
		function BearsthemeHeaderStick() {
			if($( '.bt-header-v1, .bt-header-v3' ).hasClass( 'bt-header-stick' )) {
				var header_offset = $('#bt_header .bt-header-menu').offset();
			
				if ($(window).scrollTop() > header_offset.top) {
					$('body').addClass('bt-stick-active');
				} else {
					$('body').removeClass('bt-stick-active');
				}

				$(window).on('scroll', function() {
					if ($(window).scrollTop() > header_offset.top) {
						$('body').addClass('bt-stick-active');
					} else {
						$('body').removeClass('bt-stick-active');
					}
				});
				
				$(window).on('load', function() {
					if ($(window).scrollTop() > header_offset.top) {
						$('body').addClass('bt-stick-active');
					} else {
						$('body').removeClass('bt-stick-active');
					}
				});
				$(window).on('resize', function() {
					if ($(window).scrollTop() > header_offset.top) {
						$('body').addClass('bt-stick-active');
					} else {
						$('body').removeClass('bt-stick-active');
					}
				});
			}
		}
		BearsthemeHeaderStick();
		
		/* Header Fixed */
		function BearsthemeHeaderFixed() {
			if($( '.bt-header-v2' ).hasClass( 'bt-header-fixed' )) {
				var header_offset = $('#bt_header .bt-header-menu').offset();
			
				if ($(window).scrollTop() > header_offset.top) {
					$('body').addClass('bt-stick-active');
				} else {
					$('body').removeClass('bt-stick-active');
				}

				$(window).on('scroll', function() {
					if ($(window).scrollTop() > header_offset.top) {
						$('body').addClass('bt-stick-active');
					} else {
						$('body').removeClass('bt-stick-active');
					}
				});
				
				$(window).on('load', function() {
					if ($(window).scrollTop() > header_offset.top) {
						$('body').addClass('bt-stick-active');
					} else {
						$('body').removeClass('bt-stick-active');
					}
				});
				$(window).on('resize', function() {
					if ($(window).scrollTop() > header_offset.top) {
						$('body').addClass('bt-stick-active');
					} else {
						$('body').removeClass('bt-stick-active');
					}
				});
			}
		}
		BearsthemeHeaderFixed();
		/* Active donaters carousel */
		function BearsthemeDonatersCarousel() {
			var $owlElem = $('.bt-donaters-carousel .owl-carousel');
			$owlElem.each( function() {
				var $this = $( this ),
					opts = {
						loop:true,
						smartSpeed: 500,
						margin:30,
						navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
						dots:false,
						responsiveClass:true,
						responsive:{
							0:{
								items:1,
							},
							768:{
								items:2,
							},
							992:{
								items:3,
							},
							1200:{
								items:3,
								nav:true,
							}
						}
					};
					
				var owlObj = $this.owlCarousel( opts );
				
				$( window ).resize( function() {
					setTimeout( function() {
						owlObj.trigger('destroy.owl.carousel');
						owlObj.html(owlObj.find('.owl-stage-outer').html()).removeClass('owl-loaded');
						owlObj.owlCarousel(opts);
					}, 100 )
					
				} )
			} )
			/*$('.bt-donaters-carousel .owl-carousel').owlCarousel({
				loop:true,
				smartSpeed: 500,
				margin:30,
				navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				dots:false,
				responsiveClass:true,
				responsive:{
					0:{
						items:1,
					},
					768:{
						items:2,
					},
					992:{
						items:3,
					},
					1200:{
						items:3,
						nav:true,
					}
				}
			});*/
		}
		BearsthemeDonatersCarousel();
		
		/* Active Doantion slider */
		function BearsthemeDonationSlider() {
			$('.tbdonations_slider_wrap .owl-carousel').owlCarousel({
				items: 1,
				loop:true,
				smartSpeed: 500,
				margin:30,
				nav: true,
				navText:['<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>'],
				dots:false
			});
		}
		BearsthemeDonationSlider();
		
		/* Active Events carousel */
		function BearsthemeEventsCarousel() {
			$('.bt-events_slider .owl-carousel').owlCarousel({
				items: 1,
				loop:true,
				smartSpeed: 500,
				nav: true,
				navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
				dots:false
			});
		}
		BearsthemeEventsCarousel();
		
		/* Active Testimonial slider */
		function BearsthemeTestimonialSlider() {
			$('.bt-testimonial-slider  .owl-carousel').owlCarousel({
				items: 1,
				loop:true,
				smartSpeed: 500,
				margin:30,
				nav: false,
				navText:['<i class="icon-arrow-left"></i>', '<i class="icon-arrow-right"></i>'],
				dots:true
			});
		}
		BearsthemeTestimonialSlider();
		
		/* Blog Special */
		function BearsthemesBlogSpecial() {
			$('.bt-blog-special').each(function() {
				var $btPost = $(this).find('.bt-post .bt-post-items'),
					$btPostDetail = $(this).find('.bt-post-detail');
				
				$btPost.children('article').hover(function() {
					var _index = $(this).index();
					$(this).addClass('active').siblings().removeClass('active');
					
					$btPostDetail
					.children('article')
					.eq(_index)
					.addClass('active')
					.siblings()
					.removeClass('active');
				})
			})
		}
		BearsthemesBlogSpecial();
		
		/* Story Special */
		function BearsthemesStorySpecial() {
			$('.bt-story-special').each(function() {
				var $btPost = $(this).find('.bt-post'),
					$btPostDetail = $(this).find('.bt-story-items');
				
				$btPost.children('article').hover(function() {
					var _index = $(this).index();
					$(this).addClass('active').siblings().removeClass('active');
					
					$btPostDetail
					.children('article')
					.eq(_index)
					.addClass('active')
					.siblings()
					.removeClass('active');
				})
			})
		}
		BearsthemesStorySpecial();
		
		/* Events Special */
		function BearsthemesEventSpecial() {
			$('.bt-events-special').each(function() {
				var $btPost = $(this).find('.tribe_events');
				$('.bt-events-special .tribe_events').hover(function() {
					$(this).addClass('active').siblings().removeClass('active');
				})
			})
		}
		BearsthemesEventSpecial();
		
		/* Active blog carousel */
		function BearsthemeBlogCarousel() {
			$('.bt-blog-carousel .owl-carousel').owlCarousel({
				loop:true,
				smartSpeed: 500,
				margin:30,
				nav:false,
				dots:true,
				responsiveClass:true,
				responsive:{
					0:{
						items:1,
					},
					768:{
						items:1,
					},
					992:{
						items:2,
					},
					1200:{
						items:2,
					}
				}
			});
		}
		BearsthemeBlogCarousel();
		
		function BearsthemeCountDownClock() {
			$('.bt-countdown-clock').each(function() {
				var countdownTime = $(this).attr('data-countdown');
				$(this).countdown({
					until: countdownTime,
					format: 'ODHMS',
					padZeroes: true
				});
			});
		}
		BearsthemeCountDownClock();
		
		/*Count up*/
		function BearsthemeCountUp() {
			if($( ".bt-number" ).length > 0) {
				$('.bt-number').counterUp({
					delay: 10,
					time: 1000
				});
			}
		}
		BearsthemeCountUp();
		
		/* Disable scrolling zoom on maps */
		$('#map').addClass('scrolloff');
		$('.overlay_map').on("mouseup",function(){
			$('#map').addClass('scrolloff'); 
		});
		$('.overlay_map').on("mousedown",function(){
			$('#map').removeClass('scrolloff');
		});
		$("#map").mouseleave(function () { 
			$('#map').addClass('scrolloff');
		});
		/*Shop*/
		$('.woocommerce-info .ro-checkout-title > a').on('click', function(event) {
			$( event.target ).closest('.woocommerce-info').toggleClass('ro-active');
		});
		
		function eventToggleHandle() {
			var $el = $( '.tb-event-segment' );
			$el.each( function() {
				var $this = $( this ),
					$btnToggle = $( '<span class="btn-event-toggle"><i class="fa fa-minus"></i></span>' );
				
				$this.prepend( $btnToggle );
				$btnToggle.on( 'click', function() {
					$this.toggleClass( 'minus' );
					$( this ).find( 'i' ).toggleClass( 'fa-minus fa-plus' );
				} )
			} )
		}
		eventToggleHandle();
	});
})(jQuery);


/* main */
!( function( $ ) {
	'use strict';

	var main_api = function() {
		this.init();
	}

	main_api.prototype = {
		init: function() {
			// stickyMenu
			this.stickyMenu();

			// mobiMenuHandle
			this.mobiMenuHandle();

			// comboWidgets
			this.comboWidgets();

			// chritable donate - ajax loadform
			this.chariableDonateAjaxLoadform();

			// event manager booking - ajax loadform
			this.eventManagerBookingAjaxLoadform();

			// counter
			this.counterHandle();

			this.menuOffCanvasHandle();

			var self = this;
			$( window ).load( function() {

				// svgProgress
				self.svgProgressHandle();

				// apply masonry
				self.masonryHandle();
			} )
				
		},
		stickyMenu: function() {
			$( '[data-sticky-menu]' ).each( function() {
				var $this = $( this ),
					infoEl = { top: $this.offset().top, height: $this.innerHeight() },
					scrollTop = 0;

				$( window ).on( {
					'scroll.stickyMenu': function() {
						scrollTop = $( this ).scrollTop();
						if( scrollTop >= ( infoEl.top + infoEl.height ) ) {
							$this.addClass( 'sticky-menu' );
						} else {
							$this.removeClass( 'sticky-menu' );
						}
					}
				} )
			} )
		},
		mobiMenuHandle: function() {
			var self = this;

			$( '.btn-toggle-menu-mobi' ).each( function() {
				var $this = $( this ),
					$selectorElem = $( $this.attr( 'href' ) ),
					$btnClose = $( '<a>', {
						href 	: '#',
						class 	: 'btn-close-menu-mobi',
						html 	: '<i class="ion-close-round"></i>'
					} );

				$selectorElem.append( $btnClose );

				$this.on( 'click', function( e ) {
					e.preventDefault();
					$selectorElem.toggleClass( 'is-open' );
				} )

				$btnClose.on( 'click', function( e ) {
					e.preventDefault();
					$selectorElem.toggleClass( 'is-open' );
				} )
			} )
		},
		menuOffCanvasHandle: function() {
			var self = this;

			self.menuOffCanvasHandle.addButtonToggle = function( $elem ) {
				$elem.find( '.menu-item-has-children' ).each( function() {
					var $this = $( this ),
						$btnToggle = $( '<span>', { class: 'menu-item-button-toggle', html: '<i>+</i>' } );

					$this.append( $btnToggle );

					$btnToggle.on( 'click', function( e ) {
						e.stopPropagation();
						var $this = $( this );

						$this.toggleClass( 'is-open' );
						$this.parent().children( 'ul.sub-menu' ).toggle( 'slow' );
					} )
				} )
			}

			self.menuOffCanvasHandle.header_v8 = function() {
				var $menuWrap = $( '.btwg-container-menu-off-canvas.temp-header-header-v8 .widget_nav_menu .menu' );
				self.menuOffCanvasHandle.addButtonToggle( $menuWrap );
			}
			self.menuOffCanvasHandle.header_v8();		
		},
		comboWidgets: function() {
			var self = this;

			// widget_bt_combowigets
			$( '.widget_bt_combowigets' ).on( 'click', '.btwg-icon', function( e ) {
				e.preventDefault();

				var $this = $( this ),
					container_class = $this.data( 'container' );

				setTimeout( function() {
					$( container_class ).toggleClass( 'is-open' );
					$( 'html' ).toggleClass( container_class.replace( '.', '' ) + '-open' );

					if( ! $( container_class ).hasClass( 'is-open' ) ) {
						setTimeout( function() {
							$( window ).trigger( 'resize' );
						}, 600 )
					}
				}, 10 )
			} )

			$( '.btwg-container-menu-off-canvas' ).on( 'click', function( e ) {
				if( $( e.target ).hasClass( 'is-open' ) ) {
					$( '.btwg-menu-off-canvas .btwg-icon' ).click();
				}
			} )

			// btwg_cart
			this.btwg_cart = function() {

				var self = this;

				this.callback = function() {
					if( ! $( window ).data( 'btwg_cart.minicartUpdate' ) ) {
						$( window ).data( 'btwg_cart.minicartUpdate', function( obj ) {
							$( '.cart-data', '.btwg-cart .btwg-icon' ).html( obj.cart_count );
							$( '.btwg-container-cart', '.btwg-cart' ).html( obj.cart_template );
						} )
					}
				}
				this.callback();

				this.updateMinicart = function() {
		            // ask server for updated data
		            $.ajax( {
		            	type: 'POST',
		                url: main_object.ajax_url,
		                data: { action: 'bearsthemes_mode_minicart_update' },
		                success: function( data ) {
		                    
		                    try{
		                    	var cart_obj = JSON.parse( data );
		                    	$( window ).data( 'btwg_cart.minicartUpdate' ).call( this, cart_obj );
		                    }catch ( e ) {
		                    	console.log( 'result updateMinicart: ', e );
		                    }
		                },
		                error: function( e ) {
		                	console.log( 'updateMinicart: ', e );
		                }
		            } );
		        }
		        this.updateMinicart();

		        // auto update after 30s
		        setInterval( function() { self.updateMinicart() }, 1000 * 30 );


		        // ajaxComplete
		        $( document ).ajaxComplete( function( event, xhr, ajaxOpts ) {
		            // check for WP e-Commerce "empty_cart" action
		            if ( 'data' in ajaxOpts && ( ajaxOpts.data.indexOf( 'action=empty_cart' ) != -1 || ajaxOpts.data.indexOf( 'product_id' ) != -1 ) ) 
		            {
		                self.updateMinicart();
		            }
		        });

				$( document ).on( 'wpsc_fancy_notification', function( event ) {
		            self.updateMinicart();
		        });
			}
			this.btwg_cart(); // use btwg_cart()

			// remove product ajax
			this.removeProductAjax = function() {
				$( '.btwg-container-cart' ).on( 'click', '.remove', function( e ) {
					e.preventDefault();

					var $this = $( this ),
						$itemWrap = $this.parent( 'li.mini_cart_item' ),
						pid = $this.data( 'product_id' );

					// add class bt-ajax-handle
					$itemWrap.addClass( 'bt-ajax-handle' );

					$.ajax( {
						type: 'POST',
						url: main_object.ajax_url,
						data: { action: 'bearsthemes_remove_product_minicart', product_id: pid },
						success: function( data ) {
							self.updateMinicart();
						},
						error: function( e ) {
							console.log( 'remove product ajax: ', e );
						}
					} )
				} )
			}
			this.removeProductAjax();
		},
		chariableDonateAjaxLoadform: function() {
			var self = this;

			$( 'body' ).on( 'click.charitableAjaxLoadform', '.charitable-donate-ajax-loadform', function( e ) {
				e.preventDefault();

				var $this = $( this ),
					campaign_id = $this.data( 'campaign-id' ),
					campaign_title = $this.data( 'campaign-title' ),
					campaign_img = $this.data( 'campaign-img' ),
					$modal = self.bearsModal();

				$.ajax( {
					type: 'POST',
					url: main_object.ajax_url,
		            data: { action: 'get_donation_form', campaign_id: campaign_id },
					success: function( result ) {
						// console.log( result );
						try{
							if( result.success != true ) return;

							// show container 
							$modal
							.trigger( 'buildHeader', [campaign_img, campaign_title] )
							.trigger( 'updateContent', [result.data] )
							.trigger( 'showContainer' );

							// CHARITABLE.PaymentMethodSelection.init();
							var $form = $modal.find( '#charitable-donation-form' );
					        if ( $form.length ) new CHARITABLE.Donation_Form( $form );
						} catch( e ) { console.log( e ) }
					},
					error: function( e ) {
						console.log( e );
					}
				} )
			} )
		},
		eventManagerBookingAjaxLoadform: function() {
			var self = this;

			self.eventManagerBookingFormHandle = function( $form, callback ) {
				$form.on( 'submit', function( e ) {
					e.preventDefault();

					var $this = $( this ),
						formdata = $this.serialize();

					$this.find( '.em-booking-buttons' ).addClass( 'ajax-loading' );

					$.ajax({
						url: main_object.ajax_url,
						data: formdata,
						dataType: 'json',
						type:'POST',
						success : function( response ) {
							console.log(response);
							$this.parent().find( '.em-booking-message' ).remove();
							$this.find( '.em-booking-buttons' ).removeClass( 'ajax-loading' );
							
							if( response.result && response.result == true ){
								$this.before( '<div class="em-booking-message em-booking-success">'+ response.message + '</div>' );
								
								if(response.result && typeof response.paypal_url != 'undefined' ){
									var ppForm = $('<form action="'+response.paypal_url+'" method="post" id="em-paypal-redirect-form"></form>');
									$.each( response.paypal_vars, function(index,value){
										ppForm.append('<input type="hidden" name="'+index+'" value="'+value+'" />');
									});
									ppForm.append('<input id="em-paypal-submit" type="submit" style="display:none" />');
									ppForm.appendTo('body').trigger('submit');
								}
							}else{
								$this.before( '<div class="em-booking-message em-booking-error">'+ response.errors +'</div>' );
							}

							// callback
							if( callback ) callback.call( this, response )
						},
						error: function( e ) {
							console.log( e );
						}
					});
				} )
			}

			$( 'body' ).on( 'click.eventManagerAjaxLoadform', '.event-manager-ajax-loadform', function( e ) {
				e.preventDefault();

				var $this = $( this ),
					event_id = $this.data( 'event-id' ),
					event_title = $this.data( 'event-title' ),
					event_img = $this.data( 'event-img' ),
					redirect_to = $this.data( 'redirect-to' ),
					$modal = self.bearsModal();

				$.ajax( {
					type: 'POST',
					url: main_object.ajax_url,
					data: { action: 'bearstheme_eventManagerBook_form', event_id: event_id },
					dataType: 'json',
					success: function( result ) {
						// console.log( result );	
						try{
							$modal
							.trigger( 'buildHeader', [event_img, event_title] )
							.trigger( 'updateContent', [result.data] )
							.trigger( 'showContainer' );

							if( $modal.find( 'input[name="redirect_to"]' ).length > 0 )
								$modal.find( 'input[name="redirect_to"]' ).val( redirect_to )

							// booking form submit
							self.eventManagerBookingFormHandle( $modal.find( 'form[name="booking-form"]' ), function() {
								$modal.trigger( 'scrollTop' );
							} );

						} catch( e ) { console.log( e ) }
					},
					error: function( e ) {
						console.log( e )
					}
				} )
			} )
		},
		bearsModal: function( callback ) {
			var modal_temp = '';

			modal_temp = 	'<div class="bears-modal-wral">';
			modal_temp += 	'	<div class="bears-modal-container">';
			modal_temp += 	'		<div class="bears-modal-container-inner">';
			modal_temp += 	'			<a href="#!" class="close-modal"><i class="fa fa-times"></i></a>';
			modal_temp += 	'			<div class="modal-body"></div>';
			modal_temp += 	'		</div>';
			modal_temp += 	'	</div>';
			modal_temp += 	'</div>';

			// modal elem
			var $modal_elem =  $( modal_temp );

			// body is modal
			$( 'body' ).addClass( 'bears-modal-is-open' );

			// loading success
			$modal_elem.on( {
				'buildHeader': function( e, image, title ) {
					var header_temp = '';
					header_temp += '<div class="header-modal" style="background: url('+ image +') no-repeat center center / cover, #333">';
					header_temp += '	<h3 class="title">'+ title +'</h3>';
					header_temp += '</div>';

					$modal_elem.find( '.modal-body' ).before( header_temp );
				},
				'showContainer': function() { 
					$( this ).addClass( 'is-show' ); 
				},
				'closeModal': function() { 
					$( this ).addClass( 'is-close' );

					setTimeout( function() {
						$( 'body' ).removeClass( 'bears-modal-is-open' );
						$modal_elem.remove();
					}, 500 )
				},
				'updateContent': function( e, container ) {
					$( this ).find( '.modal-body' ).html( container );
				},
				'click': function( e ) {
					var $target = $( e.target );
					if(  $target.hasClass( 'bears-modal-wral' ) ) $( this ).trigger( 'closeModal' )

				},
				'scrollTop': function() {
					$( this ).animate( {
						scrollTop: 0
					}, 200 )
				}	
			} )

			$modal_elem.find( 'a.close-modal' ).on( 'click', function( e ) {
				e.preventDefault();
				$modal_elem.trigger( 'closeModal' );
			} )

			// append body
			$( 'body' ).append( $modal_elem )

			// callback
			if( callback ) callback.call( this, $modal_elem );

			// return Elem
			return $modal_elem;
		},
		masonryHandle: function() {
			$( '[data-bears-masonry-elem]' ).each( function() {
				var $this = $( this ),
					opts = $this.data( 'bears-masonry-elem' );

				$this.isotope({
				  	itemSelector: '.item',
				  	percentPosition: true,
				  	masonry: {
				    	columnWidth: '.grid-sizer',
				    	gutter: '.gutter-sizer'
				  	}
				});
			} )
		},
		svgProgressHandle: function() {
			$( '[data-svgcircle]' ).each( function() {
				var $this = $( this ),
					value = $this.data( 'svgcircle' ),
					site = $this.data( 'size' ),
					thickness = $this.data( 'thickness' );

				$this.circleProgress({
				    value: value / 100,
				    lineCap: 'round',
				    thickness: thickness,
				    size: site,
				    emptyFill: 'rgba(255, 255, 255, .2)',
				    // fill: { gradient: ['#ffffff', '#ffffff'] }
				}).on('circle-animation-progress', function(event, progress, stepValue) {

				    $(this).attr( 'data-text', ( stepValue.toFixed(2) * 100 ) + '%' );
				});
			} )
		},
		counterHandle: function() {
			$( '[data-bears-counter]' ).counterUp( {
				delay: 10,
				time: 1000
			} )
			// $( '[data-bears-couter]' ).each( function() {
			// 	var $this = $( this );

			// 	$this.counterUp( {
			// 		delay: 10,
			// 		time: 1000
			// 	} )
			// } )
		}
	}

	function effectFadeInFadeOutWhenRedirect() {
		// delegate all clicks on "a" tag (links)
		$(document).on("click", "a[data-smooth-link]", function () {

		    // get the href attribute
		    var newUrl = $(this).attr("href");

		    // veryfy if the new url exists or is a hash
		    if (!newUrl || newUrl[0] === "#") {
		        // set that hash
		        location.hash = newUrl;
		        return;
		    }

		    // now, fadeout the html (whole page)
		    $("html").fadeOut(function () {
		        // when the animation is complete, set the new location
		        location = newUrl;
		    });

		    // prevent the default browser behavior.
		    return false;
		});
	}

	/* DOM Ready */
	$( function() {

		// use main_api()
		new main_api();

		// use effectFadeInFadeOutWhenRedirect()
		effectFadeInFadeOutWhenRedirect();
	} )
} )( jQuery )