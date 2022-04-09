<?php
ob_start();
session_start();
$msg = array();

if( (!isset($_SESSION['user_email']) && $_SESSION['user_email']== '') ){
	header( 'Location: signup');
	exit();
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

if(isset($_REQUEST['signup_next'])){
	$user_password = md5($_REQUEST['user_password']);

		if($_SESSION['user_email'] != '' && isset($_SESSION['user_email']) ){
			$sql = "SELECT `id` from users WHERE `email` = '".$_SESSION['user_email']."' ";
			if($result = $conn->query($sql)){

				$row = $result->num_rows ;
				$user_email = $_SESSION['user_email'];

				if($row == 0){
					
					// Run API call to submit customers
					$customers_search = shopify_call($token, $shop, "/admin/api/2020-10/customers/search.json?query=$user_email", 'GET');
					// Convert customers JSON information into an array
					$customers_search = json_decode($customers_search['response'], TRUE);

					if( !empty($customers_search['customers']) ){
												
						$sqlRow = "INSERT INTO users (shopify_customer_id, email, user_password) VALUES ('".$customers_search['customers'][0]['id']."', '".$_SESSION['user_email']."', '".$user_password."')";
						if ($conn->query($sqlRow) === TRUE) {
							$_SESSION['message'] = "GREAT! NOW YOU CAN LOG IN BELOW!";
						} else {
							$_SESSION['message'] =  "Error: " . $sqlRow . "<br>" . $conn->error;
						}

					}else{
						
						// customers data
						$data = array(
							"customer" => array(
								"email" => $_SESSION['user_email']
							)
						);

						// Run API call to submit customers
						$customers = shopify_call($token, $shop, "/admin/api/2020-10/customers.json", $data, 'POST');


						// Convert customers JSON information into an array
						$customers = json_decode($customers['response'], TRUE);


						$sqlRow = "INSERT INTO users (shopify_customer_id, email, user_password) VALUES ('".$customers['customer']['id']."', '".$_SESSION['user_email']."', '".$user_password."')";
						if ($conn->query($sqlRow) === TRUE) {
							$_SESSION['message'] = "GREAT! NOW YOU CAN LOG IN BELOW!";
						} else {
							$_SESSION['message'] =  "Error: " . $sqlRow . "<br>" . $conn->error;
						}

					}
					

					header('Location: signup');
					exit();

					
				}else{
					$_SESSION['message'] = 'Email Already Exist!';
					header('Location: signup');
					exit();
				}
			}
		}
	}


	$sqlNew = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'custom-field' and `post_status`= 'publish' ";
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
	?>
	<!-- Header Section End -->

	<div class="MsgBox failMsg">	
	<?php 
	if(isset($_SESSION['message'])){
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
	?>
  </div>
	<!-- Contact Us Page Body Section Start -->
	<section class="inner-page-body-sec contact-page-body">
		<div class="container">
			<div class="thankyoubody">

				<h3><?php echo (isset($content[4]))?$content[4]:'';?></h3>

				<div class="signlogpanel">
					<div class="toploginBox passwordbox">
						<form action="" method="post" id="thank-you-digital-form">
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="user_password" class="form-control">
						</div>
						<button class="redbutton" name="signup_next">NEXT</button>
						</form>
						<p><?php echo (isset($content[5]))?$content[5]:'';?></p>
					</div>



				</div>
			</div>

		</div>
	</section>
	<!-- Contact Us Page Body Section End -->

	<?php
	require_once("include/footer.php");
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