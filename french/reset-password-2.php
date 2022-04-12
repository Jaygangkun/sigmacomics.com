<?php
ob_start();
session_start();
$msg = array();

if(isset($_SESSION['user']) && $_SESSION['user']['id']!= ''){
	header( 'Location:'.constant('SITEURL_FRENCH').'/digital-dashboard-3');
}

// Get our helper functions
require_once("language_redirect.php");
require_once(dirname(dirname(__FILE__))."/inc/functions.php");
require_once(dirname(dirname(__FILE__))."/inc/connections.php");

// Set variables for our request
$shop = "sigma-comics";
$token = "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";
$query = array(
	"Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);

?>

<!DOCTYPE html>

<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<title>Sigma Comics</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- Bootstrap -->
	<link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- Owl Carousel -->
	<link type="text/css" href="../css/owl.carousel.min.css" rel="stylesheet">
	<!-- Custom Css -->
	<link type="text/css" href="../css/style.css" rel="stylesheet">
	<link type="text/css" href="../css/responsive.css" rel="stylesheet">
	<!-- Font Link -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
	<!-- Header Section Start -->
	<?php
	require_once(__ROOT__."/include/header.php");
	?>
	<!-- Header Section End -->

	
	<!-- Contact Us Page Body Section Start -->
	<?php 
	echo (isset($content[51]))?$content[51]:'';?>
	<!-- Contact Us Page Body Section End -->

	<?php
	require_once(__ROOT__."/include/footer.php");
	?>

	<!-- JS Start here -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Portfolio JS -->
	<script src="js/isotope.pkgd.min.js"></script>
	<script src="js/jquery.validate.js"></script>
	<!-- Custome js -->
	<script src="js/custom.js"></script>
</body>

</html>