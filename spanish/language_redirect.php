<?php
$action = 'live'; //local //dev //live
define("__ROOT__",dirname(dirname(__FILE__))."/spanish");
if($action == 'local'){
	define("SITEURL_SPANISH",'http://localhost/sigma-comics/spanish');
	define("BASEURL_SPANISH",'/sigma-comics');
  }else if($action == 'dev'){
	define("SITEURL_SPANISH",'https://sigmacomics.com/spanish');
	define("BASEURL_SPANISH",'/sigma-comics');
  }else{
	define("SITEURL_SPANISH",'https://sigmacomics.com/spanish');
	define("BASEURL_SPANISH",'');
  }
?>