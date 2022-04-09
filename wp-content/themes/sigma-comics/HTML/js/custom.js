// (function($){
// 	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
// 	  if (!$(this).next().hasClass('show')) {
// 		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
// 	  }
// 	  var $subMenu = $(this).next(".dropdown-menu");
// 	  $subMenu.toggleClass('show');

// 	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
// 		$('.dropdown-submenu .show').removeClass("show");
// 	  });

// 	  return false;
// 	});
// })(jQuery)


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


// $(document).ready(function(){
//   $(".top_main_hdr .navbar-toggler").click(function(){
//     $(".mnu_clmn").toggleClass("show_menu");
//   });
// });





// $(document).ready(function () {
//   $('.navbar-toggler').on('click', function () {
//     $('.navbar-toggler').toggleClass('open');
//   });
// });



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
			items:2
			},
			576:{
			items:3
			},
			767:{
			items:4
			},
			1024:{
			items:5
			}
		}
	});

});