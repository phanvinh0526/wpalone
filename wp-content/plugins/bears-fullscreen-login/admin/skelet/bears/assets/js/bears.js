jQuery(document).ready(function($) {
	
	var bears_ajax_url = "http://bearsthemes.com/wp-admin/admin-ajax.php";
	
	$.ajax({
	  url: bears_ajax_url,
	  data:{
		action: 'bears_api',
		type: 'codecanyon' // change this category to retrieve other products
	  }, 
	  method: "post",
	  dataType: 'jsonp',

	})
	.done(function( d ) {
		
		var products = [];

	  	jQuery.each(d['bears_products'],function(i,dd){
	  		
		  		var item_large = [
		  			'<div class="pa-item-wrapper"><div class="pa-item">',
		  			'<h3>',
		  			dd.item,
		  			//'<span class="marked-purchased">Purchased</span>',
		  			'</h3>',
		  			'<a href="'+dd.url+'" target="_blank">',
		  			'<img src="'+dd.live_preview_url+'"/>',
		  			'</a><br/>',
			  			'<p>',
			  			'<a href="'+dd.url+'" target="_blank" class="button pullright">Live Demo</a> ',
			  			'<a href="'+dd.url+'" target="_blank" class="button-primary pullright">Buy $'+dd.cost+'</a>',
			  			'</p>',
		  			'</div></div>'

		  		];
		  		products.push(item_large.join(""));
		  
	  	})


	    jQuery("#pa-products").append(products.join(""));
	     
	   
	});

	// Show products from themeforest
	$.ajax({
	  url: bears_ajax_url,
	  data:{
		action: 'bears_api',
		type: 'themeforest' // change this category to retrieve other products
	  }, 
	  method: "post",
	  dataType: 'jsonp',

	})
	.done(function( d ) {
		console.log(d);
		var products = [];
	
	  	jQuery.each(d['bears_products'],function(i,dd){
	  		
		  		var item_large = [
		  			'<div class="pa-item-wrapper"><div class="pa-item">',
		  			'<h3>',
		  			dd.item,
		  			//'<span class="marked-purchased">Purchased</span>',
		  			'</h3>',
		  			'<a  href="'+dd.url+'" target="_blank">',
		  			'<img src="'+dd.live_preview_url+'"/>',
		  			'</a><br/>',
			  			'<p>',
			  			'<a href="'+dd.url+'" target="_blank" class="button pullright">Live Demo</a> ',
			  			'<a href="'+dd.url+'" target="_blank" class="button-primary pullright">Buy $'+dd.cost+'</a>',
			  			'</p>',
		  			'</div></div>'

		  		];
		  		products.push(item_large.join(""));
		  
	  	})

	  	
	    jQuery("#pa-products").append(products.join(""));
	     
	   
	})
});

// Faqs
jQuery(document).ready(function($) {
	$('.pa-question').each(function() {
		var tis = $(this), state = false, answer = tis.next('.pa-answer').slideUp();
		tis.click(function() {
			state = !state;
			answer.slideToggle(state);
			tis.toggleClass('active',state);
		});
	});
});

