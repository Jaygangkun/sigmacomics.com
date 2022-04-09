<?php
ob_start();
session_start();
$msg = array();
$variantArr = array();
// Get our helper functions
require_once("inc/functions.php");
require_once("inc/connections.php");

//print_r($_SESSION['user']);

if(!isset($_SESSION['add_to_cart_retail_session_id']) && $_SESSION['add_to_cart_retail_session_id']== ''){
	header( 'Location: retailer-landing/');
	exit();
}else{

	$sql = "SELECT * from `cart_retail` WHERE `session_id` = '".$_SESSION['add_to_cart_retail_session_id']."' ";
	$result = $conn->query($sql);

	$sqlPro = "SELECT SUM(quantity) as total_quantity,sum(price) as total_price FROM `cart_retail` where `session_id`= '".$_SESSION['add_to_cart_retail_session_id']."' ";
	if ($resultPro = $conn->query($sqlPro)) {
		$rowPro = $resultPro->fetch_assoc();
		$total_quantity = (isset($rowPro['total_quantity']))?$rowPro['total_quantity']:'';
		$total_price_product = (isset($rowPro['total_price']))?$rowPro['total_price']:'';
	}

	$sqlProNew = "SELECT enclosure_price FROM `delivery_enclosure_of_cart_retail` where `session_id`= '".$_SESSION['add_to_cart_retail_session_id']."' ";
	if ($sqlProNew = $conn->query($sqlProNew)) {
		$rowProNew = $sqlProNew->fetch_assoc();
		$enclosure_price = (isset($rowProNew['enclosure_price']))?$rowProNew['enclosure_price']:'';
	}


	$total_price = number_format( ($total_price_product + $enclosure_price) , 2);


}

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

if(isset($_REQUEST['token']) && $_REQUEST['token'] != ''){
	
	require_once(__DIR__ . '/stripe/init.php');

	\Stripe\Stripe::setApiKey(constant("STRIPE_SECRET_KEY"));

	$is_error = 0;
	$is_error_pro = 0;

	try{

	$customer = \Stripe\Customer::create(array(
		'email' => $_REQUEST['email'],
		'card'  => $_REQUEST['token']
		));
	}

	catch(\Stripe\Error\Card $e) {

		$is_error = 1;       
		$body = $e->getJsonBody();
		$err  = $body['error'];
		$msg = $err['message'];  

	} catch (\Stripe\Error\RateLimit $e) {

		$is_error = 1;  
		$body = $e->getJsonBody();
		$err  = $body['error'];
		$msg = $err['message'];  

	} catch (\Stripe\Error\InvalidRequest $e) {

		$is_error = 1;          
		$body = $e->getJsonBody();
		$err  = $body['error'];
		$msg = $err['message'];  

	} catch (\Stripe\Error\Authentication $e) {

		$is_error = 1;    
		$body = $e->getJsonBody();
		$err  = $body['error'];
		$msg = $err['message'];

	} catch (\Stripe\Error\ApiConnection $e) {   

		$is_error = 1;      
		$body = $e->getJsonBody();
		$err  = $body['error'];
		$msg = $err['message'];  

	} catch (\Stripe\Error\Base $e) {

		$is_error = 1;     
		$body = $e->getJsonBody();
		$err  = $body['error'];
		$msg = $err['message'];  

	} catch (Exception $e) {

		$is_error = 1;     
		$body = $e->getJsonBody();
		$err  = $body['error'];
		$msg = $err['message']; 

	}
	//echo '1';exit();

	if($is_error == 0){
		try{
			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount'   => $_REQUEST['total_price']*100,
				'currency' => 'USD'
			));
		}

		catch(\Stripe\Error\Card $e) {

			$is_error_pro = 1;       
			$body = $e->getJsonBody();
			$err  = $body['error'];
			$msg = $err['message'];  
	
		} catch (\Stripe\Error\RateLimit $e) {
	
			$is_error_pro = 1;  
			$body = $e->getJsonBody();
			$err  = $body['error'];
			$msg = $err['message'];  
	
		} catch (\Stripe\Error\InvalidRequest $e) {

			$is_error_pro = 1;          
			$body = $e->getJsonBody();
			$err  = $body['error'];
			$msg = $err['message'];  
	
		} catch (\Stripe\Error\Authentication $e) {

			$is_error_pro = 1;    
			$body = $e->getJsonBody();
			$err  = $body['error'];
			$msg = $err['message'];
	
		} catch (\Stripe\Error\ApiConnection $e) {   
	
			$is_error_pro = 1;      
			$body = $e->getJsonBody();
			$err  = $body['error'];
			$msg = $err['message'];  
	
		} catch (\Stripe\Error\Base $e) {
	
			$is_error_pro = 1;     
			$body = $e->getJsonBody();
			$err  = $body['error'];
			$msg = $err['message'];  
	
		} catch (Exception $e) {

			$is_error_pro = 1;     
			$body = $e->getJsonBody();
			$err  = $body['error'];
			$msg = $err['message']; 
	
		}

		if($is_error_pro == 0){
			if($charge->id != ''){

				for($i=0; $i<$_REQUEST['count']; $i++){
					$responsArr[$i]['variant_id'] = $_REQUEST['variantId_'.$i];
					$responsArr[$i]['quantity'] = $_REQUEST['quantity_'.$i];
					$responsArr[$i]['price'] = $_REQUEST['price_'.$i];

					$shopifyProductArr[] = $_REQUEST['shopify_product_'.$i];
					//$typesArr[] = $_REQUEST['type_'.$i];
				}

				if($_REQUEST['shipping_price'] > 0){
					$responsShippingArr[0]['code'] = "INT.TP";
					$responsShippingArr[0]['title'] = 'Shipping & handling';
					$responsShippingArr[0]['price'] = $_REQUEST['shipping_price'];
				}else{
					$responsShippingArr = [];
				}
				
				

				$data = array(
					"order" => array(
						"email" => $_REQUEST['email'],
						"fulfillment_status" => "fulfilled",
						"send_receipt" => false,
						"send_fulfillment_receipt" => false,
					
						"line_items" => $responsArr,
						"shipping_lines" => $responsShippingArr,
						"billing_address" => array(
							"company" => $_REQUEST['company'],
							"phone" => $_REQUEST['phone'],
							"address1" => $_REQUEST['address1'],
							"city" => $_REQUEST['city'],
							"province" => $_REQUEST['state'],
							"country" => $_REQUEST['country'],
							"first_name" => $_REQUEST['first_name'],
							"last_name" => $_REQUEST['last_name'],
							"zip" => $_REQUEST['zip'],
					)
					)
				);
				
				//echo '<pre>';print_r($data);exit();
				
				$checkouts = shopify_call($token, $shop, "/admin/api/2020-10/orders.json", json_encode($data), 'POST',array("Content-Type: application/json"));

				//echo '<pre>';print_r($checkouts);exit();

				$shopifyProductList = implode(',',$shopifyProductArr);
				//$typeList 			= implode(',',$typesArr);
				
				$sqlOrder = "INSERT INTO orders (`user_id`, `shopify_user_id`,`shopify_product_ids`, `types`) VALUES ('".$_SESSION['user']['id']."', '".$_SESSION['user']['shopify_customer_id']."', '".$shopifyProductList."','RETAIL')";

				
				if ($conn->query($sqlOrder) === TRUE) {

					$sqlPro = "DELETE from cart_retail WHERE `session_id`= '".$_SESSION['add_to_cart_retail_session_id']."' ";

					if ($conn->query($sqlPro) === TRUE) {
						$sqlProNew = "DELETE from delivery_enclosure_of_cart_retail WHERE `session_id`= '".$_SESSION['add_to_cart_retail_session_id']."' ";
						$conn->query($sqlProNew);

					}

					unset($_SESSION['add_to_cart_retail_session_id']);
					unset($_SESSION['shopify_product_id']);
					header( 'Location: thank-you-for-order');
					exit();
					
				}
				
				// Convert customers JSON information into an array
				//$checkoutsResp = json_decode($checkouts['response'], TRUE);
				//print_r($checkoutsResp);exit();

			}else{
				echo 'Payment Not successfull '.$msg;
			}
		}else{
			echo 'Payment Not successfull '.$msg; 
		}
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

	
	<div id="error-message"></div>
	<div id="error-message-individual"></div>
	<!-- Contact Us Page Body Section Start -->
	<section class="inner-page-body-sec contact-page-body">
		<div class="container">
			<h2 class="text-center checkheading">Checkout <span>( <?php echo $total_quantity;?> <?php echo($total_quantity > 1)?'items':'item'; ?> )</span></h2>
			<div class="cartWrap">

			

				<div class="leftcheckout">

				<form action= "" method="post" id = "stripe_pay">
					<div class="formPrt">
						<span class="shipHeading"><b>STEP 1: Shipping address</b></span>
						<div class="addressdetail">
						<input name="first_name" id="first_name" type="text" placeholder="First Name">
						<input name="last_name" id="last_name" type="text" placeholder="Last Name">
						<input name="company" id="company" type="text" placeholder="Store Name">
						<input name="phone" id="phone" type="text" placeholder="Phone">
						<input name="address1" id="address1" placeholder="Mailing Address 1">
						<input name="address2" id="address2" placeholder="Mailing Address 2">	
						<input name="city" id="city" placeholder="City">	
						<input name="state" id="state" placeholder="State / Province">
						<input name="country" id="country" placeholder="Country">
						<input name="zip" id="zip" placeholder="Zip">					
						
						<!--<span>
								Sourav Roy
							</span>
							<span>
								CF-13, Swapnaneel Apartment, Chandiberia, Kestopur
							</span>
							<span>
								Kolkata, West Bengal, 700002
							</span>
							<a href="#">Add delivery instructions</a>-->
						</div>
						<!--<span>
							<a href="#">Change</a>
						</span>-->
					</div>

					<div class="formPrt">
						<span class="shipHeading"><b>STEP 2: Payment method</b></span>
						<div class="addressdetail">
						<div class="field-row">
							<!-- <span id="card-holder-name-info"
								class="info"></span> -->
								<input type="text" id="name"
								name="name" class="demoInputBox" placeholder="Cardholder Name">
						</div>
						<div class="field-row">
							<!-- <span id="email-info" class="info"></span> -->
							<input type="text" id="email" name="email" class="demoInputBox" placeholder="Email">
						</div>
						<div class="field-row full-width">
							<!-- <span id="card-number-info"
								class="info"></span> -->
								<input type="text" id="card-number"
								name="card-number" class="demoInputBox" placeholder="Card Number">
						</div>
						<div class="field-row full-width">
							<div class="contact-row column-right">
								<label>Expiry Month / Year</label> 
								<!-- <span id="userEmail-info"
									class="info"></span> -->
									<div class="twofieldprt">
									<select name="month" id="month"
									class="demoSelectBox">
									<option value="01">1</option>
									<option value="02">2</option>
									<option value="03">3</option>
									<option value="04">4</option>
									<option value="05">5</option>
									<option value="06">6</option>
									<option value="07">7</option>
									<option value="08">8</option>
									<option value="09">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select> 
								<select name="year" id="year"
									class="demoSelectBox">
									<option value="20">2020</option>
									<option value="21">2021</option>
									<option value="22">2022</option>
									<option value="23">2023</option>
									<option value="24">2024</option>
									<option value="25">2025</option>
									<option value="26">2026</option>
									<option value="27">2027</option>
									<option value="28">2028</option>
									<option value="29">2029</option>
									<option value="30">2030</option>
								</select>
								</div>
							</div>
							<div class="contact-row cvv-box">
								<label>CVC</label>
								<!-- <span id="cvv-info" class="info"></span> -->
								<input type="text" name="cvc" id="cvc"
									class="demoInputBox cvv-input">
							</div>
						</div>
						</div>
						<!--<span>
							<a href="#">Change</a>
						</span>-->
					</div>

					<div class="reviewSection">
						<span class="shipHeading"><b>STEP 3: Review items and shipping</b></span>
						<div class="delivery_box">
							<h3>Estimate delivery: 2-3 Business Days (Depending on your location)</h3>
							<?php 
							//echo '<pre>';print_r($result);exit();
							if( !empty($result) ){
								if(($result->num_rows > 0)){
									$count = 0;
									
									while($row = $result->fetch_assoc()){ 
										$productId = $row['shopify_product_id'];
										
										$products = shopify_call($token, $shop, "/admin/api/2020-10/products/".$productId.".json", $data, 'GET');
										$products = json_decode($products['response'], TRUE);

										//echo '<pre>';print_r($products);exit();

										if(empty($products['product'])){
											header('Location: '.$_SERVER['REQUEST_URI']);
										}
										
										$variantId = $products['product']['variants'][0]['id'];
										$variants_product_price = $products['product']['variants'][0]['price'];
																	
										
										//print_r($variantArr);
							?>
							<input type="hidden" name="variantId_<?php echo $count; ?>" value="<?php echo $variantId; ?>"  />
							<input type="hidden" name="quantity_<?php echo $count; ?>" value="<?php echo $row['quantity']; ?>"  />
							<input type="hidden" name="price_<?php echo $count; ?>" value="<?php echo $variants_product_price;?>"  />

							<input type="hidden" name="shopify_product_<?php echo $count; ?>" value="<?php echo $productId;?>"  />
							
							<div class="delivarycont">
								<div class="leftdelivary">
									<?php if(isset($products['product']['images'][0]['src']) && $products['product']['images'][0]['src'] != '' ){ ?>
											<img src="<?php echo $products['product']['images'][0]['src'];?>" alt="img">
										<?php }else{ ?>
											<img src="<?php echo constant("SITEURL")?>/images/list-img.png" alt="img">
									<?php } ?>
								</div>
								<div class="rightdelivarycont">
									<h3><?php echo ( isset($products['product']['title']) )?$products['product']['title']:''; ?></h3>
									<!--<h4>Print reader subscription</h4>-->
									<span class="price"><b>$<?php echo $row['price'];?></b></span>
									<div class="delivaryquantity_prt">
										<div class="leftqty">
										Qty: <?php echo $row['quantity'];?>
										<input type="hidden" name="prod_qty" value="<?php echo $row['quantity'];?>"/>
										</div>

										<!--<a href="#" class="giftBtn">
											<i class="fa fa-gift"></i>
											Add gift options
										</a>-->

									</div>
								</div>
							</div>
								<?php $count++; } ?> 
								<input type="hidden" name="count" value="<?php echo $count;?>"  />
								<input type="hidden" name="total_price" value="<?php echo $total_price;?>"  />	
								<input type="hidden" name="shipping_price" value="<?php echo $enclosure_price;?>"  />	
							<?php } }?>
							
						</div>
						</form>

						<div class="order_box">

							<button class="redbutton" name="place_order" onClick="stripePay(event);" >
								Place Your Order
							</button>
							<div class="ordertotalprt">
								<b>Order total: $<?php echo $total_price;?></b>
								<p>By placing your order, agree to sigma Comic's <a href="#">Privacy Notice</a> and <a
										href="#">Terms & Conditions.</a></p>
							</div>
						</div>

						

						<div class="questionprt">
							<span>
								<a href="<?php echo constant("SITEURL")?>/faq">
									Why do I have to pay sales tax?
								</a>
							</span>
							<span>
								<a href="<?php echo constant("SITEURL")?>/faq">
									Have questions, consult our FAQ page.
								</a>
							</span>
							<span>
								<a href="<?php echo constant("SITEURL")?>/faq">
									We offer NO RETURNS on our products. No exceptions.
								</a>
							</span>
							<span>
								<a href="<?php echo constant("SITEURL")?>/faq">
									Do I get tracking information on my order?
								</a>
							</span>

						</div>
					</div>
				</div>
				<div class="rightcheckout">
					<img src="images/fully-secureicon.png" alt="">

					<div class="order-summeryBox">
						<button class="redbutton" name="place_order" onClick="stripePay(event);">
							Place Your Order
						</button>
						<p>By placing your order, agree to sigma Comic's <a href="#">Privacy Notice</a> and <a
								href="#">Terms & Conditions.</a>
						</p>
						<div class="midboxOrder">
							<h3>Order Summary</h3>
							<div class="itemList">
								<span>
									<label><?php echo($total_quantity > 1)?'Items':'Item'; ?></label>
									<?php echo $total_quantity; ?>
								</span>
								<span>
									<label>Shipping & handling</label>
									$<?php echo $enclosure_price; ?>
								</span>
								<div class="totalPrt">
									<span>
										<label>Total before tax:</label>
										$<?php echo $total_price_product ?>
									</span>
									<span>
										<label>Estimated tax to be collected:*</label>
										$0.00
									</span>
								</div>
								<span class="totalTxt">
									<label>Order total</label>
									$<?php echo $total_price ?>
								</span>
							</div>
						</div>
					</div>
					<div class="howcalculated">
						<a href="#">How are the shipping costs calculated?</a>
					</div>
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
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script>
function cardValidation () {
    var valid = true;

	var first_name = $('#first_name').val();
	var last_name = $('#last_name').val();
	var company = $('#company').val();
	var phone = $('#phone').val();
	var address1 = $('#address1').val();
	var city = $('#city').val();
	var country = $('#country').val();
	var zip = $('#zip').val();
    var name = $('#name').val();
    var email = $('#email').val();
    var cardNumber = $('#card-number').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var cvc = $('#cvc').val();

    $("#error-message").html("").hide();
	
	if (first_name.trim() == "") {
        valid = false;
    }
	if (last_name.trim() == "") {
        valid = false;
    }
	if (company.trim() == "") {
        valid = false;
    }
	
	if (address1.trim() == "") {
        valid = false;
    }
	if (city.trim() == "") {
        valid = false;
    }
	if (country.trim() == "") {
        valid = false;
    }
	if (zip.trim() == "") {
        valid = false;
    }
    if (name.trim() == "") {
        valid = false;
    }
    if (email.trim() == "") {
    	   valid = false;
    }else{
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if (reg.test(email.trim()) == false) 
        {
            valid = false;
			invalidEmail = false;

        }else{
			invalidEmail = true;
		}
	}

    if (cardNumber.trim() == "") {
    	   valid = false;
    }else{
		if(validateCreditCard(cardNumber.trim()) == false ){
			valid = false;
			invalidCard = false;
		}else{
			invalidCard = true;
		}
	}

	if (phone.trim() == "") {
    	   valid = false;
    }else{
		var reg = /^[0-9]+$/;
		if (reg.test(phone.trim()) == false) 
        {
            valid = false;
			invalidPhone = false;

        }else{
			invalidPhone = true;
		}
	}

	

    if (month.trim() == "") {
    	    valid = false;
    }
    if (year.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }

    if(valid == false) {
        $("#error-message").html("All Fields are required").show();
    }

	if(invalidEmail == false) {
        $("#error-message-individual").html("Invalid Email. Please use correct format").show();
    }else{
		$("#error-message-individual").html("").hide();
	}

	if(invalidCard == false) {
        $("#error-message-individual").html("Invalid Card. Please use correct one").show();
    }else{
		$("#error-message-individual").html("").hide();
	}

	if(invalidPhone == false) {
        $("#error-message-individual").html("Invalid Phone. Please use correct one").show();
    }else{
		$("#error-message-individual").html("").hide();
	}

    return valid;
}
//set your publishable key
Stripe.setPublishableKey("<?php echo constant("STRIPE_PUBLISHABLE_KEY")?>");

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        //enable the submit button
        $("#submit-btn").show();
        $( "#loader" ).css("display", "none");
        //display the errors on the form
        $("#error-message").html(response.error.message).show();
    } else {
        //get token id
        var token = response['id'];
        //insert the token into the form
        $("#stripe_pay").append("<input type='hidden' name='token' value='" + token + "' />");
        //submit form to the server
        $("#stripe_pay").submit();
    }
}
function stripePay(e) {
    e.preventDefault();
    var valid = cardValidation();

    if(valid == true) {
        $("#submit-btn").hide();
        $( "#loader" ).css("display", "inline-block");
        Stripe.createToken({
            number: $('#card-number').val(),
            cvc: $('#cvc').val(),
            exp_month: $('#month').val(),
            exp_year: $('#year').val()
        }, stripeResponseHandler);

        //submit from callback
        return false;
    }
}

function validateCreditCard(creditCardNum){

	// The credit card number must be 16 digits in length
	if(creditCardNum.length !== 16){
	return false;
	}

	// All of the digits must be numbers
	for(var i = 0; i < creditCardNum.length; i++){
	// store the current digit
	var currentNumber = creditCardNum[i];

	// turn the digit from a string to an integer (if the digit is in fact a digit and not anther char)
	currentNumber = Number.parseInt(currentNumber);

	// check that the digit is a number
	if(!Number.isInteger(currentNumber)){
		return false;
	}
	}

	// The credit card number must be composed of at least two different digits (i.e. all of the digits cannot be the same)
	var obj = {};
	for(var i = 0; i < creditCardNum.length; i++){
	obj[creditCardNum[i]] = true;
	}
	if(Object.keys(obj).length < 2){
	return false;
	}

	// The final digit of the credit card number must be even
	if(creditCardNum[creditCardNum.length - 1] % 2 !== 0){
	return false;
	}

	// The sum of all the digits must be greater than 16
	var sum = 0;
	for(var i = 0; i < creditCardNum.length; i++){
	sum += Number(creditCardNum[i]);
	}
	if(sum <= 16){
	return false;
	}

	return true;
};
</script>
</body>

</html>