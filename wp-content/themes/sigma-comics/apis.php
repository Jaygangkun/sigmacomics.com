<?php

/* Stripe start */

/** Sandbox */

/*define("STRIPE_PUBLISHABLE_KEY",'pk_test_JuRtgsyAzSkwAftRf00kF1HP');
define("STRIPE_SECRET_KEY",'sk_test_coYmasBAIShKOqgrKFJP6ZTI');*/

/** Live */

define("STRIPE_PUBLISHABLE_KEY",'pk_live_51I1C1vJs4QBelxjPdaSLuYy7kWKzoOb8FcFrDX1KziKFTG5t2TR28UliLW1yUmlJDGzQ7TbIsVmh0YT2FB9GwVD700vTaK5MGc');
define("STRIPE_SECRET_KEY",'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');

/* Stripe end*/

/** Paypal start*/
define('ProPayPal', 1); // 0 for sandbox 1 for production
if(constant("ProPayPal") != 0){
	define("PayPalClientId", "AUpLE-L4r1QGH8wFhbryQ0ODlKoG3ri8X6NaAHtVZ9Ab5A8t2DKZ_IAyYTT27q8-s76trkjDSELqIGKy");
  define("PayPalSecret", "EH2I9Gu3_ZMXTm8Te6u6rUZetXEeaiqGObJ4Tl1ClHCfbQjeDnxAUEi2YdtGyXV-6sQIMxotY0rQGr5t"); 
	define("PayPalBaseUrl", "https://api.paypal.com/v1/");
	define("PayPalENV", "production");
} else {
  define("PayPalClientId", "Adc9SZoxwTx2U4SshIWxuNBHdhvbXRtMaFxSXxlGHSAuLputrzsTfG0Z27KKrR2GnGoq6hO-zYN1uPFc");
  define("PayPalSecret", "EBbxQBpwfMduC-RzLSFEQX9NEKquyLeP1N2UU40M4mlaGgUNRvm1wI9kXcgvRPhQI6DwPgyVNLdz6adB");
  define("PayPalBaseUrl", "https://api.sandbox.paypal.com/v1/");
  define("PayPalENV", "sandbox");
}
/** Paypal end*/

/** Shopify start*/
define("SHOPIFY_TOKEN",'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');
/** Shopify end*/
?>

