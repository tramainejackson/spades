$(document).ready(function() {
	// Animate home page header
	$('.welcomeHeader h1').animate({marginTop:'0%'}, 2000);
	
	$('body').on('click', '.menuMobile', function() {
		if(!$('#app-navbar-collapse').hasClass('show')) {
			$('html body').scrollTop(0);
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