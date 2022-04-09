<?php
ob_start();
session_start();
$msg = array();

require_once("inc/functions.php");
require_once("inc/connections.php");

$_SESSION['add_to_cart_retail_session_id'] = session_id();

$shop = "sigma-comics";
$token = "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";
$query = array(
	"Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);

$data = array();

// Run API call to submit customers
//$customers = shopify_call($token, $shop, "/admin/api/2020-10/collects.json", $data, 'GET');
$products = shopify_call($token, $shop, "/admin/api/2020-10/collections/233058795685/products.json", $data, 'GET');

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
	<link rel="icon" type="image/png" href="images/favicon.png">
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
	if( isset($_REQUEST['cartbutton']) && !empty($_REQUEST['cartbutton'])){

		if( is_numeric($_REQUEST['retail_product_0']) ){
			
			for($i=0;$i <= $_REQUEST['retail_issues'];$i++){

				$products_price = shopify_call($token, $shop, "/admin/api/2020-10/products/".$_REQUEST['retail_product_'.$i].".json", $data, 'GET');
				$products_price = json_decode($products_price['response'], TRUE);

				if(!empty($products_price['product'])){

					$sqlCart = "SELECT * FROM `cart_retail` where `session_id`= '".$_SESSION['add_to_cart_retail_session_id']."' AND `shopify_product_id`= '".$_REQUEST['retail_product_'.$i]."' ";

					if ($result = $conn->query($sqlCart)) {

						$row = $result->fetch_assoc();

						if($result->num_rows > 0){
							
							if(is_numeric($_REQUEST['retail_product_'.$i])){
								$price = $products_price['product']['variants'][0]['price'];

								$quantity = $row['quantity']+$_REQUEST['retail_product_number_'.$i] ;
								$priceNew = $price*$quantity;
	
								$sql = "UPDATE cart_retail SET quantity = '".$quantity."',price = '".$priceNew."' WHERE `session_id`= '".$_SESSION['add_to_cart_retail_session_id']."' AND `shopify_product_id`= '".$_REQUEST['retail_product_'.$i]."' ";
	
								if ($conn->query($sql) === TRUE) {
									$sqlEnclosure = "UPDATE delivery_enclosure_of_cart_retail SET enclosure_price = '".$_REQUEST['enclosure']."' WHERE `session_id`= '".$_SESSION['add_to_cart_retail_session_id']."' ";
									$conn->query($sqlEnclosure);
								}
							}
							

						}else{

							if(is_numeric($_REQUEST['retail_product_'.$i])){

								$price = $products_price['product']['variants'][0]['price']*$_REQUEST['retail_product_number_'.$i];

								$sql = "INSERT INTO cart_retail (`session_id`, `shopify_product_id`, `quantity`,`price`) VALUES ('".$_SESSION['add_to_cart_retail_session_id']."', '".$_REQUEST['retail_product_'.$i]."','".$_REQUEST['retail_product_number_'.$i]."','".$price."')";

								if ($conn->query($sql) === TRUE) {
									$sqlEnclosure = "INSERT INTO delivery_enclosure_of_cart_retail (`session_id`, `enclosure_price`) VALUES ('".$_SESSION['add_to_cart_retail_session_id']."', '".$_REQUEST['enclosure']."')";
			
									$conn->query($sqlEnclosure);
								}
							}

						}
						
					}
					
				}else{
					header('Location: '.$_SERVER['REQUEST_URI']);
				}
			}
			header('Location: cart-retail');
		}
	}
	
	?>
	<!-- Header Section End -->

	<!-- Contact Us Page Body Section Start -->
	<section class="inner-page-body-sec contact-page-body">
		<div class="container">
			<div class="indi_list retailerPrt">
				<h3>NEW YORK CITY'S STARTING TO STINK</h3>

				<p>
					Bodies are piling up. And it’s not because of Coronavirus. There’s lots of really bad people out
					there. They’re in for a
					really bad time.
				</p>
				<h4>Enter CALICO</h4>
				<p>
					NYC’S newest anti-hero makes Frank “What’s his face” look like your nursery school teacher. Strap in
					and get ready for
					22 pages of action-packed, gut-busting storyline set in the mean streets of NYC, featuring sizzling,
					gritty art by
					Javier Orabich. Time to stock your shelves.
				</p>
				<h4>Make your selections below:</h4>

				<form action="" method = "post"> 
				<div class="selissueprt">
					<select name="retail_product_0">
						<option value="Select Issue">Select Issue</option>
						<?php 
						if(!empty($products['products'])){
							foreach($products['products'] as $key=>$data){
						?>
						<option value="<?php echo $data['id']; ?>"><?php echo $data['title'];?></option>
						
						<?php } }else{
							header('Location: '.$_SERVER['REQUEST_URI']);
						}
					 	?>
					</select>
					<input type="number" name="retail_product_number_0" placeholder="Qty" min = "1" value="1" />
				</div>

				<div id="add-more"></div>
				<input type="hidden" name="retail_issues" id ="retail_issues" value="0" />
				<!--<button class="redbutton adding" onclick="addMore();">SELECT OTHER ISSUE</button>-->
				<a href="javascript:void(0);" onclick="addMore();">SELECT OTHER ISSUE</a>

				<h4 class="margin30">DELIVERY ENCLOSURE</h4>

				<div class="selissueprt">
					<select name="enclosure">
						<option value="0">Polybag & Boarded in Envelop</option>
						<option value="2">Polybag & Boarded in Box +$2</option>
					</select>
				</div>

				<!--<button class="cartbutton margin20">ADD TO CART!</button>-->
				<input type="submit" name="cartbutton" class="cartbutton" value="ADD TO CART!" />
				</form>
			</div>

		</div>
	</section>
	<!-- Contact Us Page Body Section End -->

	<!-- Footer Section Start -->
	<?php
	require_once("include/footer.php");
	?>
	<!-- Footer Section End -->

	<!-- Footer Copyright Section Start -->
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