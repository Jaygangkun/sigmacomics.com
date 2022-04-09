$(document).ready(function () {
  $('.hdr-srch-area').hide()
});
$('.hdr-srch-icon').on('click', function () {
  $('.hdr-srch-area').show()
});
$(document).mouseup(function (e) {
 var popup = $(".hdr-srch-area");
 if (!$('.hdr-srch-area').is(e.target) && !popup.is(e.target) && popup.has(e.target).length == 0) {
     popup.hide();
 }
}); 


// Portfolio JS
$(document).ready( function() {   
	$('.grid').isotope({
	  itemSelector: '.grid-item',
	});
	// filter items on button click
	$('.filter-button-group').on( 'click', 'li', function() {
	  var filterValue = $(this).attr('data-filter');
	  $('.grid').isotope({ filter: filterValue });
	  $('.filter-button-group li').removeClass('active');
	  $(this).addClass('active');
	});
});


// Dropdown JS
$(document).ready(function(){
	$(".lang-dropdown .lang-dropdown-toggle").click(function(e){
		e.preventDefault();
	  $(".lang-drop-itm").toggle();
	});
});


// Menu Toggle JS
$(document).ready(function(){
  $(".logo-hdr-row .navbar-toggler").click(function(){
    $("body").toggleClass("body-fixed");
  });
});

$(document).ready(function () {
  $('.navbar-toggler').on('click', function () {
    $('.navbar-toggler').toggleClass('open');
    $('.menu-header').toggleClass('show-nav');
  });
});



// Owl Carousel Js
$(document).ready(function () {
	$('#sigma_character_scroll, #sigma_about_scroll').owlCarousel({
		loop:true,
		margin:10,
		nav:false,
		autoplay:true,
		smartSpeed:2000,
		autoplayTimeout:3000,
		autoplayHoverPause:true,
		responsive:{
			0:{
			items:1
			},
			480:{
			items:1
			},
			576:{
			items:2
			},
			768:{
			items:3
			},
			1024:{
			items:5
			}
		}
	});

});