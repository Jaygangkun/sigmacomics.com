<?php

ob_start();
session_start();
$msg = array();

if(isset($_SESSION['user']) && $_SESSION['user']['id']!= ''){
	header( 'Location: digital-dashboard');
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
	$user_email = $_REQUEST['user_email'];
	
	if( $user_email != '' ){
		$sql = "SELECT `id` from users WHERE `email` = '".$user_email."' ";
		if ($result = $conn->query($sql)) {
			$row = $result->fetch_assoc();

			//print_r($row);exit();
			//$row = $result->num_rows ;
			//echo count($row);exit();

			if( count($row) > 0 ){

				$encryptedId = base64_encode(base64_encode(base64_encode(base64_encode($row['id']))));
				$retrieve_password_link = constant("SITEURL")."/reset-password.php?flag=".$encryptedId;
					
				/** Mail Here */

				//Server settings
			//	$mail->isSMTP();                                            	// Send using SMTP
				$mail->Host       = 'mail.sigmacomics.com';                    	// Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   	// Enable SMTP authentication
				$mail->Username   = 'superheroes@sigmacomics.com';                     	// SMTP username
				$mail->Password   = 'E_,3i9@sM2)r';                               // SMTP password
				$mail->SMTPSecure = 'ssl';                                // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				$mail->Port       = 465;                                    // TCP port to connect to, use 465 for 

				//Recipients
				$mail->setFrom('superheroes@sigmacomics.com');
				$mail->addAddress($user_email, 'Sigmacomics');    // Add a recipient    

				/*$mail->isSMTP();                                            	// Send using SMTP
				$mail->Host       = 'mail.sigmacomics.com';                    	// Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   	// Enable SMTP authentication
				$mail->Username   = 'superheroes@sigmacomics.com';                     	// SMTP username
				$mail->Password   = 'E_,3i9@sM2)r';                               // SMTP password
				$mail->SMTPSecure = '';                                // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				$mail->Port       = 587;                                    // TCP port to connect to, use 465 for 

				//Recipients
				$mail->setFrom('superheroes@sigmacomics.com');
				$mail->addAddress($user_email, 'Sigmacomics'); */    // Add a recipient

				// Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'PASSWORD RETRIEVAL LINK';
				$mail->Body    = '<p><b>CLICK ON THE LINK BELOW:</b></p><p><b>CHANGE YOUR PASSWORD : </b><a href="'.$retrieve_password_link.'">Password Link</a></p>';
				//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				$mail->Send();
				

				header('Location: forgot-password2');
				exit();
			}else{
				$_SESSION['message'] = "Email not assiciated with account";
				header('Location: forgot-password');
		  		exit();
			}
		  } else {
			$_SESSION['message'] =  "Error: " . $sql . "<br>" . $conn->error;
			header('Location: forgot-password');
		  	exit();
		  }
		  
	}

	
}

/*$sqlNew = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'custom-field' and `post_status`= 'publish' ";*/

$sqlNew = "SELECT * FROM wp_posts LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_term_taxonomy ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id) WHERE wp_posts.post_type = 'custom-field' and wp_posts.post_status= 'publish' AND wp_term_taxonomy.term_id = 1 ORDER BY `ID` DESC ";

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
					<h2><?php echo (isset($content[31]))?$content[31]:'';?></h2>
					<form action="" method="post" id="forgot-password-form">
					<div class="form-group">
						<p class="bigTxt"><?php echo (isset($content[32]))?$content[32]:'';?></p>
					</div>
					<div class="form-group">
						<div class="labelwrap">
						<label><?php echo utf8_encode((isset($content[36]))?$content[36]:'');?></label>
						</div>

						<input type="text" name="user_email" class="form-control">
					</div>
					<button class="getbutton"  name="forgot_pass_next"><?php echo utf8_encode((isset($content[37]))?$content[37]:'');?></button>
					</form>
					<div class="checkboxprt">
					<?php echo (isset($content[33]))?$content[33]:'';?>
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