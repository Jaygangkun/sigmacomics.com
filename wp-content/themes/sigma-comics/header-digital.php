<?php 
ob_start();
session_start();
//print_r($_SESSION);
require_once("wp-url.php");

if(!isset($_SESSION['user']) && $_SESSION['user']== ''){
	header( 'Location:'. constant("SITEURL").'/login');
	exit();
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
<!-- Bootstrap -->
<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
<!-- Owl Carousel -->
<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.min.css" rel="stylesheet">
<!-- Responsive CSS -->
<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" rel="stylesheet">
<!-- Font Link -->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">

<?php wp_head(); ?>
</head>
<body>
<!-- Header Section Start -->

<!-- Header Section End -->