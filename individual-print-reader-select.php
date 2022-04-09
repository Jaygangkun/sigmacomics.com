<?php
ob_start();
session_start();
$msg = array();

// Get our helper functions
require_once("inc/functions.php");
require_once("inc/connections.php");

// Set variables for our request
$shop = "sigma-comics";
$token = "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";
$query = array(
	"Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);

// Individual Digital Issue Select => 227514581157
// Digital Subscription => 228873535653
// Shop => 225130545317
// Individual Print Reader Issue => 229836423333

// customers data
//$data = array("collection_id" => '227514581157');

$data = array();

// Run API call to submit customers
//$products = shopify_call($token, $shop, "/admin/api/2020-10/collects.json", $data, 'GET');
$products = shopify_call($token, $shop, "/admin/api/2020-10/collections/233056305317/products.json", $data, 'GET');

//$data = array();
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/custom_collections.json", $data, 'GET');

// Convert customers JSON information into an array
$products = json_decode($products['response'], TRUE);


//echo '<pre>';print_r($products);

?>

<!DOCTYPE html>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<title>Sigma Comics</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo constant("SITEURL")?>/images/favicon.png">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Bootstrap -->
	<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Owl Carousel -->
	<link type="text/css" href="css/owl.carousel.min.css" rel="stylesheet">
	<!-- Custom Css -->
	<link type="text/css" href="css/style.css" rel="stylesheet">
	<link type="text/css" href="css/responsive.css" rel="stylesheet">
	<!-- Font Link -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">
</head>

<body>
	<!-- Header Section Start -->
	<?php
	require_once("include/header.php");
	?>
	<!-- Header Section End -->

	
		<!-- Latest News Page Body Section Start -->
		<section class="inner-page-body-sec news-page-body">
		<div class="container">
			<div class="indi_list">
				<h3>GET INDIVIDUAL PRINT READER ISSUES!</h3>
				<h4>Select one below:</h4>

				<ul class="issueList">
				<?php if(!empty($products['products'])){
						foreach($products['products'] as $key=>$data){
				?>

				<?php if( $data['tags'] == "Unavailable" ){ ?>
					<li>
							<div class="imgwrap">
								<a href="javascript:void(0);"><img src="<?php echo constant("SITEURL")."/images/list-img.png";?>" alt="listimg"></a>
							</div>
							<div class="txtprt">
							<a href="javascript:void(0);"><?php echo $data['title'];?></a>
							</div>

						</li>

				<?php }else{ ?>

					<li>
						<div class="imgwrap">
							<a href="<?php echo constant("SITEURL")."/individual-print-reader-add-to-cart.php?product=".$data['id'];?>"><img src="<?php echo $data['images'][0]['src'];?>" alt="listimg"></a>
						</div>
						<div class="txtprt">
						<a href="<?php echo constant("SITEURL")."/individual-print-reader-add-to-cart.php?product=".$data['id'];?>"><?php echo $data['title'];?></a>
						</div>

					</li>

				<?php } ?>

				<?php
						}
					}else{
							header('Location: '.$_SERVER['REQUEST_URI']);
				}
				?>
					
				</ul>
			</div>



		</div>
	</section>
	<!-- Latest News Page Body Section End -->

	<?php
	require_once("include/footer.php");
	?>

	<!-- JS Start here -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo constant("SITEURL")?>/js/jquery.min.js"><\/script>')</script>
	<!-- Bootstrap JS -->
	<script src="<?php echo constant("SITEURL")?>/js/bootstrap.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="<?php echo constant("SITEURL")?>/js/owl.carousel.min.js"></script>
	<!-- Portfolio JS -->
	<script src="<?php echo constant("SITEURL")?>/js/isotope.pkgd.min.js"></script>
	<script src="<?php echo constant("SITEURL")?>/js/jquery.validate.js"></script>
	<!-- Custome js -->
	<script src="<?php echo constant("SITEURL")?>/js/custom.js"></script>
</body>

</html>