<?php
ob_start();
session_start();
$msg = array();


if(isset($_SESSION['user']) && $_SESSION['user']['id']!= ''){
	header( 'Location: digital-dashboard');
	exit();
}


// Get our helper functions
require_once("inc/functions.php");
require_once("inc/connections.php");
require_once("PHPMailer/src/PHPMailer.php");
require_once("PHPMailer/src/SMTP.php");
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
						header('Location: reset-password-2.php');
					}
				}
			}else {
				$_SESSION['message'] =  "Error: " . $sql . "<br>" . $conn->error;
				header('Location: forgot-password');
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

<?php 
//echo '1234';exit();
?>

<body>
	<!-- Header Section Start -->
	<?php
	require_once("include/header.php");
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
					<h2>CHANGE PASSWORD</h2>
					<form action="" method="post" id="change-password-form">
					<div class="form-group">
						<p class="bigTxt">Enter the password with your account.</p>
					</div>
					<div class="form-group">
						<div class="labelwrap">
							<label>New Password</label>
						</div>

						<input type="password" name="password" id="password_new" class="form-control">

						<div class="labelwrap">
							<label>Confirm Password</label>
						</div>

						<input type="password" name="confirmpassword"  class="form-control">
					</div>
					<button class="getbutton"  name="forgot_pass_next">Submit</button>
					</form>
					<div class="checkboxprt">
					Still having issues? <a href="<?php echo constant("SITEURL")."/contact";?>">Get in CONTACT</a>
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