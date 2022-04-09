<?php
ob_start();
session_start();
$msg = array();


if(!isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id']== ''){
	header( 'Location: order-issues/');
}


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

// product data
$data = array("collection_id" => '233056239781');

//$data = array();

// Run API call to submit collection
$collection = shopify_call($token, $shop, "/admin/api/2020-10/collects.json", $data, 'GET');
$collection = json_decode($collection['response'], TRUE);
$productId = $collection['collects'][0]['product_id'];

// Run API call to submit customers
$products = shopify_call($token, $shop, "/admin/api/2020-10/products/".$productId.".json", $data, 'GET');

// Convert customers JSON information into an array
$products = json_decode($products['response'], TRUE);


$sql = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart` where `session_id`= '".$_SESSION['add_to_cart_session_id']."'  and `language` = 'en_US' ";
if ($result = $conn->query($sql)) {
	$row = $result->fetch_assoc();
	$total_quantity = (isset($row['total_quantity']))?$row['total_quantity']:'';
	$total_price = (isset($row['total_price']))?$row['total_price']:'';
}

/*$sqlNew = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'custom-field' and `post_status`= 'publish' ";*/

$sqlNew = "SELECT * FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id) WHERE wp_posts.post_type = 'custom-field' and wp_posts.post_status= 'publish' AND wp_term_taxonomy.term_id = 1 ORDER BY `ID` DESC ";

	if ($resultNew = $conn->query($sqlNew)) {
		$i = 0; 
		while($rowNew = $resultNew->fetch_assoc()){
			$content[$i] = $rowNew['post_content'];
			$i++;
		}
	}
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
	<section class="inner-page-body-sec new-add-to-cart">
		<div class="container">
			<div class="new-add-cart-top-sec">
				<ul>
					<li class="selected-cart">
					<p><img src="images/right-tick.png" alt=""> <?php echo utf8_encode((isset($content[41]))?$content[41]:'');?></p>
					</li>
					<li class="total-cart-itm">
						<p><?php echo utf8_encode((isset($content[42]))?$content[42]:'');?> (<?php echo $total_quantity; ?> <?php echo utf8_encode((isset($content[46]))?$content[46]:'');?>): $<?php echo $total_price;?></p>
					</li>
					<li class="buy-more-btn"><a href="<?php echo constant("SITEURL")."/digital-dashboard";?>"><?php echo utf8_encode((isset($content[43]))?$content[43]:'');?></a></li>
					<li class="buy-more-btn"><a href="<?php echo constant("SITEURL")."/cart";?>"><?php echo utf8_encode((isset($content[44]))?$content[44]:'');?></a></li>
					<li class="proceed-checkout-btn"><a href="<?php echo constant("SITEURL")."/checkout";?>"><?php echo utf8_encode((isset($content[45]))?$content[45]:'');?>  (<?php echo $total_quantity; ?> <?php echo utf8_encode((isset($content[46]))?$content[46]:'');?>)</a></li>
				</ul>
			</div>

			<?php echo (isset($content[15]))?$content[15]:'';?>
	<?php
	} 
	?>
	</section>

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

	<script>
		/*$(document).ready(function(){
				$.ajax({ 
					url: SITEURL+"/manage/individual-digital-issue-added-to-cart-page-loaded.php",
					type: 'POST',
						success: function(response){
							if(response.trim() >  '0'){
								$('#loaderDiv').hide();
								$("#showProduct").show();
							}
				}});
		});*/
	</script>

</body>

</html>