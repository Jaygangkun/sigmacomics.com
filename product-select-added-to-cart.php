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

if(!isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id']== ''){
	header( 'Location:'. constant("SITEURL").'/shop');
	exit();
}

$sql = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart` where `session_id`= '".$_SESSION['add_to_cart_session_id']."' ";
if ($result = $conn->query($sql)) {
	$row = $result->fetch_assoc();
	$total_quantity = (isset($row['total_quantity']))?$row['total_quantity']:'';
	$total_price = (isset($row['total_price']))?$row['total_price']:'';
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
	<?php }else{ 
		
	//echo '<pre>';print_r($products);	
	?>
	<!-- Latest News Page Body Section Start -->
	<section class="inner-page-body-sec news-page-body">
			<div class="container">

			<div class="new-add-cart-top-sec">
				<ul>
					<li class="selected-cart">
						<p><img src="images/right-tick.png" alt=""> Add to cart!</p>
					</li>
					<li class="total-cart-itm">
						<p>cart subtotal (<?php echo $total_quantity; ?> item): $<?php echo $total_price;?></p>
					</li>
					<li class="buy-more-btn"><a href="<?php echo constant("SITEURL")."/shop";?>">Buy More</a></li>
					<li class="buy-more-btn"><a href="<?php echo constant("SITEURL")."/cart";?>">Cart</a></li>
					<li class="proceed-checkout-btn"><a href="<?php echo constant("SITEURL")."/checkout";?>">Proceed to checkout (<?php echo $total_quantity; ?> item)</a></li>
				</ul>
			</div>

				<!--<div class="indi_list">
					<div id="loaderDiv">
						<img id="loading-image" src="<?php echo constant("SITEURL");?>/images/ajax-loader.gif"/>
					</div>
				</div>-->

				<?php 
				if(!empty($products['product'])){
				?>

				<!--<div id="showProduct" style="display:none">-->

				<div class="indidetailBody">
					<div class="leftImgsection">
					<div class="innerImgprt cartsection">
					<?php if(isset($products['product']['images'][0]['src']) && $products['product']['images'][0]['src'] != '' ){ ?>
						<img src="<?php echo $products['product']['images'][0]['src'];?>" alt="img">
					<?php }else{ ?>
						<img src="<?php echo constant("SITEURL")?>/images/list-img.png" alt="img">
					<?php } ?>
					</div>
					</div>
					<div class="rightContentTxt">
					<h3><?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?></h3>
						
							<?php if(isset($_GET['variant']) && $_GET['variant'] != ''){ 
								$variants_product = shopify_call($token, $shop, "/admin/api/2020-10/variants/".$_GET['variant'].".json", $data, 'GET');

								$variants_product = json_decode($variants_product['response'], TRUE);

							?>
							<div class="priceprt">
							<?php if(!empty($variants_product['variant'])){ ?>
								<div id="priceByVariant" >
									<span>List price: <del>$<?php echo ( isset($variants_product['variant']['compare_at_price']) )?$variants_product['variant']['compare_at_price']:''; ?></del></span>
									<span>price: <b>$<?php echo ( isset($variants_product['variant']['price']) )?$variants_product['variant']['price']:''; ?> !</b></span>
									<?php if( isset($variants_product['variant']['compare_at_price']) && isset($variants_product['variant']['price']) && ( intval($variants_product['variant']['compare_at_price']) > intval($variants_product['variant']['price']) ) ){ ?>
									<span>You save: <font>$<?php echo $variants_product['variant']['compare_at_price'] - $variants_product['variant']['price'] ?></font></span>
									<?php }else{ ?> 
										<span>You save: <font>$0</font></span>
									<?php } ?>
								</div>
							
								<?php 
									if(count($products['product']['variants']) > 1){
								?>

								<span>Size : <select name="size" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
											<?php 
											
											foreach($products['product']['variants'] as $var){ ?> 
												<option value="<?php echo constant("SITEURL").'/product-select-add-to-cart.php?product='.$products['product']['id'].'&variant='.$var['id']?>" <?php echo ( $var['title'] == $variants_product['variant']['title'] )?'selected=true':''; ?> ><?php echo $var['title']?></option>
											<?php } ?>
										 </select>
								</span>

							<?php } ?>
							
						<?php echo ( isset($products['product']['body_html']) )?$products['product']['body_html']:''; ?>

						<button class="cartbutton cartBtn" onclick="addToCartProductIndividual(<?php echo $_GET['product'];?>,<?php echo ( isset($variants_product['variant']['price']) )?$variants_product['variant']['price']:''; ?> ,'PRODUCT',<?php echo $variants_product['variant']['id'] ;?>);">ADD TO CART!</button>

						<?php }else{  
								header('Location: '.$_SERVER['REQUEST_URI']);
						} ?>
							</div>
						<?php }else{ ?>

						<div class="priceprt">
							<span>List price: <del>$<?php echo ( isset($products['product']['variants'][0]['compare_at_price']) )?$products['product']['variants'][0]['compare_at_price']:''; ?></del></span>
							<span>price: <b>$<?php echo ( isset($products['product']['variants'][0]['price']) )?$products['product']['variants'][0]['price']:''; ?> !</b></span>
							<?php if( isset($products['product']['variants'][0]['compare_at_price']) && isset($products['product']['variants'][0]['price']) && ( intval($products['product']['variants'][0]['compare_at_price']) > intval($products['product']['variants'][0]['price']) ) ){ ?>
							<span>You save: <font>$<?php echo $products['product']['variants'][0]['compare_at_price'] - $products['product']['variants'][0]['price'] ?></font></span>
							<?php }else{ ?> 
								<span>You save: <font>$0</font></span>
							<?php } ?>
							
							<?php 
								if(count($products['product']['variants']) > 1){
							?>

							<span>Size : <select name="size" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
										<?php 
										
										foreach($products['product']['variants'] as $var){ ?> 
											<option value="<?php echo constant("SITEURL").'/product-select-add-to-cart.php?product='.$products['product']['id'].'&variant='.$var['id']?>"><?php echo $var['title']?></option>
										<?php } ?>
										</select>
							</span>

							<?php } ?>

							<?php echo ( isset($products['product']['body_html']) )?$products['product']['body_html']:''; ?>

							<button class="cartbutton" onclick="addToCartProductIndividual(<?php echo $_GET['product'];?>,<?php echo $products['product']['variants'][0]['price'];?>,'PRODUCT',<?php echo $products['product']['variants'][0]['id'];?>);">ADD TO CART!</button>
						</div>
						<?php } ?>

					</div>
				</div>

				<!--</div>-->

				<?php
				}else{
					header('Location: '.$_SERVER['REQUEST_URI']);
				}
				?>

			</div>
	</section>
	<!-- Latest News Page Body Section End -->
	<?php } ?>
	

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
					url: SITEURL+"/manage/product-select-added-to-cart-page-loaded.php",
					type: 'POST',
					data: {product : <?php echo $_GET['product']; ?>},
						success: function(response){
							
							if(response.trim() ==  '0'){
								location.reload();
							}else{
								$('#loaderDiv').hide();
								$('#showProduct').show();
								
							}
				}});
				
		});*/
	</script>

<?php /*if(isset($_GET['variant']) && $_GET['variant'] != ''){  ?>
	<script>
		$(document).ready(function(){
			$.ajax({ 
					url: SITEURL+"/manage/product-price-variant.php",
					type: 'POST',
					data: {variant : <?php echo $_GET['variant']; ?>},
						success: function(response){
							if(response.trim() ==  '0'){
								location.reload();
							}else{
								$('#loaderDiv').hide();
								$('#priceByVariant').show();
							}
				}});
		});
</script>
<?php }*/ ?>


</body>

</html>