$(document).ready(function() {
	// Animate home page header
	$('.welcomeHeader h1').animate({marginTop:'0%'}, 2000);
	
	$('body').on('click', '.menuMobile', function() {
		if(!$('#app-navbar-collapse').hasClass('show')) {
			$('html body').scrollTop(0);
		}
	});
	
	
});