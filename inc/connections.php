<?php
//ini_set('display_errors', 3);
//ini_set('display_startup_errors', 3);
//error_reporting(E_ALL);

$action = 'live'; //local //dev //live

if($action == 'local'){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "sigma_comics";
}else if($action == 'dev'){
  $servername = "localhost";
  $username = "elbomber_sigma";
  $password = "(K!vJ-ff1.^G";
  $dbname = "elbomber_sigma";
}else if($action == 'live'){
  $servername = "localhost";
  $username = "elbomber_sigma";
  $password = "(K!vJ-ff1.^G";
  $dbname = "elbomber_sigma";
}



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

/** Get api links from wp-admin */

/*$sqlApiLink = "SELECT `post_content` FROM `wp_posts` where `post_type`= 'api-links' and `post_status`= 'publish' ";
	if ($resultApiLink = $conn->query($sqlApiLink)) {
		$i = 0; 
		while($rowApiLink = $resultApiLink->fetch_assoc()){
			$apiLink[$i] = $rowApiLink['post_content'];
			$i++;
		}
}*/

/** Stripe */

//define("STRIPE_PUBLISHABLE_KEY",'pk_test_JuRtgsyAzSkwAftRf00kF1HP');
//define("STRIPE_SECRET_KEY",'sk_test_coYmasBAIShKOqgrKFJP6ZTI');

// SANDBOX
//define("STRIPE_PUBLISHABLE_KEY",'pk_test_51I1C1vJs4QBelxjP5QODgU1gEFa8ul5iUvkjWfQtuNMhWcUVYoQlsbWmR1FvEgim8F8A2ZB2vaNzgNgLX37vFv9Z00fRMr2XyM');
//define("STRIPE_SECRET_KEY",'sk_test_51I1C1vJs4QBelxjPIiSsSM8pzuB2wqWCTz9PS832RFVBUH8hn10NcA93wIT5EcmYzCgIQO5olKCNis7NFvrVMHpI00cTLKB9a7');

// LIVE

/*define("STRIPE_PUBLISHABLE_KEY",'pk_live_51I1C1vJs4QBelxjPx3OYCjs01UNQakxPslFym1V2kFJFH7GvTm2NMboTResm3fDdJWOtlfpWlMMY9k8FQPdSxDDz00pguQxR4T');
define("STRIPE_SECRET_KEY",'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');*/


//define("STRIPE_PUBLISHABLE_KEY",$apiLink[0]);
//define("STRIPE_SECRET_KEY",$apiLink[1]);

/** Stripe */

/** Paypal */


/*define('ProPayPal', 1); // 0 for sandbox 1 for production
if(constant("ProPayPal") != 0){
	define("PayPalClientId", "AUpLE-L4r1QGH8wFhbryQ0ODlKoG3ri8X6NaAHtVZ9Ab5A8t2DKZ_IAyYTT27q8-s76trkjDSELqIGKy");
  define("PayPalSecret", "EMvdej_bMP06mJT22rxTPvP5gPhuAmyMVgoAaQpbOpw2EPn3SboGT0JqHRDN2XipvKGC_1l6_fZ0JJE5"); 
  
	define("PayPalBaseUrl", "https://api.paypal.com/v1/");
	define("PayPalENV", "production");
} else {
  define("PayPalClientId", "Adc9SZoxwTx2U4SshIWxuNBHdhvbXRtMaFxSXxlGHSAuLputrzsTfG0Z27KKrR2GnGoq6hO-zYN1uPFc");
  define("PayPalSecret", "EBbxQBpwfMduC-RzLSFEQX9NEKquyLeP1N2UU40M4mlaGgUNRvm1wI9kXcgvRPhQI6DwPgyVNLdz6adB");
  define("PayPalBaseUrl", "https://api.sandbox.paypal.com/v1/");
  define("PayPalENV", "sandbox");
}*/

/** Paypal */



if($action == 'local'){
  define("SITEURL",'http://localhost/sigma-comics');
  define("BASEURL",'/sigma-comics');
}else if($action == 'dev'){
  define("SITEURL",'https://sigmacomics.com');
  define("BASEURL",'/sigma-comics');
}else{
  define("SITEURL",'https://sigmacomics.com');
  define("BASEURL",'');
}
?>