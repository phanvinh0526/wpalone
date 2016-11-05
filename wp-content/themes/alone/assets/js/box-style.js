(function($) {
	"use strict";
	function tb_box_style(){
		var $linkStyle = $( 'link#bears_preset-css' );
		$('.panel-primary-color').on('click', 'li', function(){
			$(this).addClass('active').siblings('.active').removeClass('active');
			var link_preset = $( this ).data( 'link' );
			$linkStyle.attr( 'href', link_preset );
			//console.log(link_preset);
		});

		$('.panel-selector-btn').on('click', function(e){
			e.preventDefault();
			$('body').removeClass('wide boxed').addClass( $(this).data('value') );
			$(this).addClass('active').siblings('.active').removeClass('active');
			
			setTimeout( function() {
				$( window ).trigger( 'resize' );
			}, 100 );
		});

		$('.panel-primary-background').on('click','li', function(){
			var link_bg = $( this ).data( 'link' );
			$('body').addClass('bg-pattern-body').css('background-image', 'url('+ link_bg +')' );
			$(this).addClass('active').siblings('.active').removeClass('active');
		});

		$('#panel-selector-reset').on('click', function(e){
			e.preventDefault();
			$( this ).parents( '#panel-style-selector' ).find( '.default' ).trigger( 'click' );
			$( this ).parents( '#panel-style-selector' ).find( '[data-value="wide"]' ).trigger( 'click' );
		});

		$('.panel-selector-open').on('click', function(){
			$(this).parent().toggleClass('in');
		})
		
	}
	$(document).ready( function(){
		tb_box_style();
	})
	
})(window.jQuery)