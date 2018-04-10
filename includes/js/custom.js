

jQuery(document).ready(function(){

	jQuery('.button-menu, .widget_tj_twitter').fadeIn('1000');

/*-----------------------------------------------------------------------------------*/
/*	jQuery Superfish Menu
/*-----------------------------------------------------------------------------------*/

	function init_nav(){
		jQuery('ul.nav').superfish({
			delay:       10,                             // one second delay on mouse out 
			animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
			speed:       'fast'                           // faster animation speed 
		});
	}
	init_nav();

	/*---Center Nav Sub Menus---*/

	jQuery('.nav li ul').each(function(){
	
		li_width = jQuery(this).parent('li').width();
		li_width = li_width / 2;
		li_width = 100 - li_width - 10;
		
		jQuery(this).css('margin-left', - li_width);
	
	});
	

/*-----------------------------------------------------------------------------------*/
/*	Responsive Layout
/*-----------------------------------------------------------------------------------*/
	var isSelect = false;


	function response_layout(){
		var newWindowWidth = jQuery(window).width();
		if(newWindowWidth < 480){
			jQuery('#secondary-nav').hide();
			jQuery('select.select-nav').hide();
			if(!isSelect){
				response_nav();
			}else{
				jQuery('#secondary-nav').hide();
				jQuery('select.select-nav').show();
			}
		}else if(newWindowWidth < 960){
			jQuery('select.select-nav').hide();
			jQuery('#secondary-nav').show();
		}else{
			jQuery('select.select-nav').hide();
			jQuery('#secondary-nav').show();
		}
	}
	jQuery(window).bind("resize", response_layout);
	response_layout();

	function response_nav(){
		if(!isSelect){
			jQuery('span.sf-sub-indicator').remove();

			var mainNavigate = jQuery('#secondary-nav').clone();

			var selectNav = jQuery('<select style="width: 100%; padding: 5px 7px 5px 10px;" class="select-nav"></select>');

			jQuery(selectNav).append('<option value="" href="">Select a category...</option>');

			jQuery(mainNavigate).children('ul').children('li').each(function(){

				var href = jQuery(this).children('a').attr('href');
				var text = jQuery(this).children('a').text();

				jQuery(selectNav).append('<option value="'+href+'">'+text+'</option>');


				if(jQuery(this).children('ul').length>0){
					jQuery(this).children('ul').children('li').each(function(){

						var href2 = jQuery(this).children('a').attr('href');
						var text2 = jQuery(this).children('a').text();

						jQuery(selectNav).append('<option value="'+href2+'">--'+text2+'</option>');
						

					});
				}

			});

			jQuery('#secondary-nav').show();
			jQuery(selectNav).insertAfter(jQuery('#header'));
			isSelect = true;

			jQuery(selectNav).change(function(){
				window.location.href = this.options[this.selectedIndex].value;
			});
			

		}
	}
	
/*-----------------------------------------------------------------------------------*/
/*	Back To Top
/*-----------------------------------------------------------------------------------*/

	var topLink = jQuery('#back-to-top');

	function tj_backToTop(topLink) {
		
		if(jQuery(window).scrollTop() > 0) {
			topLink.fadeIn(200);
		} else {
			topLink.fadeOut(200);
		}
	}
	
	jQuery(window).scroll( function() {
		tj_backToTop(topLink);
	});
	
	topLink.find('a').click( function() {
		jQuery('html, body').stop().animate({scrollTop:0}, 500);
		return false;
	});
	
/*-----------------------------------------------------------------------------------*/
/*	Toggle Primary Navigation Menu on Mobile
/*-----------------------------------------------------------------------------------*/

	jQuery('#toggle').click(function() {
		$('#primary-nav .nav').slideToggle(400);
		$(this).toggleClass("active");
		
		return false;
		
	});
	
	function mobilemenu() {
		
		var windowWidth = jQuery(window).width();
	
		if( typeof window.orientation === 'undefined' ) {
			jQuery('#primary-nav .nav').removeAttr('style');
		}
	
		if( windowWidth < 1000 ) {
			jQuery('#primary-nav .nav').addClass('mobile-menu');
		}
		
	}
	
	mobilemenu();
	
	jQuery(window).resize(function() {
		mobilemenu();
	});

});