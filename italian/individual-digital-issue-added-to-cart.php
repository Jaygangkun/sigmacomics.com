<?php
ob_start();
session_start();
$msg = array();

require_once("language_redirect.php");
require_once(dirname(dirname(__FILE__))."/inc/functions.php");
require_once(dirname(dirname(__FILE__))."/inc/connections.php");

if(!isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id']== ''){
	header( 'Location:'.constant('SITEURL_ITALIAN').'/order-issues-6');
}


$sql = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart` where `session_id`= '".$_SESSION['add_to_cart_session_id']."' and `language` = 'it_IT' ";
if ($result = $conn->query($sql)) {
	$row = $result->fetch_assoc();
	$total_quantity = (isset($row['total_quantity']))?$row['total_quantity']:'';
	$total_price = (isset($row['total_price']))?$row['total_price']:'';
}

/*$sqlNew = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'custom-field-spanish' and `post_status`= 'publish' ";*/

$sqlNew = "SELECT * FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id) WHERE wp_posts.post_type = 'custom-field' and wp_posts.post_status= 'publish' AND wp_term_taxonomy.term_id = 92 ORDER BY `ID` DESC ";

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

	<!-- Latest News Page Body Section Start -->
	<section class="inner-page-body-sec new-add-to-cart">
		<div class="container">
			<div class="new-add-cart-top-sec">
				<ul>
					<li class="selected-cart">
						<p><img src="images/right-tick.png" alt=""> <?php echo (isset($content[41]))?$content[41]:'';?></p>
					</li>
					<li class="total-cart-itm">
						<p><?php echo (isset($content[42]))?$content[42]:'';?> (<?php echo $total_quantity; ?> <?php echo (isset($content[46]))?$content[46]:'';?>): $<?php echo $total_price;?></p>
					</li>
					<li class="buy-more-btn"><a href="<?php echo constant("SITEURL_ITALIAN")."/digital-dashboard-6";?>"><?php echo (isset($content[43]))?$content[43]:'';?></a></li>
					<li class="buy-more-btn"><a href="<?php echo constant("SITEURL_ITALIAN")."/cart";?>"><?php echo (isset($content[44]))?$content[44]:'';?></a></li>
					<li class="proceed-checkout-btn"><a href="<?php echo constant("SITEURL_ITALIAN")."/checkout";?>"><?php echo (isset($content[45]))?$content[45]:'';?> (<?php echo $total_quantity; ?> <?php echo (isset($content[46]))?$content[46]:'';?>)</a></li>
				</ul>
			</div>

			<?php echo (isset($content[15]))?$content[15]:'';?>

	</section>

	<?php
	require_once(__ROOT__."/include/footer.php");
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