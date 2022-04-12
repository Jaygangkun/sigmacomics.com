<?php

ob_start();
session_start();
$msg = array();

if(isset($_SESSION['user']) && $_SESSION['user']['id']!= ''){
	header( 'Location:'.constant('SITEURL_SPANISH').'/digital-dashboard-2');
}
// Get our helper functions
require_once("language_redirect.php");
require_once(dirname(dirname(__FILE__))."/inc/functions.php");
require_once(dirname(dirname(__FILE__))."/inc/connections.php");
require_once(dirname(dirname(__FILE__))."/PHPMailer/src/PHPMailer.php");
require_once(dirname(dirname(__FILE__))."/PHPMailer/src/SMTP.php");
$mail = new PHPMailer\PHPMailer\PHPMailer();

// Set variables for our request
$shop = "sigma-comics";
$token = "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";
$query = array(
	"Content-type" => "application/json" // Tell Shopify that we're expecting a response in JSON format
);

if(isset($_REQUEST['forgot_pass_next'])){

	$password 			= $_REQUEST['password'];
	$confirmpassword 	= $_REQUEST['confirmpassword'];
	
	if( $password != '' ){

		if($password == $confirmpassword){

			$password 			= md5($_REQUEST['password']);
			
			$id = base64_decode(base64_decode(base64_decode(base64_decode($_REQUEST['flag']))));
			$sql = "SELECT count(*) as total from users WHERE `id`= '".$id."' ";

			if ($result = $conn->query($sql)) {
				$row = $result->fetch_assoc();
				if($row['total'] > 0){
					$sql = "UPDATE users SET user_password = '".$password."' WHERE `id`= '".$id."'   ";
					if ($conn->query($sql) === TRUE) {
						header( 'Location:'.constant('SITEURL_SPANISH').'/reset-password-2.php');
					}
				}
			}else {
				$_SESSION['message'] =  "Error: " . $sql . "<br>" . $conn->error;
				header( 'Location:'.constant('SITEURL_SPANISH').'/forgot-password');
				exit();
			}
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
	<link rel="icon" type="image/png" href="images/favicon.png">
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

<!--<div class="MsgBox successMsg failMsg">	-->
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
			<div class="loginWrap">
				<div class="toploginBox">
					<h2>CAMBIA SU CONTRASEÑA</h2>
					<form action="" method="post" id="change-password-form">
					<div class="form-group">
						<p class="bigTxt">Cambielo aqui.</p>
					</div>
					<div class="form-group">
						<div class="labelwrap">
							<label>Nueva contraseña</label>
						</div>

						<input type="password" name="password" id="password_new" class="form-control">

						<div class="labelwrap">
							<label>Confirmar Contraseña</label>
						</div>

						<input type="password" name="confirmpassword"  class="form-control">
					</div>
					<button class="getbutton"  name="forgot_pass_next">¡SIGUIENTE! </button>
					</form>
					<div class="checkboxprt">
					¿Sigue teniendo problemas? Póngase en <a href="<?php echo constant("SITEURL_SPANISH")."/contact";?>">CONTACTO</a>
					</div>

				</div>


			</div>

		</div>
	</section>
	<!-- Contact Us Page Body Section End -->

	<?php
	require_once(__ROOT__."/include/footer.php");
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