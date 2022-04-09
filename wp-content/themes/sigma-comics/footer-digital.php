<!-- Footer Section Start -->

<!-- JS Start here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<!-- Bootstrap JS -->
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<!-- Owl Carousel JS -->
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
<!-- Portfolio JS -->
<script src="<?php echo get_template_directory_uri(); ?>/js/isotope.pkgd.min.js"></script>
<!-- Custome js -->
<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
<?php wp_footer(); ?>
<script>
$(document).ready(function() {
	window.addEventListener("keyup", function(e) {
	if (e.keyCode == 44) {
		alert("The 'print screen' key is pressed");
	}
	});
}); 
	
</script>
</body>
</html>