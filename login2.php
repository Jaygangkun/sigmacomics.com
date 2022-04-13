<?php
ob_start();
session_start();
$msg = array();
if(!isset($_SESSION['user_email_login2']) && $_SESSION['user_email_login2']== ''){
	header( 'Location: login.php');exit();
}else if(isset($_SESSION['user']) && $_SESSION['user']['id']!= ''){
	// header( 'Location: digital-dashboard');
}
// Get our helper functions
require_once("inc/functions.php");
require_once("inc/connections.php");



/*$sqlNew = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'custom-field' and `post_status`= 'publish' ";*/

$sqlNew = "SELECT * FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id) WHERE wp_posts.post_type = 'custom-field' and wp_posts.post_status= 'publish' AND wp_term_taxonomy.term_id = 1 ORDER BY `ID` ASC ";

	if ($resultNew = $conn->query($sqlNew)) {
		$i = 0; 
		while($rowNew = $resultNew->fetch_assoc()){
			$content[$i] = $rowNew['post_content'];
			$i++;
		}
	}

// Set variables for our request
$shop = "sigma-comics";
$token = "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";
$query = array(
	"Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);
if(isset($_REQUEST['login_next'])){

	$user_password = md5($_REQUEST['user_password']);
	
	if( $user_password != '' && isset($_SESSION['user_email_login2']) ){
		
		$sql = "SELECT * from users WHERE `email` = '".$_SESSION['user_email_login2']."' and `user_password` = '".$user_password."' ";
		if ($result = $conn->query($sql)) {
			//$row = $result->fetch_assoc();
			$row = $result->num_rows ;

			if($row == 1 ){
				$_SESSION['user'] = $result->fetch_assoc();
				unset($_SESSION['user_email_login2']);
				if (isset($_SESSION['add_to_cart_session_id']) && $_SESSION['add_to_cart_session_id'] != '' ){
				// 	header('Location: cart');
				// }else{
					
				}
				header('Location: digital-dashboard');
				exit();
			}else{
				$_SESSION['message'] = $content[51];
				header('Location: login.php');
		  		exit();
			}
		  } else {
			$_SESSION['message'] =  "Error: " . $sql . "<br>" . $conn->error;
			header('Location: login.php');
		  	exit();
		  }
	}
}


?>

<?php 
if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	 unset($_SESSION['message']);
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

	
	<!-- Contact Us Page Body Section Start -->
	<section class="inner-page-body-sec contact-page-body">
		<div class="container">
			<div class="loginWrap">
				<div class="toploginBox">
					<h2><?php echo (isset($content[9]))?$content[9]:'';?></h2>
					<form action="" method="post" id="login2">
					<div class="form-group">
						<p class="bigTxt"><?php echo (isset($_SESSION['user_email_login2']))?$_SESSION['user_email_login2']:''; ?></p>
					</div>
					<div class="form-group">
						<div class="labelwrap">
						<label><?php echo utf8_encode((isset($content[38]))?$content[38]:'');?></label>
							<?php echo (isset($content[10]))?$content[10]:'';?>
						</div>

						<input type="password" name="user_password" class="form-control">
					</div>
					<button class="getbutton"  name="login_next"><?php echo utf8_encode((isset($content[9]))?$content[9]:'');?></button>
					</form>
					<div class="checkboxprt">
						<input type="checkbox" />
						<?php echo (isset($content[50]))?$content[50]:'';?>
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