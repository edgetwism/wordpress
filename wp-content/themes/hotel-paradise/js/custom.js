var wow = new WOW(
	{
		offset:       50,
		mobile:       false,
		live:         false
	}
);
if( hotel_paradise_settings.disable_animation != true ){
	wow.init();
}


jQuery(document).ready(function ($) {
	
	if( jQuery(".owl-carousel").length > 0 ){
		$('.owl-carousel').owlCarousel({
			loop:true,
			margin:10,
			nav:false,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:5
				}
			}
		});
	}
	
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.toTop').fadeIn();
		} else {
			$('.toTop').fadeOut();
		}
	});
	
	$('.toTop').click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	
	var window_width = $(window).width();
	if ( window_width >= 768 ) {
		$('.nav li.dropdown').hover(function() {
		   $(this).addClass('open');
	   	}, function() {
		   $(this).removeClass('open');
	   	});
	   	$('.nav li.dropdown').focus(function() {
		   $(this).addClass('open');
	   	}, function() {
		   $(this).removeClass('open');
	   	});
	} 

	$('.nav').find('.dropdown > a').append('<i class="fa fa-caret-down"></i>');

	// Fix for Bootstrap Navwalker
	$('.navbar .dropdown > a').click(function(){
		event.preventDefault();
		event.stopPropagation();
		$(this).find('.fa').toggleClass('fa-caret-up');
		$(this).parent('li').toggleClass('open');
	});
	   
	$(function() {
		$('#news_slider .item').each(function(){	
		  var next = $(this).next();
		  if (!next.length) {
			next = $(this).siblings(':first');
		  }
		  next.children(':first-child').clone().appendTo($(this));
		  
		  for (var i=0;i<2;i++) {
			next=next.next();
			if (!next.length) {
				next = $(this).siblings(':first');
			}
			
			next.children(':first-child').clone().appendTo($(this));
		  }
		});	
	});

	if( hotel_paradise_settings.hide_preloader != true ){
		// Fakes the loading setting a timeout
	    setTimeout(function() {
	        $('body').addClass('loaded');
	    }, hotel_paradise_settings.preloader_speed );
	}
	
});