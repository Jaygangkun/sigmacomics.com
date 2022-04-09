<?php
get_header();
require_once("wp-url.php");

if( isset($_SESSION['user'])){   
	header( 'Location:'. constant("SITEURL").'/digital-dashboard');
	exit();
}

?>

<?php 
    
    $postid = get_the_ID(); 
    $post = get_post( $postid, ARRAY_A );

    echo do_shortcode($post['post_content']);
    
?>  
	<!-- Contact Us Page Body Section End -->

<?php get_footer(); ?>