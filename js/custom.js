jQuery( document ).ready( function( $ ) {

	/*======================================
	=            MENU SETUP                =
	======================================*/

	var nav = responsiveNav( "#menu-primary-items", {
		animate: true,
		transition: 300,
		insert: "before",
		customToggle: "#toggle-primary-menu",
		closeOnNavClick: false,
		openPos: "relative",
		navClass: "nav-collapse",
		navActiveClass: "js-nav-active",
		jsClass: "js"
	});

    $('#menu-primary > .wrap > ul > li').hover(function(){
		var ww   = $(window).width();
		var pos  = $(this).offset().left;
		var diff = ww - pos;
        $(this).find('ul').width(diff);
    });

    $('#menu-primary ul:not(.sub-menu) > li').each(function(){
        $('.sub-menu', this).each(function(i){
            if ( i % 2 !== 0 )
                $(this).addClass('black');
            else
                $(this).addClass('regular');
        });
    });

	if ( $('#toggle-social-menu').length ) {
		$('#toggle-social-menu').click(function(e){
			e.preventDefault();
			$('.header-social')
			.append('<a id="social-close" href="#"></a>')
			.slideToggle(function(){
				$('#social-close').on('click', function(){
					$(this).parent().slideUp(function(){
						$('#social-close', this).remove();
					});
				});
			});
		});

		$(window).on('resize', function(){
			var width = $(window).width();
			if ( width > 989 )
				$('.header-social').removeAttr('style');
		});
	}

	/*===============================
	=            FITVIDS            =
	===============================*/

	$('#content').fitVids({ customSelector: "iframe[src*='wordpress.tv'], iframe[src*='www.dailymotion.com'], iframe[src*='blip.tv'], iframe[src*='www.viddler.com']"});


	/*===================================
	=            BACK TO TOP            =
	===================================*/

	if ( $('#back-to-top').length ) {
		$('#back-to-top').click(function(e){
			e.preventDefault();
	        $('html, body').animate({
	            scrollTop: 0
	        }, 600);
		});
	}

	/*==================================
	=            NEWSLETTER            =
	==================================*/

	var newsletter_input = $( '#sidebar-subsidiary .newsletter-button' );
	if ( newsletter_input.length ) {
		var niw = newsletter_input.innerWidth();
		newsletter_input.prev().css( 'paddingRight', niw + 10 );
	}

	/*==============================
	=            SLIDER            =
	==============================*/

	if ( $('.slider').length ) {
		$('.slider').bxSlider({
			mode: slider.mode,
			auto: slider.auto,
			pause: slider.pause,
			autoHover: true,
			adaptiveHeight: false,
			pager: false,
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>',
		});
	}

	/*======================================
	=            JQUERY COUNTTO            =
	======================================*/

	if ( $('#countTo').length ) {
		$('#countTo').one('inview', function(){
			$('#countTo span').countTo({
				speed: 1500,
				refreshInterval: 50,
			});
		});
	}

	/*=================================
	=            PORTFOLIO            =
	=================================*/

	if ( $('.portfolio-slider').length ) {
		$('.portfolio-slider').bxSlider({
			pause: portfolio.pause,
			auto: portfolio.auto,
		    slideWidth: 262,
		    minSlides: 1,
		    maxSlides: 4,
		    slideMargin: 30,
			prevText: '<i class="fa fa-angle-left"></i>',
			nextText: '<i class="fa fa-angle-right"></i>',
			pager: false
		});
	}

	/*===================================
	=            GOOGLE MAPS            =
	===================================*/

	if ( typeof google !== "undefined" ) {
		google.maps.event.addDomListener(window, 'load', init);
	}

	function init() {
	    var mapOptions = {
	        zoom: Number( gmap.zoom ),
            scrollwheel: false,
	        center: new google.maps.LatLng(gmap.latitude, gmap.longitude), // New York
            styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
	    };

	    var mapElement = document.getElementById('map');

	    var map = new google.maps.Map(mapElement, mapOptions);

	    var marker = new google.maps.Marker({
	        position: map.getCenter(),
	        map: map,
	        title: gmap.title,
	        icon: gmap.icon,
	    });

	}

});