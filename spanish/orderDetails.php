<?php 
	ob_start();
	session_start();
	$msg = array();
	$variantArr = array();

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

	$data = array();

	if(!empty($_GET['paymentID']) && !empty($_GET['payerID']) && !empty($_GET['token']) ){

		//print_r($_REQUEST);exit();

		$paymentID = $_GET['paymentID'];
		$payerID = $_GET['payerID'];

		for($i=0; $i<$_REQUEST['count']; $i++){
			$responsArr[$i]['variant_id'] = $_REQUEST['variantId_'.$i];
			$responsArr[$i]['quantity'] = $_REQUEST['quantity_'.$i];
			$responsArr[$i]['price'] = $_REQUEST['price_'.$i];

			$shopifyProductArr[] = $_REQUEST['shopify_product_'.$i];
			$typesArr[] = $_REQUEST['type_'.$i];
		}

		$data = array(
			"order" => array(
				"email" => $_REQUEST['email'],
				"fulfillment_status" => "fulfilled",
				"send_receipt" => false,
				"send_fulfillment_receipt" => false,
				"line_items" => $responsArr,
					"billing_address" => array(
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

		$checkouts = shopify_call($token, $shop, "/admin/api/2020-10/orders.json", json_encode($data), 'POST',array("Content-Type: application/json"));

		$shopifyProductList = implode(',',$shopifyProductArr);
		$typeList 			= implode(',',$typesArr);
		
		$sqlOrder = "INSERT INTO orders (`user_id`, `shopify_user_id`,`shopify_product_ids`, `types`,`stripe_token`,`stripe_charge`,`language`) VALUES ('".$_SESSION['user']['id']."', '".$_SESSION['user']['shopify_customer_id']."', '".$shopifyProductList."','".$typeList."','".$payerID."','".$paymentID."','".$_SESSION['lang']."')";
		
		if ($conn->query($sqlOrder) === TRUE) {

			$sqlPro = "DELETE from cart WHERE `session_id`= '".$_SESSION['add_to_cart_session_id']."' ";

			if ($conn->query($sqlPro) === TRUE) {
				echo $_REQUEST['type'];
			}

			unset($_SESSION['add_to_cart_session_id']);
			unset($_SESSION['shopify_product_id']);

			if( in_array('IDI',$typesArr) || in_array('DS',$typesArr) || in_array('PRDS',$typesArr) || in_array('PCDS',$typesArr) ){
				header( 'Location:'.constant('SITEURL_SPANISH').'/digital-dashboard-2');
			}else if(in_array('IPR',$typesArr) || in_array('IPC',$typesArr) || in_array('PRS',$typesArr) || in_array('PCS',$typesArr ) || in_array('PRCS',$typesArr) ){
				header( 'Location:'.constant('SITEURL_SPANISH').'/thank-you-print');
			}else{
				header( 'Location:'.constant('SITEURL_SPANISH').'/thank-you-for-order');
			}
			
			exit();
			
		}


		?>
		
	<?php	
	} else {
		//header('Location:index.php');
	}
	?>