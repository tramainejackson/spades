$(document).ready(function() {
	// Animate home page header
	$('.welcomeHeader h1:first-of-type').animate({top:'0%'}, 2000);
	$('.welcomeHeader h1:nth-of-type(2)').animate({top:'5%'}, 2000);
	$('.welcomeHeader h1:nth-of-type(3)').animate({top:'10%'}, 2000);
	$('.welcomeHeader h1:last-of-type').animate({top:'15%'}, 2000);
	
	// Make the nav placeholder the same size as the nav for 
	// fixed nav animation
	$('.navPlaceHolder').css({'height': $('nav').outerHeight()});
	
	$('body').on('click', '.menuMobile', function() {
		if(!$('#app-navbar-collapse').hasClass('show')) {
			$('html body').scrollTop(0);
		}
	});
	
	// Stick the navigation to the top when scrolled more than 20 pixels
	$(window).on('scroll', function(e) {
		// console.log($('nav').outerHeight());
		if(window.pageYOffset > $('nav').outerHeight()) {
			$('nav').addClass('fixed-top stickyBgrd');
			$('.navPlaceHolder').css({'display':'inherit'});
		} else {
			$('nav').removeClass('fixed-top stickyBgrd');
			$('.navPlaceHolder').css({'display':'none'});
		}
	});
	
	// Button toggle for PIF switch
	$('body').on("click", "button", function(e) {
		if(!$(this).hasClass('btn-primary') || !$(this).hasClass('btn-danger')) {
			if($(this).children().val() == "Y") {
				$(this).addClass('active btn-success').children().attr("checked", true);
				$(this).siblings().removeClass('active btn-danger').children().removeAttr("checked");
			} else if($(this).children().val() == 'N') {
				$(this).addClass('active btn-danger').children().attr("checked", true);
				$(this).siblings().removeClass('active btn-success').children().removeAttr("checked");
			}
		}	
	});
});