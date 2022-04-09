<?php
ob_start();
session_start();
$msg = array();
$result =  array();
// Get our helper functions
require_once("inc/functions.php");
require_once("inc/connections.php");

// Set variables for our request
$shop = "sigma-comics";
$token = "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";
$query = array(
	"Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);

// customers data
//$data = array("collection_id" => '228873535653');

$data = array();

// Run API call to submit customers
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/collects.json", $data, 'GET');
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/collections/228873535653/products.json", $data, 'GET');

//$data = array();
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/custom_collections.json", $data, 'GET');

// Convert customers JSON information into an array
//$customers = json_decode($customers['response'], TRUE);

//echo '<pre>';print_r($customers['response']);

if (isset($_SESSION['add_to_cart_retail_session_id']) && $_SESSION['add_to_cart_retail_session_id'] != '' ){
	$sql = "SELECT * from `cart_retail` WHERE `session_id` = '".$_SESSION['add_to_cart_retail_session_id']."' ";
	$result = $conn->query($sql);

	$sqlNew = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart_retail` where `session_id`= '".$_SESSION['add_to_cart_retail_session_id']."' ";
	if ($resultNew = $conn->query($sqlNew)) {
		$rowNew = $resultNew->fetch_assoc();
		$total_quantity = (isset($rowNew['total_quantity']))?$rowNew['total_quantity']:'';
		$total_price = (isset($rowNew['total_price']))?$rowNew['total_price']:'';
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

	

	<!-- Contact Us Page Body Section Start -->
	<section class="inner-page-body-sec contact-page-body">
		<div class="container">
			<div class="cartWrap">
				<div class="leftCartListing">
					<h2>SHOPPING CART</h2>
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<th>
								&nbsp;
							</th>
							<th>
								Price
							</th>
						</tr>
						<tbody>
						<?php 
						if( !empty($result) ){
							if(($result->num_rows > 0)){
							while($row = $result->fetch_assoc()){ 
								
								//print_r($row);

								$productId = $row['shopify_product_id'];
								$products = shopify_call($token, $shop, "/admin/api/2020-10/products/".$productId.".json", $data, 'GET');
								$products = json_decode($products['response'], TRUE);
								//echo '<pre>';print_r($products);

								if(!empty($products['product'])){
						?> 
							<tr>
								<td>
									<div class="productSHowprt">
										<div class="leftImgprt">
											<div class="cartInnerImg">
										<?php if(isset($products['product']['images'][0]['src']) && $products['product']['images'][0]['src'] != '' ){ ?>
												<img src="<?php echo $products['product']['images'][0]['src'];?>" alt="img">
											<?php }else{ ?>
												<img src="<?php echo constant("SITEURL")?>/images/list-img.png" alt="img">
										<?php } ?>
											</div>


											<h4>
											<?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?>
											</h4>
										</div>
										<div class="productCont">
											<h3><?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?></h3>
											<div class="quantity_prt">
												<div class="leftqty">
													Qty: <?php echo $row['quantity'];?>
													<input type="hidden" name="prod_qty" value="<?php echo $row['quantity'];?>"/>
													
												</div>

												<a href="javascript:void(0);" onclick="cartProductRetailDelete(<?php echo $productId;?>)">Delete</a>

											</div>
										</div>
									</div>
								</td>
								<td valign="top" title="price" width="150">
									<b>$ <?php echo $row['price'];?> </b>
								</td>
							</tr>

						<?php }else{  
						
						header('Location: '.$_SERVER['REQUEST_URI']);

						} ?>
						
						<?php } }else{ ?> 
						
							<tr>
								<td>
									<div class="productSHowprt">
									<div class="productCont">
											<h3>Cart is Empty </h3>
										</div>
									</div>
								</td>
							</tr>

						<?php } ?>
					
						<?php }else{ ?>
							<tr>
								<td>
									<div class="productSHowprt">
									<div class="productCont">
											<h3>Cart is Empty </h3>
										</div>
									</div>
								</td>
							</tr>

						<?php } ?>
							
							<!--<tr>
								<td>
									<div class="productSHowprt">
										<div class="leftImgprt">
											<img src="images/list-img.png" alt="img">
											<h4>
												calico volumn 1 issue #1
											</h4>
										</div>
										<div class="productCont">
											<h3>Calico volumn 1: issue#1 (digital)</h3>
											<div class="quantity_prt">
												<div class="leftqty">
													Qty:
													<select>
														<option>1</option>
														<option>2</option>
													</select>
												</div>

												<a href="#">Delete</a>

											</div>
										</div>
									</div>
								</td>
								<td valign="top" title="price">
									<b>$ 1.99</b>
								</td>
							</tr>
							<tr>
								<td>
									<div class="productSHowprt">
										<div class="leftImgprt">
											<img src="images/list-img.png" alt="img">
											<h4>
												calico volumn 1 issue #1
											</h4>
										</div>
										<div class="productCont">
											<h3>Calico volumn 1: issue#1 (digital)</h3>
											<div class="quantity_prt">
												<div class="leftqty">
													Qty:
													<select>
														<option>1</option>
														<option>2</option>
													</select>
												</div>

												<a href="#">Delete</a>

											</div>
										</div>
									</div>
								</td>
								<td valign="top" title="price">
									<b>$ 1.99</b>
								</td>
							</tr>

							<tr>

								<td colspan="2" align="right">
									<b>Subtotal(1 item): $ 1.99</b>
								</td>
							</tr>-->

						</tbody>
					</table>
				</div>

				<div class="rightcrtprice">
					<h4>Subtotal(<?php echo ( isset($total_quantity) && $total_quantity != '' )?$total_quantity:'0'; ?> item): <b>$ <?php echo ( isset($total_price) && $total_price != '' )?$total_price:'0.00'; ?> </b></h4>
					<a href="<?php echo constant("SITEURL")?>/checkout-retail"><button class="redbutton">
						Proceed to checkout ( <?php echo ( isset($total_quantity) && $total_quantity != '' )?$total_quantity:'0'; ?> item)
					</button></a>
				
				</div>
			</div>

		</div>
	</section>
	<!-- Contact Us Page Body Section End -->

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