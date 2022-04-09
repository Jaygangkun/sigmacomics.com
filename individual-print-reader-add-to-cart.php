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

// customers data
//$data = array("collection_id" => '227514581157');

$data = array();

// Run API call to submit customers
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/collects.json", $data, 'GET');
$products = shopify_call($token, $shop, "/admin/api/2020-10/products/".$_GET['product'].".json", $data, 'GET');

//$data = array();
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/custom_collections.json", $data, 'GET');

// Convert customers JSON information into an array
$products = json_decode($products['response'], TRUE);
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

	<?php if(isset($products['errors']) && $products['errors']){ ?>
		<section class="inner-page-body-sec news-page-body">
			<div class="container">
				<div class="indi_list">
					<h3>NO PRODUCTS FOUND</h3>
				</div>
				<div class="indidetailBody">
				</div>
			</div>
		</div>
	<?php }else{ ?>
	<!-- Latest News Page Body Section Start -->
	<?php if(!empty($products['product'])){ ?>
	<section class="inner-page-body-sec news-page-body">
			<div class="container">
				<div class="indi_list">
				<h3>GET INDIVIDUAL PRINT READER ISSUES!</h3>
				<h4>ONLY $<?php echo ( isset($products['product']['variants'][0]['price']) )?$products['product']['variants'][0]['price']:''; ?> EACH! ***FREE SHIPPING!***</h4>
				
				</div>
				<div class="indidetailBody">
					<div class="leftImgsection">
						<div class="innerImgprt">
						<?php if(isset($products['product']['images'][0]['src']) && $products['product']['images'][0]['src'] != '' ){ ?>
							<img src="<?php echo $products['product']['images'][0]['src'];?>" alt="img">
						<?php }else{ ?>
							<img src="<?php echo constant("SITEURL")?>/images/list-img.png" alt="img">
						<?php } ?>
						</div>
					</div>
					<div class="rightContentTxt">
					<h3><?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?></h3>
						<div class="priceprt">
							<span>List price: <del>$<?php echo ( isset($products['product']['variants'][0]['compare_at_price']) )?$products['product']['variants'][0]['compare_at_price']:''; ?></del></span>
							<span>price: <b>$<?php echo ( isset($products['product']['variants'][0]['price']) )?$products['product']['variants'][0]['price']:''; ?> !</b></span>
							<?php if( isset($products['product']['variants'][0]['compare_at_price']) && isset($products['product']['variants'][0]['price']) && ( intval($products['product']['variants'][0]['compare_at_price']) > intval($products['product']['variants'][0]['price']) ) ){ ?>
								<span>You save: <font>$<?php echo $products['product']['variants'][0]['compare_at_price'] - $products['product']['variants'][0]['price'] ?></font></span>
							<?php }else{ ?> 
								<span>You save: <font>$0</font></span>
							<?php } ?>
							
						</div>
						<?php echo ( isset($products['product']['body_html']) )?$products['product']['body_html']:''; ?>

						<button class="cartbutton" onclick="addToCartIndividual(<?php echo $_GET['product'];?>,<?php echo $products['product']['variants'][0]['price'];?>,'IPR');">ADD TO CART!</button>

					</div>
				</div>


			</div>
	</section>
	<!-- Latest News Page Body Section End -->
	<?php }else{
			header('Location: '.$_SERVER['REQUEST_URI']);
		}
	} ?>
	

	<?php
	require_once("include/footer.php");
	?>
	<script>
		var SITEURL = '<?php echo constant("SITEURL")?>';
	</script>
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