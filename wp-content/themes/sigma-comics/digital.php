<?php

/* Template Name: digital */

get_header();
?>
<?php
require_once("inc/functions.php");
require_once("inc/connections.php");
$countryCurrency = getCountryCurrencyByIp();
$countryCurrencyRate = convertCurrency($countryCurrency);
$countryCurrencyJs = (isset($countryCurrency->geoplugin_currencySymbol_UTF8))?$countryCurrency->geoplugin_currencySymbol_UTF8:null;
?>
	<!-- Contact Us Page Body Section Start -->
		
		<div class="container">
<div class="createbody">
<h2>to order digital issues, <a href="https://sigmacomics.com/signup">create a new account.</a></h2>
<br>
<h2>to view your digital issue(s), <a href="https://sigmacomics.com/login"><button>Login</button></a> to your account.</h2>
<div class="mid-img">
<img src="https://sigmacomics.com/wp-content/uploads/2021/01/buy-digital-issues.jpg">
				</div>
				
<h4 style="color:#FF0000";>AS LOW AS <?php echo calculateCurrencyAmount($countryCurrency,$countryCurrencyRate,1.50); ?> PER ISSUE!</h4>
			</div>

		</div>
	</section>
	<!-- Contact Us Page Body Section End -->

<?php

get_footer();
?>