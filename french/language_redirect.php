<?php
$action = 'live'; //local //dev //live
define("__ROOT__",dirname(dirname(__FILE__))."/french");
if($action == 'local'){
	define("SITEURL_FRENCH",'http://localhost/sigma-comics/french');
	define("BASEURL_FRENCH",'/sigma-comics');
  }else if($action == 'dev'){
	define("SITEURL_FRENCH",'https://sigmacomics.com/french');
	define("BASEURL_FRENCH",'/sigma-comics');
  }else{
	define("SITEURL_FRENCH",'https://sigmacomics.com/french');
	define("BASEURL_FRENCH",'');
  }
?>